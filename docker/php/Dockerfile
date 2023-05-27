FROM php:8.2-fpm

# set main params
ARG BUILD_ARGUMENT_DEBUG_ENABLED=false
ENV DEBUG_ENABLED=$BUILD_ARGUMENT_DEBUG_ENABLED
ARG BUILD_ARGUMENT_ENV=env
ENV ENV=$BUILD_ARGUMENT_ENV
ENV APP_HOME /var/www/html
ARG UID=1000
ARG GID=1000
ENV USERNAME=www-data

# install all the dependencies and enable PHP modules
RUN apt-get update && apt-get upgrade -y && apt-get install -y \
    procps \
    nano \
    git \
    curl \
    unzip \
    libicu-dev \
    zlib1g-dev \
    libxml2 \
    libxml2-dev \
    libreadline-dev \
    sudo \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd \
    && docker-php-ext-install pdo_mysql \
    && rm -rf /tmp/* \
    && rm -rf /var/list/apt/* \
    && rm -rf /var/lib/apt/lists/* \
    && apt-get clean

# create document root, fix permissions for www-data user and change owner to www-data
RUN mkdir -p $APP_HOME/public && \
    mkdir -p /home/$USERNAME && chown $USERNAME:$USERNAME /home/$USERNAME \
    && usermod -u $UID $USERNAME -d /home/$USERNAME \
    && groupmod -g $GID $USERNAME \
    && chown -R ${USERNAME}:${USERNAME} $APP_HOME

# install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN chmod +x /usr/bin/composer

# set working directory
WORKDIR $APP_HOME

USER ${USERNAME}

USER root

EXPOSE 9000
CMD ["php-fpm"]
