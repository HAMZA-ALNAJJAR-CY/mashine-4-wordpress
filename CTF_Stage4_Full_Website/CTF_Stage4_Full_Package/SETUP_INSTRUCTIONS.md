# CTF Stage 4 - Complete Website Package Setup

**This package contains the entire Stage 4 CTF website ready to run locally!**

## 🚀 Quick Start (2 minutes)

### Prerequisites
- Docker & Docker Compose installed
- 2GB free disk space
- Port 80 and 3306 available

### 1️⃣ Extract the Package
```bash
unzip CTF_Stage4_Full_Package.zip
cd CTF_Stage4_Full_Package
```

### 2️⃣ Start the Website
```bash
docker-compose up -d
sleep 15  # Wait for containers to initialize
```

### 3️⃣ Access the Website
```
Open browser: http://localhost
```

### 4️⃣ Stop the Website
```bash
docker-compose down
```

---

## 📁 Package Structure

```
CTF_Stage4_Full_Package/
├── docker-compose.yml           # Docker configuration
├── entrypoint.sh                # Container initialization script
├── wordpress/                   # Complete WordPress installation
│   ├── wp-config.php           # WordPress configuration
│   ├── wp-content/
│   │   ├── plugins/
│   │   │   └── akismet/        # Vulnerable plugin
│   │   ├── themes/
│   │   │   └── pharmacy-theme/ # Custom theme
│   │   └── uploads/            # User uploads
│   └── wp-*                    # WordPress core files
│
├── STAGE4_COMPLETE_GUIDE.md     # Full exploitation guide
├── README.md                    # Quick start
├── COMMANDS_REFERENCE.md        # Copy-paste commands
├── CHECKLIST.md                 # Progress tracker
└── SETUP_INSTRUCTIONS.md        # This file

```

---

## 📝 What's Included

### Website Files
- ✅ Complete WordPress 6.9.4 installation
- ✅ Pharmacy theme with vulnerabilities
- ✅ Akismet plugin with AJAX endpoints
- ✅ Configuration files
- ✅ All WordPress plugins and themes

### Documentation
- ✅ Full exploitation guide (5 steps)
- ✅ Command reference (copy-paste ready)
- ✅ Completion checklist
- ✅ Setup instructions
- ✅ README

### Configuration
- ✅ Docker Compose setup
- ✅ Database initialization
- ✅ Apache/PHP configuration
- ✅ Auto-activation script

---

## ⚙️ System Requirements

| Requirement | Minimum |
|------------|---------|
| Docker | 20.10+ |
| Docker Compose | 2.0+ |
| RAM | 2GB |
| Disk | 2GB |
| Ports | 80, 3306 |

**Check Docker Installation**:
```bash
docker --version
docker-compose --version
```

---

## 🔧 Detailed Setup Steps

### Step 1: Install Docker (if not installed)

**Ubuntu/Debian**:
```bash
sudo apt update
sudo apt install docker.io docker-compose
sudo usermod -aG docker $USER
```

**macOS** (using Homebrew):
```bash
brew install docker docker-compose
```

**Windows**:
- Download Docker Desktop: https://www.docker.com/products/docker-desktop
- Run installer and follow prompts

### Step 2: Extract Package
```bash
# Extract ZIP
unzip CTF_Stage4_Full_Package.zip
cd CTF_Stage4_Full_Package

# Verify structure
ls -la
# Should show: docker-compose.yml, wordpress/, STAGE4_COMPLETE_GUIDE.md, etc.
```

### Step 3: Start Containers
```bash
# Start in background
docker-compose up -d

# Check status (should see 2 containers running)
docker-compose ps

# Watch logs (optional, Ctrl+C to exit)
docker-compose logs -f
```

**Expected Output**:
```
pharmacy-wordpress  wordpress:latest  UP
pharmacy-db         mariadb:latest    UP
```

### Step 4: Wait for Initialization
```bash
# Wait for WordPress to be ready (usually 10-15 seconds)
sleep 15

# Test if WordPress is responding
curl -s http://localhost | grep "Secret Pharmacy" && echo "✅ WordPress is ready!"
```

### Step 5: Access Website
```bash
# Open in browser
http://localhost

# Or use curl
curl -s http://localhost | head -50
```

---

## 🎯 Running the CTF Challenge

Once the website is running:

### 1️⃣ Read the Guide
```bash
# View exploitation guide
cat STAGE4_COMPLETE_GUIDE.md
# Or open in editor
nano STAGE4_COMPLETE_GUIDE.md
```

### 2️⃣ Copy Commands from Reference
```bash
cat COMMANDS_REFERENCE.md
# Copy commands and run them in your terminal
```

### 3️⃣ Track Progress
```bash
# Use checklist to track completion
cat CHECKLIST.md
```

### 4️⃣ Complete the Challenge
- Follow the 5 exploitation steps
- Get the flag
- Extract Stage 5 credentials
- Complete the checklist

---

## 📝 Editing Files Locally

You can edit the website files directly:

### Edit WordPress Configuration
```bash
# Edit WordPress config
nano wordpress/wp-config.php

# Edit plugin code
nano wordpress/wp-content/plugins/akismet/akismet.php

# Edit theme
nano wordpress/wp-content/themes/pharmacy-theme/index.php
```

