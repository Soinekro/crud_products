
# CRUD Products

Este proyecto es una aplicación CRUD de productos construida con Laravel.

## Prerrequisitos
- Asegúrate de tener PHP versión 8.2 o superior, ya que el framework Laravel utilizado es la versión 11.
- Tener instalado Laragon, XAMPP, o el entorno de desarrollo de tu preferencia.

## Pasos para clonar el repositorio

1. Clona el repositorio:
    ```bash
    git clone https://github.com/Soinekro/crud_products.git
    cd crud_products
    ```

2. Copia el archivo `.env.example` a `.env`:
    ```bash
    cp .env.example .env
    ```
    2.1 Asegúrate de completar tus variables de entorno en el archivo `.env`:

3. Instala las dependencias de Composer:
    ```bash
    composer install
    ```

4. Instala las dependencias de NPM:
    ```bash
    npm install && npm run build
    ```

5. Ejecuta las migraciones de la base de datos:
    ```bash
    php artisan migrate
    ```

6. Genera la clave de la aplicación:
    ```bash
    php artisan key:generate
    ```

## Ejecucion de test
1. Ejecutar test de prueba para el componente livewire donde esta el crud
    ```bash
    php artisan test --filter ProductTest
    ```
    ## Observaciones sobre los tests

    Los tests utilizan el trait `RefreshDatabase`, lo que significa que la base de datos se reinicia en cada ejecución de test. Por lo tanto, es recomendable ejecutar los tests al inicio del desarrollo para asegurar que todo funcione correctamente desde el principio.

## Acceso a la aplicación

1. Inicia el servidor de desarrollo de Laravel:
    ```bash
    php artisan serve
    ```

2. Abre tu navegador y accede a la aplicación en `http://localhost:8000`.

¡Listo! Ahora deberías poder usar la aplicación CRUD de productos.

## Listado de decisiones tomadas en el desarrollo

1. **Framework**: Se eligió Laravel-Jetstream stack Livewire por la facilidad de construir aplicaciones web complejas, ya que facilita por el uso de componentes ya diseñados.
2. **Base de datos**: Se optó por MySQL debido a su rendimiento y amplia adopción en la industria.
3. **Frontend**: Se utilizó Blade para las vistas y Tailwind CSS para el diseño, por su simplicidad y flexibilidad.
4. **Gestión de dependencias**: Composer y NPM se usaron para gestionar las dependencias de PHP y JavaScript, respectivamente.
5. **Control de versiones**: Git se utilizó para el control de versiones, facilitando la colaboración y el seguimiento de cambios.


