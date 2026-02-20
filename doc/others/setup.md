# Bookshop System — Setup Guide (A to Z)

Stack: Laravel (API) + Filament (Admin Panels) + Next.js (Frontend) + MySQL + Docker  
MVP rule: **1 School ↔ 1 Vendor** | **Children = reference-only**

This guide shows how to setup everything from GitHub → Docker/MySQL → Laravel/Filament → Next.js.

---

## A) Prepare your tools

Install:

- Git
- Docker + Docker Compose
- Node.js + npm
- (Optional) VS Code

**Reason:** Git pulls code, Docker runs services, Node runs Next.js.

---

## B) Recommended repo setup

Use 2 repositories:

- `bookshop-backend` (Laravel + Filament + API)
- `bookshop-frontend` (Next.js)

**Reason:** Backend and frontend deploy differently, so separate repos are easier.

---

## C) Clone the code from GitHub

```bash
git clone <backend_repo_url> bookshop-backend
git clone <frontend_repo_url> bookshop-frontend
```

**Reason:** You start from the same codebase as your server/team.

---

## D) Backend: enter project folder

```bash
cd bookshop-backend
```

**Reason:** All backend commands run from here.

---

## E) Backend: create environment file

```bash
cp .env.example .env
```

**Reason:** `.env` stores private config (DB password, keys) without hardcoding.

---

## F) Confirm Docker Compose services

Your compose file should include at least:

- `app` (Laravel/PHP)
- `web` (Nginx/Caddy)
- `db` (MySQL)

**Reason:** These are the minimum services to run the system.

---

## G) Start Docker services

```bash
docker compose up -d
```

**Reason:** Starts backend + database containers.

---

## H) Install backend dependencies (Composer)

```bash
docker compose exec app composer install
```

**Reason:** Downloads Laravel + Filament packages.

---

## I) Generate Laravel app key

```bash
docker compose exec app php artisan key:generate
```

**Reason:** Needed for encryption and secure sessions.

---

## J) Configure MySQL in backend `.env`

Example values:

- `DB_CONNECTION=mysql`
- `DB_HOST=db`
- `DB_PORT=3306`
- `DB_DATABASE=bookshop`
- `DB_USERNAME=bookshop`
- `DB_PASSWORD=secret`

**Reason:** Laravel must connect to the MySQL container.

---

## K) Run migrations

```bash
docker compose exec app php artisan migrate
```

**Reason:** Creates all database tables.

---

## L) Seed base data (roles + initial accounts)

```bash
docker compose exec app php artisan db:seed
```

**Reason:** Creates base roles and default admin data.

---

## M) Install Filament (if not installed yet)

```bash
docker compose exec app composer require filament/filament
docker compose exec app php artisan filament:install
```

**Reason:** Filament provides the admin panels.

---

## N) Create Super Admin user (if you don’t have one)

```bash
docker compose exec app php artisan make:filament-user
```

**Reason:** You need one admin login to manage the platform.

---

## O) Setup API authentication for Next.js (recommended)

Use Laravel Sanctum:

```bash
docker compose exec app composer require laravel/sanctum
docker compose exec app php artisan sanctum:install
docker compose exec app php artisan migrate
```

**Reason:** Next.js needs secure token-based auth to call the API.

---

## P) Configure CORS so Next.js can call Laravel

Allow your Next.js dev URL:

- `http://localhost:3000`

**Reason:** Browser blocks cross-site requests without CORS.

---

## Q) Verify backend is reachable

Recommended:

- Create a simple endpoint: `GET /api/health`
- Confirm Filament loads (example): `/admin`

**Reason:** Confirms backend + DB are running.

---

## R) Frontend: go to Next.js project

```bash
cd ../bookshop-frontend
```

**Reason:** All frontend commands run from here.

---

## S) Frontend: create environment file

```bash
cp .env.example .env.local
```

**Reason:** Frontend also needs config values.

---

## T) Set API URL in `.env.local`

Example:

- `NEXT_PUBLIC_API_URL=http://localhost:8000/api`

**Reason:** Next.js must know where Laravel API is.

---

## U) Install frontend dependencies

```bash
npm install
```

**Reason:** Downloads libraries used by the UI.

---

## V) Run Next.js (development)

```bash
npm run dev
```

**Reason:** Starts the frontend portal.

---

## W) End-to-end test (minimum)

1. Login Filament as Super Admin
2. Create Vendor + approve
3. Create School + approve
4. Assign School → Vendor (MVP: 1 school ↔ 1 vendor)
5. Vendor adds products (ISBN/code + price + stock)
6. School creates booklist (academic year + grade label) + publish
7. Parent registers, views booklist, creates order

**Reason:** Confirms the full workflow works.

---

## X) FPX payment integration (backend)

Implement endpoints:

- `POST /payments/fpx/initiate`
- `POST /payments/fpx/callback` (webhook)

**Reason:** Payment must be server-side to prevent fake payment status.

---

## Y) Secure payment callback

- Verify gateway signature/secret
- Only then mark payment as `paid`

**Reason:** Prevent spoofed callbacks.

---

## Z) Go-live checklist

- HTTPS enabled
- Payment callback verified
- Pickup + shipment flows tested
- Database backup enabled
- Admin credentials stored safely

**Reason:** Payment + orders must be reliable before real users.
