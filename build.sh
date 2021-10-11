#!/usr/bin/env bash

set -eo pipefail

BUILD_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

cd "${BUILD_DIR}" || exit

# install composer
COMPOSER_CACHE_VOLUME=composer-cache
COMPOSER_IMAGE="composer"
COMPOSER_TAG="2.1.9"

docker run --rm -i -t \
    -v ${CACHE_VOLUME}:/tmp \
    -v "${PROJECT_DIR}":/app \
    --user "$(id -u)":"$(id -g)" \
    -w="/app" \
    --entrypoint="/bin/bash" \
    "${COMPOSER_IMAGE}:${COMPOSER_TAG}" \
    -c "composer global require hirak/prestissimo &> /dev/null; composer install --prefer-dist --no-progress --no-interaction --optimize-autoloader"

# build dev and prod images
cd "${BUILD_DIR}/infrastructure" || exit
docker-compose -f docker-compose.yml build