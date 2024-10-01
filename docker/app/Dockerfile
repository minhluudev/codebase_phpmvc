FROM php:8.2-fpm
COPY docker/app/php.ini-development /usr/local/etc/php/php.ini

WORKDIR /var/www/html

COPY ./ ./

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
     ca-certificates \
     curl \
     xz-utils \
     git \
     libgmp-dev \
     unzip \
     libzip-dev \
     lsb-release \
     ffmpeg \
     libmemcached-dev
RUN docker-php-ext-install pdo_mysql
# php composer
COPY --from=composer /usr/bin/composer /usr/bin/composer

# RUN curl -sL https://deb.nodesource.com/setup_18.x  | bash -
# RUN apt-get -y install nodejs

# RUN apt-get update && apt-get install -y \
#     sendmail \
#     mailutils

# RUN echo "sendmail_path=/usr/sbin/sendmail -t -i" >> /usr/local/etc/php/conf.d/sendmail.ini
# RUN sed -i '/#!\/bin\/sh/aservice sendmail restart' /usr/local/bin/docker-php-entrypoint
# RUN sed -i '/#!\/bin\/sh/aecho "$(hostname -i)\t$(hostname) $(hostname).localhost" >> /etc/hosts' /usr/local/bin/docker-php-entrypoint

RUN apt-get update