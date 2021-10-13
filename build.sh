#!/usr/bin/env bash

set -eo pipefail

BUILD_DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

# build dev and prod images
cd "${BUILD_DIR}/infrastructure" || exit
docker-compose -f docker-compose.yml build