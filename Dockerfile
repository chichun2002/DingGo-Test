FROM php:8.4-apache

# System libraries needed to build the PHP extensions CakePHP uses
RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libicu-dev \
        libzip-dev \
    && docker-php-ext-install intl pdo_mysql zip \
    && rm -rf /var/lib/apt/lists/*

# Composer, copied from the official composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# CakePHP serves public files from webroot/ and relies on .htaccess rewrites
ENV APACHE_DOCUMENT_ROOT=/var/www/html/webroot
RUN sed -ri 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
    && sed -ri 's!AllowOverride None!AllowOverride All!g' /etc/apache2/apache2.conf \
    && a2enmod rewrite

# Run Apache as the host user so files in the bind mount (tmp/, logs/)
# stay editable from the host
ARG UID=1000
ARG GID=1000
RUN groupmod -o -g ${GID} www-data && usermod -o -u ${UID} -g ${GID} www-data

WORKDIR /var/www/html
