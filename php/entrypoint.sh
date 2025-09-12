#!/bin/sh
set -eu

APP_DIR=/app
YII_ENV="${YII_ENV:-Development}"
PHP_FPM_CMD="${PHP_FPM_CMD:-php-fpm -F}"

log() { echo "[entrypoint] $*"; }

log "starting (env=$YII_ENV)"
mkdir -p "$APP_DIR"

FRONT_INDEX="$APP_DIR/frontend/web/index.php"
BACK_INDEX="$APP_DIR/backend/web/index.php"

needs_init=0
[ ! -f "$FRONT_INDEX" ] || [ ! -f "$BACK_INDEX" ] && needs_init=1
[ ! -d "$APP_DIR/vendor" ] && needs_init=1

write_thin_main_local() {
  dst="$APP_DIR/common/config/main-local.php"
  log "writing thin common/config/main-local.php"
  if [ -n "${MAIL_DSN:-}" ]; then
    # Mailpit/SMTP mode if MAIL_DSN is provided (e.g., smtp://mail:1025)
    cat > "$dst" <<'PHP'
<?php
return [
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => false,
            'transport' => ['dsn' => getenv('MAIL_DSN')],
        ],
    ],
];
PHP
  else
    # Dev default: write emails to files
    cat > "$dst" <<'PHP'
<?php
return [
    'components' => [
        'db' => require __DIR__ . '/db.php',
        'mailer' => [
            'class' => \yii\symfonymailer\Mailer::class,
            'viewPath' => '@common/mail',
            'useFileTransport' => true,
        ],
    ],
];
PHP
  fi
}

ensure_thin_main_local() {
  # Overwrite if missing, obviously wrong, or forced via BOOTSTRAP_OVERWRITE_MAIN_LOCAL=1
  if [ ! -f "$APP_DIR/common/config/main-local.php" ] || \
     grep -Eq 'host=localhost|dbname=yii2advanced' "$APP_DIR/common/config/main-local.php" || \
     [ "${BOOTSTRAP_OVERWRITE_MAIN_LOCAL:-0}" = "1" ]; then
    write_thin_main_local
  fi
}

# Optional: seed local configs from /bootstrap-config if you mounted it
copy_if_missing() {
  src="$1"; dst="$2"
  if [ -f "$src" ] && [ ! -f "$dst" ]; then
    log "seeding $(basename "$dst") from template"
    mkdir -p "$(dirname "$dst")"
    cp "$src" "$dst"
  fi
}

if [ "$needs_init" -eq 1 ]; then
  log "Yii2 advanced not initialized; running composer install + php init..."
  composer install --no-interaction --prefer-dist
  php "$APP_DIR/init" --env="$YII_ENV" --overwrite=All
  # Ensure sane local config after Yii's init
  ensure_thin_main_local
else
  log "Yii2 advanced appears initialized; skipping init."
  ensure_thin_main_local
fi

# If you keep templates, you can seed front/console locals (optional, only if missing)
copy_if_missing /bootstrap-config/frontend/config/main-local.php "$APP_DIR/frontend/config/main-local.php" || true
copy_if_missing /bootstrap-config/console/config/main-local.php  "$APP_DIR/console/config/main-local.php"  || true
# If you also store a template db.php, only copy if missing (we keep db.php committed normally)
copy_if_missing /bootstrap-config/common/config/db.php           "$APP_DIR/common/config/db.php"          || true

# Ensure runtime & asset dirs
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

# Fail fast if DSN doesn’t target the Docker DB host (default: db)
php -r '
require "/app/vendor/autoload.php";
require "/app/vendor/yiisoft/yii2/Yii.php";
use yii\helpers\ArrayHelper;
$cfg = ArrayHelper::merge(
  require "/app/common/config/main.php",
  file_exists("/app/common/config/main-local.php") ? require "/app/common/config/main-local.php" : [],
  require "/app/frontend/config/main.php",
  file_exists("/app/frontend/config/main-local.php") ? require "/app/frontend/config/main-local.php" : []
);
$dsn = $cfg["components"]["db"]["dsn"] ?? "";
$expected = getenv("DB_HOST") ?: "db";
if (!preg_match("~mysql:host=".$expected."(;|$)~", $dsn)) {
  fwrite(STDERR, "[guard] FATAL: DSN must target host=".$expected.", got: $dsn\n");
  exit(3);
}
' || exit 3

# Run migrations if present
if [ -f "$APP_DIR/yii" ]; then
  log "running migrations (if any)..."
  php "$APP_DIR/yii" migrate --interactive=0 || log "no migrations or skipped."
fi

log "launching php-fpm"
exec $PHP_FPM_CMD
