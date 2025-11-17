# Dockerfile
FROM php:8.2-apache

# Instala dependencias del sistema necesarias y extensiones PHP
RUN apt-get update && apt-get install -y libzip-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql mysqli \
    && a2enmod rewrite

# Copiar API al directorio web
COPY api/ /var/www/html/

# Ajustar permisos
RUN chown -R www-data:www-data /var/www/html

# Exponer puerto (no necesario en Render, pero útil localmente)
EXPOSE 80
