# XAMPP Setup Guide for Laravel

## Quick Solution - Use These URLs:

### Option 1: Direct Public Folder Access
```
http://localhost/Project/septan_developers/public/
http://localhost/Project/septan_developers/public/login
http://localhost/Project/septan_developers/public/admin
```

### Option 2: Laravel Development Server (Recommended)
I've started the Laravel development server for you. Access your site at:
```
http://127.0.0.1:8000
http://127.0.0.1:8000/login
http://127.0.0.1:8000/admin
```

## If You Want to Use Apache (XAMPP) Properly:

### Step 1: Enable mod_rewrite in Apache

1. Open `httpd.conf` file in `C:\xampp\apache\conf\`
2. Find this line (remove the `#` if it exists):
   ```apache
   LoadModule rewrite_module modules/mod_rewrite.so
   ```
3. Find and change this:
   ```apache
   <Directory "C:/xampp/htdocs">
       Options Indexes FollowSymLinks
       AllowOverride None
       Require all granted
   </Directory>
   ```
   To this:
   ```apache
   <Directory "C:/xampp/htdocs">
       Options Indexes FollowSymLinks
       AllowOverride All
       Require all granted
   </Directory>
   ```
4. Restart Apache in XAMPP Control Panel

### Step 2: Set Up Virtual Host (Optional but Recommended)

1. Open `C:\xampp\apache\conf\extra\httpd-vhosts.conf`
2. Add this configuration:
   ```apache
   <VirtualHost *:80>
       DocumentRoot "C:/xampp/htdocs/Project/septan_developers/public"
       ServerName septan.local
       <Directory "C:/xampp/htdocs/Project/septan_developers/public">
           Options Indexes FollowSymLinks
           AllowOverride All
           Require all granted
       </Directory>
   </VirtualHost>
   ```
3. Open `C:\Windows\System32\drivers\etc\hosts` (as Administrator)
4. Add this line:
   ```
   127.0.0.1    septan.local
   ```
5. Restart Apache
6. Access via: `http://septan.local`

## Troubleshooting:

### If you get 403 Forbidden:
- Check folder permissions
- Verify `AllowOverride All` is set in httpd.conf
- Check that mod_rewrite is enabled

### If you get 500 Internal Server Error:
- Check Apache error logs: `C:\xampp\apache\logs\error.log`
- Verify PHP version (should be 8.2+)
- Check Laravel logs: `storage\logs\laravel.log`

### Quick Test:
Access: `http://localhost/Project/septan_developers/public/`
You should see your home page or a Laravel welcome page.

