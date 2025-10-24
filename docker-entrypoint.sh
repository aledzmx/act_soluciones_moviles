#!/bin/bash

# Iniciar MariaDB
service mariadb start

# Esperar a que MySQL esté listo
until mysqladmin ping &>/dev/null; do
    echo "Esperando a que MySQL arranque..."
    sleep 1
done

# Crear base de datos, usuario y tabla
mysql -u root <<EOF
CREATE DATABASE IF NOT EXISTS alumnosdb;
CREATE USER IF NOT EXISTS 'userphp'@'localhost' IDENTIFIED BY '12345';
GRANT ALL PRIVILEGES ON alumnosdb.* TO 'userphp'@'localhost';
FLUSH PRIVILEGES;

USE alumnosdb;

CREATE TABLE IF NOT EXISTS estudiantes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    apellidos VARCHAR(100)
);
EOF

# Iniciar Apache en primer plano
apache2-foreground
