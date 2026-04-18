# 🎯 CTF Stage 4 - Full Website Package

**Complete WordPress website with vulnerabilities ready to exploit locally!**

## 📦 What You Get

- ✅ Complete WordPress 6.9.4 installation
- ✅ Vulnerable Akismet plugin with AJAX endpoints
- ✅ Pharmacy inventory system theme
- ✅ Docker Compose configuration
- ✅ Full exploitation guide & documentation
- ✅ Ready to run locally or edit

## ⚡ Quick Start (2 minutes)

```bash
# 1. Extract
unzip CTF_Stage4_Full_Package.zip
cd CTF_Stage4_Full_Package

# 2. Start
docker-compose up -d
sleep 15

# 3. Access
open http://localhost
# Or: curl http://localhost
```

## 📚 Documentation Files

| File | Purpose |
|------|---------|
| **SETUP_INSTRUCTIONS.md** | How to setup & run locally |
| **STAGE4_COMPLETE_GUIDE.md** | Full exploitation guide (5 steps) |
| **COMMANDS_REFERENCE.md** | Copy-paste ready commands |
| **CHECKLIST.md** | Track your progress |

## 🎯 The Challenge

**Goal**: Exploit WordPress to get the flag and Stage 5 credentials

**Vulnerability**: Weak file upload + unauthenticated AJAX endpoints

**Time**: 15-30 minutes

**Flag**: `CTF{PHARMACY_STAGE5_RCE_EXPLOITATION_SUCCESS}`

## 📋 Requirements

- Docker & Docker Compose
- Port 80 available
- ~2GB disk space

## 🚀 Start Hacking!

1. Read `SETUP_INSTRUCTIONS.md` to run locally
2. Read `STAGE4_COMPLETE_GUIDE.md` for exploitation steps
3. Use `COMMANDS_REFERENCE.md` for ready-to-run commands
4. Track progress with `CHECKLIST.md`

## 📝 Can Edit Everything

All files are included - edit the website code locally:

```bash
# Edit plugin code
nano wordpress/wp-content/plugins/akismet/akismet.php

# Edit theme
nano wordpress/wp-content/themes/pharmacy-theme/index.php

# Changes take effect immediately!
```

## 💡 Tips

- All containers run in Docker - no system pollution
- Database data persists between restarts
- Easy to reset: `docker-compose down -v`
- Share with team via git or zip

---

**Ready to start? Read SETUP_INSTRUCTIONS.md first!** 🚀
