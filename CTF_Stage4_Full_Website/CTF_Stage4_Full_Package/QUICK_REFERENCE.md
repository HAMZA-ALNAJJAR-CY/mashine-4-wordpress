# Stage 4 WordPress - Quick Reference Guide

## 🎯 Site Overview
A professional pharmacy website disguised as a legitimate business, hosting CTF challenges with two exploitation paths to Stage 5.

## 📍 Site URLs

| Page | URL | Status |
|------|-----|--------|
| Homepage | `http://localhost/` | ✅ Working |
| Services | `http://localhost/services/` | ✅ Working |
| About Us | `http://localhost/about/` | ✅ Working |
| Contact Us | `http://localhost/contact/` | ✅ Working |

## 🔍 Vulnerability Endpoints

### Path 1: Unsafe Deserialization
```
POST /wp-admin/admin-ajax.php?action=pharmacy_sync
Parameter: sync_data (serialized PHP object)
```

### Path 2: Weak File Upload
```
POST /wp-admin/admin-ajax.php?action=pharmacy_upload_report
Parameter: report_file (accepts .txt files with PHP code)
```

## 🔐 Stage 5 Credentials Location
```
File: /wp-content/pharmacy_config.php
Access: Readable (after RCE/exploitation)
```

## 📊 Database Info
- **Database**: pharmacy
- **User**: wp_user
- **Password**: wp_password_123
- **Host**: pharmacy-db:3306

## 🏪 WordPress Admin
- **URL**: `http://localhost/wp-admin/`
- **Username**: admin
- **Password**: admin

## 📁 Key Files

### WordPress Configuration
- `wp-config.php` - Database configuration
- `wp-content/pharmacy_config.php` - Stage 5 credentials
- `wp-content/backup_creds.txt` - Backup credentials

### Theme Files
- `wp-content/themes/pharmacy-theme/` - Custom pharmacy theme
  - `index.php` - Homepage
  - `page-services.php` - Services page
  - `page-about.php` - About page
  - `page-contact.php` - Contact page
  - `header.php` - Navigation header
  - `footer.php` - Footer
  - `custom.css` - Pharmacy styling

### Vulnerable Plugin
- `wp-content/plugins/ctf-vulnerable-plugin/pharmacy-plugin.php`
  - Contains serialization vulnerability
  - Contains file upload vulnerability
  - Automatically creates credential files on activation

## 🚀 Docker Commands

### Start Services
```bash
docker-compose up -d
```

### Stop Services
```bash
docker-compose down
```

### Access WordPress Container
```bash
docker exec -it pharmacy-wordpress bash
```

### Access Database
```bash
docker exec pharmacy-db mariadb -u wp_user -p'wp_password_123' pharmacy
```

## 🎓 CTF Player Walkthrough (No Spoilers)

1. **Reconnaissance Phase**
   - Explore the pharmacy website
   - Notice it's a professional WordPress site
   - Check for hidden files/directories

2. **Vulnerability Discovery**
   - Find AJAX endpoints in `/wp-admin/admin-ajax.php`
   - Identify potential injection points
   - Test serialization/file upload vectors

3. **Exploitation**
   - Execute Remote Code (RCE)
   - Navigate file system
   - Locate configuration files

4. **Credential Extraction**
   - Find `/wp-content/pharmacy_config.php`
   - Extract Stage 5 SSH credentials
   - Prepare for next stage

5. **Stage 5 Access**
   - SSH to stage5.internal.pharmacy.local
   - Use extracted credentials
   - Continue CTF challenge

## 📋 Verification Checklist

- [x] All pages load and render correctly
- [x] Navigation menu functional
- [x] Vulnerability endpoints accessible
- [x] Credentials file present and readable (after RCE)
- [x] Professional pharmacy branding consistent
- [x] Pretty permalinks enabled
- [x] Contact form functional
- [x] Theme templates applied correctly

## 🛡️ Security Notes (CTF Context)

**Intentional Vulnerabilities:**
- Unsafe PHP deserialization (CVE pattern)
- Weak file upload validation
- Credentials stored in readable PHP file
- No authentication on AJAX endpoints

**Not Included (To Prevent Accidental Misuse):**
- No actual remote code execution capability
- Credentials are placeholder values
- No connection to real stage5 server
- Educational purposes only

## 📞 Contact & Support

For issues with Stage 4 CTF Challenge, refer to:
- EXPLOIT_GUIDE.md - Detailed exploitation walkthrough
- THEME_CHANGES.md - Theme customization details
- README.md - Overall setup instructions

---

**Last Updated**: Stage 4 WordPress complete with functional pages and navigation
**Status**: Ready for CTF player exploitation
