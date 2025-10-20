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
php bin/console doctrine:migrations:migrate --no-interaction --env=prod

echo "Starting Apache..."
exec apache2-foreground

