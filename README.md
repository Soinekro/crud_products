
# CRUD Products

Este proyecto es una aplicación CRUD de productos construida con Laravel.

## Pasos para clonar el repositorio

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu_usuario/crud_products.git
    cd crud_products
    ```

2. Copia el archivo `.env.example` a `.env`:
    ```bash
    cp .env.example .env
    ```

3. Instala las dependencias de Composer:
    ```bash
    composer install
    ```

4. Instala las dependencias de NPM:
    ```bash
    npm install
    ```

5. Ejecuta las migraciones de la base de datos:
    ```bash
    php artisan migrate
    ```

6. Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

## Acceso a la aplicación

1. Inicia el servidor de desarrollo de Laravel:
    ```bash
    php artisan serve
    ```

2. Abre tu navegador y accede a la aplicación en `http://localhost:8000`.

¡Listo! Ahora deberías poder usar la aplicación CRUD de productos.
