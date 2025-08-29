#!/bin/sh
set -euo pipefail

mkdir -p /app

if [ -z "$(ls -A /app 2>/dev/null || true)" ]; then
  echo "[init] /app is empty - creating Yii2 basic project..."
  composer create-project yiisoft/yii2-app-basic /app --prefer-dist --no-interaction

  echo "[init] Applying DB config from env..."
  if [ -f /bootstrap-config/db.php ]; then
    cp /bootstrap-config/db.php /app/config/db.php
  fi
fi

mkdir -p /app/runtime /app/web/assets
chown -R www-data:www-data /app/runtime /app/web/assets || true
chmod -R 775 /app/runtime /app/web/assets || true

if [ -f /app/yii ]; then
  echo "[init] Running Yii migrations (if any)..."
  php /app/yii migrate --interactive=0 || echo "[init] No migrations or migration step skipped."
fi

exec php-fpm -F
php /app/yii migrate --interactive=0 || echo "[init] No migrations to run."

