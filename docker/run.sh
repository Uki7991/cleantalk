#!/usr/bin/env sh

cd /var/www/html

composer install

php console.php data:seed

exec /usr/bin/supervisord -n -c /etc/supervisord.conf