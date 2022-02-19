#!/bin/bash
set -e

SCRIPT_DIR=$( cd -- "$( dirname -- "${BASH_SOURCE[0]}" )" &> /dev/null && pwd )
ROOT_DIR=$(realpath "${SCRIPT_DIR}/../..")

cd ${ROOT_DIR}

phpcs --standard=PSR12 src/
phpcs --standard=PSR12 tests/

phpstan analyse

vendor/bin/phpunit

echo "Finshed..."
exit 0