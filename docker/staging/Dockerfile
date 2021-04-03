# Build from mamazary docker image for PHP & apache2
FROM mamazary/php-bundle:7.4

# Set the environment variable
ENV APACHE_DOCUMENT_ROOT /path/to/webroot

# Get and install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Set composer path
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"

# Change the APACHE_DOCUMENT_ROOT
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Change workdir to apache root folder
WORKDIR /var/www/html

# Install zip & unzip
RUN apt-get update && apt-get install zip unzip

# Install ssl lib
RUN apt-get install -y libcurl4-openssl-dev pkg-config libssl-dev

# Copy source code from root directory
COPY . /var/www/html/.

# Install vendor / update if any
RUN composer update

# Give the apache user & group permission to the source code
RUN chown www-data:www-data * -R
