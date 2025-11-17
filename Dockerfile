# Dockerfile
FROM php:8.2-apache

# Instala dependencias necesarias (cliente MySQL para mysqli y PDO)
RUN apt-get update && apt-get install -y libzip-dev default-mysql-client \
    && docker-php-ext-install pdo_mysql mysqli \
    && a2enmod rewrite

# --- INICIO DE CORRECCIÓN PARA EL ERROR 404 ---

# 1. Habilitar la lectura de archivos .htaccess en el directorio web
# Esto es CRUCIAL para que 'DirectoryIndex index.php' y la reescritura funcionen
RUN sed -i '/<Directory \/var\/www\/>/a \ \ \ \ AllowOverride All' /etc/apache2/apache2.conf

# 2. Asegurar que index.php esté en la lista de archivos por defecto
# Aunque el .htaccess lo hace, es bueno tenerlo en la configuración principal también
RUN echo 'DirectoryIndex index.php index.html' >> /etc/apache2/mods-enabled/dir.conf

# --- FIN DE CORRECCIÓN PARA EL ERROR 404 ---

# Copiar API al directorio web de Apache
COPY api/ /var/www/html/

# Ajustar permisos para evitar errores en el servidor web
RUN chown -R www-data:www-data /var/www/html

# El puerto 80 es el puerto por defecto de Apache
EXPOSE 80