FROM ubuntu

RUN apt update
RUN apt install -y nginx && apt install -y php-fpm && apt install -y redis && apt install -y php-redis

EXPOSE 80

COPY index.php /var/www/php/index.php
COPY entrypoint.sh /etc/entrypoint.sh
COPY default.conf /etc/nginx/sites-enabled/default

ENTRYPOINT ["sh","/etc/entrypoint.sh"]
