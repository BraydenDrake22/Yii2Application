set -euo pipefail

export $(grep -v '^#' .env | xargs) 2>/dev/null || true

docker compose up --build -d

printf "Waiting for web to be ready"; for i in {1..20}; do
    if curl -fsS http://localhost:${HOST_PORT:-8080} >/dev/null 2>&1; then echo "\nOpen -> http://localhost:${HOST_PORT:-8080}"; exit 0; fi
    printf "."; sleep 1
    done
    echo "\nTip: open http://localhost:${HOST_PORT:-8080} once containers finish starting."