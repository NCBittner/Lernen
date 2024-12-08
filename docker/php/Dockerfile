# --- Base image
FROM php:8.4-fpm-bookworm AS base
LABEL authors="Erick Dyck"

# Keep Debian up-to-date and install required packages
RUN apt-get update \
    && apt-get upgrade -y \
    && apt-get install -y \
    git \
    libzip-dev \
    unzip \
    && apt-get clean -y \
    && rm -rf /var/cache/apt /var/lib/apt/lists/*

# Install php packages \
RUN docker-php-ext-install zip

# Install latest composer
COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

# Prepare application directory
RUN rm -rf /app && mkdir /app
WORKDIR /app

# Copy custom zz-docker.conf into container
COPY ./docker/php/zz-docker.conf /usr/local/etc/php-fpm.d/zz-docker.conf

# --- Development stage ---
FROM base AS development
LABEL stage="development"

ARG UID
ARG GID

# Create custom user with UID and GID from host
RUN groupadd -g ${GID} appuser \
    && useradd -u ${UID} -g appuser -s /bin/sh -m appuser

USER appuser

# --- Production stage ---
FROM base AS production
LABEL stage="production"

# Copy projects files into container
COPY ./composer.json /app/composer.json
COPY ./composer.lock /app/composer.lock

COPY ./config        /app/config
COPY ./log           /app/log
COPY ./public        /app/public
COPY ./scripts       /app/scripts
COPY ./src           /app/src
COPY ./template      /app/template

# Run composer
RUN composer install
