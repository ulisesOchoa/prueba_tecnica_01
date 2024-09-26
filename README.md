## Notas Importantes

Manejo a la perfección Vue y React, y hubiera preferido hacer una API RESTful con Laravel y utilizar uno de esos
frameworks para el frontend. Sin embargo, debido a los requisitos, opté por implementar la interfaz con Blade y he hecho
mi mejor esfuerzo en este contexto.

## Instalación del proyecto

1. Instalar dependencias

   **Window**
    ````
    docker run --rm -v ${pwd}:/app composer install
    ````

   **Linux**
    ````
    docker run --rm -v “$(pwd)”:/app composer install
    ````

   O si cuentas con composer instalado en tu maquina ejecuta:
    ````
    composer install
    ````
   
2. Copiar y pegar el archivo .env.example y renombrarlo a .env

3. Montar la aplicación

    ````
   docker compose up -d
   ````

4. Generar la clave de la aplicación
    ````
   docker compose exec app-prueba php artisan key:generate
    ````
5. Crear el archivo: **database.sqlite** en  **database/database.sqlite**

6. Ejecutar migraciones
    ````
   docker compose exec app-prueba php artisan migrate --seed
    ````
7. Instalar Dependencias de Frontend
    ````
   npm install && npm run dev
   ````
   
ejecutar este comando si tienes problemas de rutas 

````
docker compose exec app-prueba php artisan route:cache
````
