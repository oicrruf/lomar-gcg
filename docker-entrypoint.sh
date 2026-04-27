#!/bin/bash
set -e

# Install/update composer dependencies if vendor is missing or composer.lock changed
if [ ! -f vendor/autoload.php ]; then
    echo "[entrypoint] Running composer install..."
    composer install --no-interaction --no-progress --prefer-dist
fi

exec "$@"
