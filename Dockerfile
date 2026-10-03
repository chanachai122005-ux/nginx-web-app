FROM php:8.2-fpm
RUN apt-get update && apt-get install -y nginx && rm -rf /var/lib/apt/lists/*
RUN docker-php-ext-install pdo pdo_mysql mysqli
COPY . /var/www/html/
COPY nginx.conf.template /etc/nginx/nginx.conf.template
COPY start.sh /start.sh
RUN chmod +x /start.sh
CMD ["/start.sh"]
