FROM php:8.2-apache

RUN docker-php-ext-install pdo pdo_mysql mysqli

RUN a2enmod cgi rewrite

RUN apt-get update && apt-get install -y \
    python3 \
    python3-pip \
    python3-pymysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN ln -sf /etc/apache2/mods-available/cgi.load /etc/apache2/mods-enabled/

RUN mkdir -p /usr/lib/cgi-bin
RUN chmod 755 /usr/lib/cgi-bin

COPY html/ /var/www/html/
COPY cgi-bin/ /usr/lib/cgi-bin/

RUN chmod +x /usr/lib/cgi-bin/*.py

EXPOSE 80

CMD ["apache2-foreground"]