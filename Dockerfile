FROM php:8.3-cli as php

RUN apt-get update -y
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

WORKDIR /var/www
COPY . .

COPY --from=composer:2.5.8 /usr/bin/composer /usr/bin/composer

ENV PORT=8000
COPY docker/entrypoint.sh /docker/entrypoint.sh
RUN chmod +x /docker/entrypoint.sh
ENTRYPOINT ["/docker/entrypoint.sh"]