#!/bin/sh
echo "=== starting ==="
sed "s/__PORT__/8080/" /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf
php-fpm -D
sleep 1
nginx -t 2>&1
echo "=== launching nginx ==="
exec nginx -g 'daemon off;'
