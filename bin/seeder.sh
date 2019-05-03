#!/bin/bash -e
run() {
    docker-compose run api php artisan migrate --seed
}

help() {
    echo 'Available subcommands: run'
}

[[ -z $@ ]] && (help ; exit 1)
$@
