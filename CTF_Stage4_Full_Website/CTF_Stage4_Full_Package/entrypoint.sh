#!/bin/bash
# Startup script to configure WordPress with plugins and settings

set -e

echo "🚀 Starting WordPress CTF Stage 4 Setup..."

# Wait for MySQL to be ready
echo "⏳ Waiting for MySQL..."
until mysqladmin ping -h"mysql" -u"root" -p"pharmacy_root_pass" --silent; do
  echo '.'
  sleep 1
done

echo "✅ MySQL is ready"

# Install WordPress (wp-cli way)
if [ ! -f /var/www/html/wp-load.php ]; then
  echo "📦 Installing WordPress core..."
  
  # Download WordPress
  cd /var/www/html
  curl https://wordpress.org/latest.tar.gz | tar xz --strip-components=1
fi

# Create wp-config if not exists
if [ ! -f /var/www/html/wp-config.php ]; then
  echo "⚙️  Creating wp-config.php..."
  cp /var/www/html/wp-config-sample.php /var/www/html/wp-config.php
  
  # Update database settings
  sed -i "s/database_name_here/wordpress/g" /var/www/html/wp-config.php
  sed -i "s/username_here/wp_user/g" /var/www/html/wp-config.php
  sed -i "s/password_here/wp_password_123/g" /var/www/html/wp-config.php
  sed -i "s/localhost/mysql:3306/g" /var/www/html/wp-config.php
fi

# Set permissions
chown -R www-data:www-data /var/www/html
chmod -R 755 /var/www/html

# Ensure Akismet is the active plugin
sleep 5
php -r "
define('WP_USE_THEMES', false);
@require('/var/www/html/wp-blog-header.php');
if (function_exists('update_option')) {
    update_option('active_plugins', array('akismet/akismet.php'));
    echo \"✅ Akismet activated for pharmacy CTF\n\";
}
" 2>/dev/null || true

echo "✅ Stage 4 WordPress setup complete!"
echo "🔗 Access at: http://localhost"
echo "🔐 Admin: admin / admin"
