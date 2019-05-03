#!/bin/bash -e
run() {
    SCRIPTPATH="$( cd "$(dirname "$0")" ; pwd -P )"
    $SCRIPTPATH/test-database.sh create
    docker-compose exec api vendor/bin/phpunit
}

help() {
    echo 'Available subcommands: run'
}

[[ -z $@ ]] && (help ; exit 1)
$@
