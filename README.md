## ABouquet

PHP 7.2

#You need
- clone & run frontend from https://github.com/vkrugov/abq-front
- do php artisan migrate

## For Localhost

host: abq.loc

Do next columns:
- sudo chgrp -R www-data /var/www/abq.loc/
- sudo chmod -R 775 /var/www/abq.loc/storage/
- sudo chmod -R 777 /var/www/abq.loc/storage/logs

abq.loc.conf:

<VirtualHost *:80>
   ServerName abq.loc
   ServerAdmin admin@abq.loc
   DocumentRoot /var/www/abq.loc/public

   <Directory /var/www/abq.loc>
       AllowOverride All
   </Directory>
   ErrorLog /var/www/abq.loc/error.log
   CustomLog /var/www/abq.locaccess.log combined
</VirtualHost>

