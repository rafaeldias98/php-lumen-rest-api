#!/bin/bash -e
create() {
    docker-compose exec api php artisan api:docs --output-file docs/APIDOC.md
}

help() {
    echo 'Available subcommands: create'
}

[[ -z $@ ]] && (help ; exit 1)
$@
