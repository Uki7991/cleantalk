#!/usr/bin/env bash

cd /var/www/html

php console.php data:seed

exec /usr/bin/supervisord -n -c /etc/supervisord.conf