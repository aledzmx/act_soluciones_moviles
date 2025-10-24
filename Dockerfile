# Usa PHP con Apache y mysqli
FROM php:8.2-apache

# Instala MySQL Server y cliente
RUN apt-get update && apt-get install -y mariadb-server mariadb-client && docker-php-ext-install mysqli

# Copia tus archivos al contenedor
COPY . /var/www/html/

# Copia el script de inicialización
COPY docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expone el puerto
EXPOSE 80

# Ejecuta el entrypoint personalizado
ENTRYPOINT ["docker-entrypoint.sh"]
