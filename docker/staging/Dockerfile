# Build from mamazary docker image for PHP & apache2
FROM mamazary/php-bundle:7.4

# Add new relic configuration
ARG NEW_RELIC_AGENT_VERSION=$NEW_RELIC_AGENT_VERSION
ARG NEW_RELIC_LICENSE_KEY=$NEW_RELIC_LICENSE_KEY
ARG NEW_RELIC_APPNAME=$NEW_RELIC_APPNAME

# Set the environment variable
ENV APACHE_DOCUMENT_ROOT /var/www/html

# Get and install composer
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/ \
    && ln -s /usr/local/bin/composer.phar /usr/local/bin/composer

# Set composer path
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"

# Change the APACHE_DOCUMENT_ROOT
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install new relic agent
RUN curl -L https://download.newrelic.com/php_agent/archive/${NEW_RELIC_AGENT_VERSION}/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux.tar.gz | tar -C /tmp -zx \
    && export NR_INSTALL_USE_CP_NOT_LN=1 \
    && export NR_INSTALL_SILENT=1 \
    && /tmp/newrelic-php5-${NEW_RELIC_AGENT_VERSION}-linux/newrelic-install install \
    && rm -rf /tmp/newrelic-php5-* /tmp/nrinstall*

# Configure the new relic agent
RUN sed -i -e "s/REPLACE_WITH_REAL_KEY/${NEW_RELIC_LICENSE_KEY}/" \
    -e "s/newrelic.appname[[:space:]]=[[:space:]].*/newrelic.appname=\"${NEW_RELIC_APPNAME}\"/" \
    -e '$anewrelic.distributed_tracing_enabled=true' \
    -e '$anewrelic.daemon.address="newrelic-php-daemon:31339"' \
    $(php -r "echo(PHP_CONFIG_FILE_SCAN_DIR);")/newrelic.ini

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
