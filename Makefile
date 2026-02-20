# Bookshop System - Makefile
# Usage: make up | make down | make bash | make migrate | make seed | make logs | make fix-perms

APP_SERVICE=app
WEB_SERVICE=web
DB_SERVICE=db

.PHONY: help up build down restart ps logs log-app log-web log-db bash webbash dbbash \
        composer-install composer-update artisan keygen migrate fresh seed optimize-clear \
        fix-perms fix-git check

help:
	@echo ""
	@echo "Bookshop System - Commands"
	@echo "  make up                  Start containers"
	@echo "  make build               Build images"
	@echo "  make down                Stop containers"
	@echo "  make restart             Restart containers"
	@echo "  make ps                  Show container status"
	@echo "  make logs                Tail logs (all)"
	@echo "  make log-app             Tail app logs"
	@echo "  make log-web             Tail web logs"
	@echo "  make log-db              Tail db logs"
	@echo "  make bash                Shell into app container"
	@echo "  make composer-install    Install PHP deps"
	@echo "  make artisan cmd='...'   Run artisan command"
	@echo "  make keygen              Generate app key"
	@echo "  make migrate             Run migrations"
	@echo "  make fresh               Fresh migrate (DANGER: wipe DB)"
	@echo "  make seed                Run seeders"
	@echo "  make optimize-clear      Clear caches"
	@echo "  make fix-perms           Fix storage/bootstrap permissions"
	@echo "  make fix-git             Fix git dubious ownership in container"
	@echo "  make check               Quick health checks"
	@echo ""

up:
	docker compose up -d

build:
	docker compose up -d --build

down:
	docker compose down

restart:
	docker compose restart

ps:
	docker compose ps

logs:
	docker compose logs -f --tail=100

log-app:
	docker compose logs -f --tail=100 $(APP_SERVICE)

log-web:
	docker compose logs -f --tail=100 $(WEB_SERVICE)

log-db:
	docker compose logs -f --tail=100 $(DB_SERVICE)

bash:
	docker compose exec $(APP_SERVICE) sh

webbash:
	docker compose exec $(WEB_SERVICE) sh

dbbash:
	docker compose exec $(DB_SERVICE) sh

composer-install:
	docker compose exec $(APP_SERVICE) composer install

composer-update:
	docker compose exec $(APP_SERVICE) composer update

artisan:
	docker compose exec $(APP_SERVICE) php artisan $(cmd)

keygen:
	docker compose exec $(APP_SERVICE) php artisan key:generate

migrate:
	docker compose exec $(APP_SERVICE) php artisan migrate

fresh:
	docker compose exec $(APP_SERVICE) php artisan migrate:fresh --seed

seed:
	docker compose exec $(APP_SERVICE) php artisan db:seed

optimize-clear:
	docker compose exec $(APP_SERVICE) php artisan optimize:clear

fix-perms:
	docker compose exec $(APP_SERVICE) sh -lc "mkdir -p storage/framework/{cache,sessions,testing,views} bootstrap/cache && chmod -R 775 storage bootstrap/cache && chown -R www-data:www-data storage bootstrap/cache"
	docker compose exec $(APP_SERVICE) php artisan optimize:clear
	docker compose restart

fix-git:
	docker compose exec $(APP_SERVICE) git config --global --add safe.directory /var/www

check:
	@echo "== Containers ==" && docker compose ps
	@echo ""
	@echo "== PHP Version ==" && docker compose exec $(APP_SERVICE) php -v
	@echo ""
	@echo "== Laravel Version ==" && docker compose exec $(APP_SERVICE) php artisan -V