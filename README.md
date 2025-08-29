# Yii2 + Docker Compose (PHP-FPM, Apache, MariaDB)


## Prereqs
- Docker Desktop 4.x+
- Git (optional)

## Database Migrations

This project uses Yii2 migrations to version the database schema.

### One-time setup

  docker compose up -d --build


### Apply all pending migrations:

docker compose exec php php /app/yii migrate --interactive=0

### Migration Commands:

docker compose exec php php /app/yii migrate/history                        (Applied migrations)
docker compose exec php php /app/yii migrate/new                            (Pending migrations)
docker compose exec php php /app/yii migrate/down 1                         (Migration Rollback)
docker compose exec php php /app/yii migrate/create <your_migration_name>   (Create new Migration)

### Seeding Demo Data:

docker compose exec php php /app/yii seed


