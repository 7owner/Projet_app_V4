#!/usr/bin/env bash
set -euo pipefail

MAX_RETRIES="${DB_WAIT_RETRIES:-30}"
SLEEP_SECONDS="${DB_WAIT_SLEEP:-2}"

echo "Waiting for database to be ready..."
attempt=0
until php bin/console doctrine:query:sql "SELECT 1" --env=prod >/dev/null 2>&1; do
  attempt=$((attempt+1))
  if [ "$attempt" -ge "$MAX_RETRIES" ]; then
    echo "Database not ready after $attempt attempts. Exiting."
    exit 1
  fi
  echo "DB not ready yet ($attempt/$MAX_RETRIES). Sleeping $SLEEP_SECONDS s..."
  sleep "$SLEEP_SECONDS"
done

echo "Database is ready. Syncing migration storage and running migrations..."
php bin/console doctrine:migrations:sync-metadata-storage --no-interaction --env=prod || true
if ! php bin/console doctrine:migrations:migrate --no-interaction --env=prod; then
  echo "Migrations failed. Considering automatic baseline..."
  if [ "${AUTO_BASELINE:-true}" = "true" ]; then
    # If any user table exists in public schema, baseline the latest migration and retry
    table_count=$(php bin/console doctrine:query:sql "SELECT COUNT(*) FROM information_schema.tables WHERE table_schema='public' AND table_type='BASE TABLE'" --env=prod 2>/dev/null | tr -cd '0-9')
    if [ -z "$table_count" ]; then table_count=0; fi
    if [ "$table_count" -gt 0 ]; then
      latest_file=$(ls -1 migrations/Version*.php 2>/dev/null | sort | tail -n1)
      if [ -n "$latest_file" ]; then
        latest_class="DoctrineMigrations\\$(basename "$latest_file" .php)"
        echo "Detected existing tables ($table_count). Baselining ${latest_class}..."
        php bin/console doctrine:migrations:version --add --no-interaction "$latest_class" || true
        php bin/console doctrine:migrations:migrate --no-interaction --env=prod || true
      fi
    fi
  fi
fi

# Auto-seed once on empty database (first start)
if [ "${AUTO_SEED:-true}" = "true" ]; then
  echo "AUTO_SEED enabled. Checking if initial seed is required..."
  user_count=$(php bin/console doctrine:query:sql "SELECT COUNT(*) FROM users" --env=prod 2>/dev/null | tr -cd '0-9' | sed -e 's/^0*//')
  if [ -z "$user_count" ]; then user_count=0; fi
  if [ "$user_count" -eq 0 ]; then
    echo "No users found. Running initial seed (app:populate-database)..."
    php bin/console app:populate-database --no-interaction --env=prod || true
  else
    echo "Seed not required ($user_count users present)."
  fi
fi


echo "Starting Apache..."
exec apache2-foreground

