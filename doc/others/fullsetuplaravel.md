````md
# General Tutorial — Setup Laravel with Docker (PHP-FPM + Nginx + MySQL)

This is a general, reusable setup guide for Laravel projects using Docker.

You can use the same steps for any Laravel system (not only bookshop).

---

## 1) Create Laravel project
Option A (new folder):
```bash
composer create-project laravel/laravel my-laravel-app
cd my-laravel-app
````

Option B (current folder):

```bash
composer create-project laravel/laravel .
```

---

## 2) Setup `.env` (database)

Edit `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=app_db
DB_USERNAME=app_user
DB_PASSWORD=secret
```

---

## 3) Add Docker files (put at repo root)

You should have these files:

* `docker-compose.yml`
* `Dockerfile`
* `docker/nginx/default.conf`

---

### 3.1 `docker-compose.yml`

```yaml
services:
  app:
    build:
      context: .
      dockerfile: Dockerfile
    working_dir: /var/www
    volumes:
      - ./:/var/www
    depends_on:
      - db
    networks:
      - app_net

  web:
    image: nginx:alpine
    ports:
      - "8000:80"
    volumes:
      - ./:/var/www
      - ./docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
    depends_on:
      - app
    networks:
      - app_net

  db:
    image: mysql:8.0
    environment:
      MYSQL_DATABASE: app_db
      MYSQL_USER: app_user
      MYSQL_PASSWORD: secret
      MYSQL_ROOT_PASSWORD: root
    ports:
      - "3307:3306"
    volumes:
      - db_data:/var/lib/mysql
    healthcheck:
      test: [ "CMD", "mysqladmin", "ping", "-h", "localhost" ]
      interval: 5s
      timeout: 5s
      retries: 20
    networks:
      - app_net

volumes:
  db_data:

networks:
  app_net:
```

---

### 3.2 `Dockerfile`

```dockerfile
FROM php:8.4-fpm

RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl zip unzip \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN useradd -m -u 1000 laravel || true
RUN chown -R www-data:www-data /var/www

CMD ["php-fpm"]
```

---

### 3.3 Nginx config: `docker/nginx/default.conf`

Create folders first:

```bash
mkdir -p docker/nginx
```

Then create file `docker/nginx/default.conf`:

```nginx
server {
    listen 80;
    server_name localhost;

    root /var/www/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_pass app:9000;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }

    location ~ /\.ht {
        deny all;
    }

    client_max_body_size 50M;
}
```

---

## 4) Build and start Docker

```bash
docker compose up -d --build
```

---

## 5) Install dependencies + basic setup

```bash
docker compose exec app composer install
docker compose exec app php artisan key:generate
docker compose exec app php artisan migrate
```

---

## 6) Open the app

Open:

* [http://localhost:8000](http://localhost:8000)

---

## 7) Build your database (migrations)

Create migration:

```bash
docker compose exec app php artisan make:migration create_<table_name>_table
```

Run migrations:

```bash
docker compose exec app php artisan migrate
```

---

## 8) Create models

```bash
docker compose exec app php artisan make:model ModelName
```

Add relationships in the model if needed (example):

* User belongsTo Role

---

## 9) Seeders (insert base data)

Create seeder:

```bash
docker compose exec app php artisan make:seeder ExampleSeeder
```

Run seeders:

```bash
docker compose exec app php artisan db:seed
```

---

## 10) Factories (optional)

```bash
docker compose exec app php artisan make:factory ExampleFactory
```

---

## 11) Filament (optional admin panel)

Install:

```bash
docker compose exec app composer require filament/filament
docker compose exec app php artisan filament:install
```

Create admin user:

```bash
docker compose exec app php artisan make:filament-user
```

---

## 12) API auth for frontend apps (optional: Sanctum)

Install Sanctum:

```bash
docker compose exec app composer require laravel/sanctum
docker compose exec app php artisan sanctum:install
docker compose exec app php artisan migrate
```

---

## Troubleshooting (common)

### A) Git: “detected dubious ownership in repository at /var/www”

Run once:

```bash
docker compose exec app git config --global --add safe.directory /var/www
```

### B) Laravel 500: cannot write `storage/` or `bootstrap/cache`

Fix permissions:

```bash
docker compose exec app sh -lc "mkdir -p storage/framework/{cache,sessions,testing,views} bootstrap/cache && chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache"
docker compose exec app php artisan optimize:clear
docker compose restart
```

```
```
