# Stage 4 - Team Completion Checklist

## Phase 1: Reconnaissance
- [ ] Homepage loads at http://localhost
- [ ] Found hints in page source
- [ ] Identified "Pharmacy Inventory System" theme

## Phase 2: AJAX Enumeration
- [ ] Tested `pharmacy_export` endpoint
- [ ] Tested `pharmacy_sync` endpoint
- [ ] Got responses: `{"success":false,"data":"No file provided"}`

## Phase 3: Upload Vulnerability
- [ ] Created PHP webshell
- [ ] Uploaded via `pharmacy_export` AJAX endpoint
- [ ] Got success response with upload URL

## Phase 4: Remote Code Execution
- [ ] Accessed uploaded shell at `/wp-content/uploads/pharmacy/shell.php`
- [ ] Executed `id` command successfully
- [ ] Verified execution as `www-data` user

## Phase 5: Credential Extraction
- [ ] Found and read `/var/www/html/wp-content/pharmacy_config.php`
- [ ] Obtained flag: `CTF{PHARMACY_STAGE5_RCE_EXPLOITATION_SUCCESS}`
- [ ] Obtained SSH credentials:
  - Host: `stage5.internal.pharmacy.local`
  - User: `pharmacy_admin`
  - Pass: `PharmacyPass_2025`
- [ ] Obtained Database credentials:
  - Host: `db.internal.pharmacy.local`
  - User: `db_admin`
  - Pass: `DatabaseAdmin@2025`

## Phase 6: Stage 5 Connection
- [ ] SSH connection to Stage 5 successful
- [ ] Database accessible from Stage 5
- [ ] Ready for Stage 5 challenges

---
✅ All complete? You've finished Stage 4!
