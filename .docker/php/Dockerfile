FROM php:7.4-fpm
RUN apt-get update && echo "1"
RUN apt-get install -y apt-utils libpq-dev unzip libzip-dev libpng-dev libfreetype6-dev git
RUN apt-get install -y iproute2 iputils-ping
RUN mkdir -p /root/.ssh
WORKDIR /root/.ssh
COPY id_rsa .
COPY id_rsa.pub .
COPY known_hosts .
RUN chmod 300 id_rsa

WORKDIR /tmp
COPY composer-setup.php .
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN rm composer-setup.php
RUN docker-php-ext-configure gd --with-freetype
RUN docker-php-ext-install zip pdo_pgsql pdo_mysql gd
RUN pecl install xdebug-3.1.6
RUN docker-php-ext-enable xdebug
COPY cmd.sh .
RUN chmod u+x cmd.sh
COPY conf/php.ini $PHP_INI_DIR/conf.d/custom-001.ini
ENV XDEBUG_SESSION=1
RUN touch xdebug.log
RUN chmod o+w xdebug.log

WORKDIR /var/www/html
CMD ["bash","/tmp/cmd.sh"]
