#!/bin/sh
sed "s/__PORT__/${PORT:-80}/" /etc/nginx/nginx.conf.template > /etc/nginx/sites-enabled/default
php-fpm -D
nginx -g 'daemon off;'
