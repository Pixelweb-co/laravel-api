<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>


## Backend laravels

Este backend valida solicitudes de productos clientes y cantidades

## Instalacion

Clone este repositorio


Ingresa a la carpeta de la aplicacion


Configura las credenciales de la base de datos mysql en el archivo .env:


DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nombre_db
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password


ejecuta: composer install

Luego crea las migraciones y datos de ejemplo

Ejecuta: php artisan migrate

Ejecuta: php artisan db:seed

Ejecuta: php artisan serve

La api queda escuchando solicitudes tipo POST en la url: http://127.0.0.1:8000/api/validation

ejemplo de el payload : 

{
    "product_id":"1",
    "quantity":"1",
    "client_id":"1"
}
