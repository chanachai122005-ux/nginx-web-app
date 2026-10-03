#!/bin/sh
sed "s/__PORT__/8080/" /etc/nginx/nginx.conf.template > /etc/nginx/sites-enabled/default
rm -f /etc/nginx/sites-enabled/default.dpkg-dist
php-fpm -D
nginx -t
nginx -g 'daemon off;'