### Changes Take Effect Immediately
- HTML/CSS changes: Refresh browser
- PHP changes: Refresh browser (may need Ctrl+Shift+R)
- Docker config changes: Run `docker-compose down` then `docker-compose up -d`

---

## 🐛 Troubleshooting

### Issue 1: Containers Won't Start
**Error**: `docker-compose up` fails

**Solution**:
```bash
# Check Docker is running
docker ps

# Check logs
docker-compose logs

# Rebuild containers
docker-compose down
docker-compose up -d --build
```

### Issue 2: Port 80 Already in Use
**Error**: `bind: address already in use`

**Solution A - Use Different Port**:
```bash
# Edit docker-compose.yml, change:
# ports:
#   - "8080:80"  <- Instead of "80:80"

# Then access: http://localhost:8080
```

**Solution B - Free Port 80**:
```bash
# Find what's using port 80
sudo lsof -i :80

# Stop the service using it
sudo systemctl stop nginx  # or apache2, etc.
```

### Issue 3: Database Connection Failed
**Error**: WordPress shows database error

**Solution**:
```bash
# Restart database container
docker-compose restart pharmacy-db

# Check database logs
docker-compose logs pharmacy-db

# Wait longer for initialization
sleep 30
```

### Issue 4: Cannot Access http://localhost
**Error**: Connection refused

**Solution**:
```bash
# Check if containers are running
docker-compose ps

# Check logs
docker-compose logs pharmacy-wordpress

# Test connectivity
curl -v http://localhost
```

### Issue 5: RCE Returns 404 Error
**Error**: Shell URL returns 404

**Solution**:
```bash
# Verify upload directory exists
docker exec pharmacy-wordpress ls -la /var/www/html/wp-content/uploads/pharmacy/

# Check PHP execution
docker exec pharmacy-wordpress php -v

# Verify file permissions
docker exec pharmacy-wordpress ls -la /var/www/html/wp-content/plugins/akismet/akismet.php
```

---

## 🔐 Database Access

### Access MySQL Database Locally
```bash
# Connect to database
mysql -h 127.0.0.1 -u wordpress -p wordpress

# Or use docker exec
docker exec -it pharmacy-db mysql -u wordpress -p wordpress

# List tables
SHOW TABLES;

# View WordPress options
SELECT * FROM wp_options;
```

### Reset Database
```bash
# Stop containers
docker-compose down

# Remove database volume
docker volume rm stage4-wordpress_db_data

# Start fresh
docker-compose up -d
```

---

## 📊 Useful Docker Commands

```bash
# View logs
docker-compose logs -f pharmacy-wordpress

# Execute commands in container
docker exec -it pharmacy-wordpress bash
docker exec -it pharmacy-wordpress /bin/bash

# View container details
docker-compose ps
docker inspect pharmacy-wordpress

# Stop all containers
docker-compose down

# Remove everything (cleanup)
docker-compose down -v

# Rebuild containers
docker-compose up -d --build

# Check disk usage
docker ps -a
du -sh CTF_Stage4_Full_Package/
```

---

## 📤 Team Collaboration Tips

### Share Edited Website
```bash
# Commit changes to git
git init
git add .
git commit -m "My Stage 4 modifications"
git push origin main

# Team pulls updates
git pull
docker-compose down
docker-compose up -d
```

### Share Database Dump
```bash
# Export database
docker exec pharmacy-db mysqldump -u wordpress -pwordpress wordpress > backup.sql

# Share backup.sql with team
# Team imports it:
docker exec -i pharmacy-db mysql -u wordpress -pwordpress wordpress < backup.sql
```

### Share Modified Files
```bash
# Zip just the changes
zip -r my_changes.zip wordpress/wp-content/plugins/akismet/

# Team extracts in their CTF_Stage4_Full_Package directory
unzip my_changes.zip
docker-compose restart
```

---

## ✅ Verification Checklist

After starting the website, verify:

- [ ] `docker-compose ps` shows 2 running containers
- [ ] `curl http://localhost` returns HTML
- [ ] Page contains "Secret Pharmacy Inventory System"
- [ ] Page contains hints about AJAX endpoints
- [ ] PHP files in `/wp-content/plugins/akismet/` are present
- [ ] Upload directory `/wp-content/uploads/pharmacy/` exists
- [ ] MySQL database is accessible

---

## 📞 Support

If you encounter issues:

1. **Check logs**: `docker-compose logs`
2. **Verify Docker**: `docker ps`
3. **Check ports**: `lsof -i :80`
4. **Read errors carefully** - They usually indicate the solution
5. **Restart everything**: `docker-compose down && docker-compose up -d`

---

## 🎓 Learning Path

1. **Setup** (2 min): Extract and run containers
2. **Explore** (5 min): Browse website, read hints
3. **Enumerate** (5 min): Find AJAX endpoints
4. **Exploit** (10 min): Upload shell and achieve RCE
5. **Extract** (5 min): Get credentials and flag
6. **Analyze** (bonus): Edit code, understand vulnerabilities

**Total Time**: 15-30 minutes ⏱️

---

## 🚀 Next Steps After Stage 4

Once you complete Stage 4:

1. ✅ Get Stage 4 flag
2. ✅ Extract Stage 5 credentials
3. 📝 Document your process
4. 🔄 Try alternative exploitation methods
5. 🎯 Progress to Stage 5

---

**Enjoy the CTF! Good luck! 🎯**

Created: April 18, 2026
