FROM php:8.3-fpm

ARG NON_PRIVILEGED_USER_NAME="developer"

RUN apt update && \
    apt install -qqy \
    git \
    wget \
    curl \
    zip \
    unzip

RUN apt install -qqy \
    libcurl4-openssl-dev \
    libssl-dev

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Create non-privileged user
RUN echo "Creating user ${NON_PRIVILEGED_USER_NAME}"
RUN groupadd --gid 1000 ${NON_PRIVILEGED_USER_NAME} \
    && useradd ${NON_PRIVILEGED_USER_NAME} --create-home --uid 1000 --gid 1000 --shell /bin/bash \
    && usermod --append --groups www-data ${NON_PRIVILEGED_USER_NAME} \
    && usermod --append --groups ${NON_PRIVILEGED_USER_NAME} www-data \
    && echo 'alias ll="ls -al"' >> /root/.bashrc \
    && echo 'alias ll="ls -al"' >> /home/${NON_PRIVILEGED_USER_NAME}/.bashrc

COPY src /var/www/html

WORKDIR /var/www/html
