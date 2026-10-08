# DingGo Test

A CakePHP 5 app that pulls cars and their quotes from the DingGo API, stores them in MySQL, and lists them on a single page.

## Requirements

- Docker with Docker Compose
- DingGo API credentials (username and key)

## Setup

### 1. Create `config/.env` (required)

The app reads the API credentials from `config/.env`. Without it, every API request fails and no cars are imported.

```
USERNAME=your-dinggo-username
KEY=your-dinggo-key
```

This file is gitignored and is loaded by `config/bootstrap.php`. The same two lines are at the top of `config/.env.example`. Copy just those, not the whole file, because `compose.yaml` already sets `DEBUG` and the `.env` loader errors if a variable is defined twice.

### 2. Start the containers

```bash
docker compose up -d --build
```

### 3. Install dependencies

```bash
docker compose exec app composer install
```

This also creates `config/app_local.php` from `config/app_local.example.php`.

### 4. Create the database tables

```bash
docker compose exec app bin/cake migrations migrate
```

### 5. Open the app

Visit http://localhost:8765

## How it works

1. `/` renders the cars page with a loading spinner.
2. The page fetches `/cars/cars`, which syncs with the DingGo API:
   - Cars are matched by VIN, so re-importing updates existing rows instead of duplicating them.
   - Each car's quotes are replaced in a single transaction.
3. The resulting car cards are inserted into the page.

## Useful info

| What | Where |
| --- | --- |
| App | http://localhost:8765 |
| MySQL | `localhost:3307`, user `cake`, password `secret`, database `cake` |
| Error log | `logs/error.log` |
| Debug mode | `DEBUG` in `compose.yaml` (run `docker compose up -d` after changing it) |

## Tests

```bash
docker compose exec app vendor/bin/phpunit
```

The tests use a separate `cake_test` database, which is created automatically by `docker/mysql-init/01-test-db.sql`.
