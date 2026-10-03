#!/bin/sh
echo "=== starting ==="
ls -la /etc/nginx/ /etc/nginx/conf.d/ /etc/nginx/sites-enabled/ 2>&1
rm -f /etc/nginx/sites-enabled/* /etc/nginx/conf.d/*
sed "s/__PORT__/8080/" /etc/nginx/nginx.conf.template > /etc/nginx/conf.d/app.conf
echo "=== config written ==="
cat /etc/nginx/conf.d/app.conf
php-fpm -D
sleep 1
echo "=== testing nginx ==="
nginx -t 2>&1
echo "=== launching nginx ==="
exec nginx -g 'daemon off;'
