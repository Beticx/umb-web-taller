# Dockerfile
FROM php:8.2-apache

# Instala dependencias necesarias (cliente MySQL para mysqli y PDO)
RUN apt-get update && apt-get install -y libzip-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql mysqli \
    && a2enmod rewrite

# Copiar API al directorio web de Apache
COPY api/ /var/www/html/

# Ajustar permisos para evitar errores en el servidor web
RUN chown -R www-data:www-data /var/www/html

# El puerto 80 es el puerto por defecto de Apache
EXPOSE 80