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
2. Montar la aplicación

    ````
   docker compose up -d
   ````

3. Generar la clave de la aplicación
    ````
   docker compose exec app-prueba php artisan key:generate
    ````
4. Crear el archivo: **database.sqlite** en  **database/database.sqlite**

5. Ejecutar migraciones
    ````
   docker compose exec app-prueba php artisan migrate --seed
    ````
    
