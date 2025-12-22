# ---------- Stage 1: Build ----------
FROM php:8.2-apache AS build

# Enable Apache rewrite module
RUN a2enmod rewrite

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy application source
COPY src/ /var/www/html/

# ---------- Stage 2: Runtime ----------
FROM php:8.2-apache

# Enable Apache rewrite module
RUN a2enmod rewrite

# Copy PHP extensions from build stage
COPY --from=build /usr/local/lib/php/extensions /usr/local/lib/php/extensions
COPY --from=build /usr/local/etc/php/conf.d /usr/local/etc/php/conf.d

# Copy application files
COPY src/ /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html


HEALTHCHECK --interval=30s --timeout=5s --start-period=10s --retries=3 \
    CMD curl -f http://localhost/health.php || exit 1
