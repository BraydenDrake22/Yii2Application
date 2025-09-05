#!/bin/sh
set -eu

APP_DIR=/app
YII_ENV="${YII_ENV:-Development}" 
PHP_FPM_CMD="${PHP_FPM_CMD:-php-fpm -F}"

echo "[entrypoint] starting (env=$YII_ENV)"

mkdir -p "$APP_DIR"

FRONT_INDEX="$APP_DIR/frontend/web/index.php"
BACK_INDEX="$APP_DIR/backend/web/index.php"

needs_init=0
if [ ! -f "$FRONT_INDEX" ] || [ ! -f "$BACK_INDEX" ]; then
  needs_init=1
fi

if [ ! -d "$APP_DIR/vendor" ]; then
  needs_init=1
fi

if [ "$needs_init" -eq 1 ]; then
  echo "[entrypoint] Yii2 advanced not initialized; running composer install + php init..."
  composer install --no-interaction --prefer-dist

  php "$APP_DIR/init" --env="$YII_ENV" --overwrite=All
else
  echo "[entrypoint] Yii2 advanced appears initialized; skipping init."
fi

if [ -f /bootstrap-config/db.php ]; then
  if [ -d "$APP_DIR/common/config" ]; then
    echo "[entrypoint] applying DB config to common/config/db.php"
    cp /bootstrap-config/db.php "$APP_DIR/common/config/db.php" || true
  elif [ -d "$APP_DIR/config" ]; then
    echo "[entrypoint] applying DB config to config/db.php"
    cp /bootstrap-config/db.php "$APP_DIR/config/db.php" || true
  fi
fi

for p in \
  "$APP_DIR/frontend/runtime" \
  "$APP_DIR/frontend/web/assets" \
  "$APP_DIR/backend/runtime" \
  "$APP_DIR/backend/web/assets" \
  "$APP_DIR/console/runtime" \
  "$APP_DIR/common/runtime"
do
  mkdir -p "$p"
done

chown -R www-data:www-data \
  "$APP_DIR/frontend/runtime" "$APP_DIR/frontend/web/assets" \
  "$APP_DIR/backend/runtime"  "$APP_DIR/backend/web/assets" \
  "$APP_DIR/console/runtime"  "$APP_DIR/common/runtime" || true

chmod -R u+rwX,go-w \
  "$APP_DIR/frontend/runtime" "$APP_DIR/frontend/web/assets" \
  "$APP_DIR/backend/runtime"  "$APP_DIR/backend/web/assets" \
  "$APP_DIR/console/runtime"  "$APP_DIR/common/runtime" || true

if [ -f "$APP_DIR/yii" ]; then
  echo "[entrypoint] running migrations (if any)..."
  php "$APP_DIR/yii" migrate --interactive=0 || echo "[entrypoint] no migrations or skipped."
fi

echo "[entrypoint] launching php-fpm"
exec $PHP_FPM_CMD
