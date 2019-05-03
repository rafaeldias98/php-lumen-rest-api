#!/bin/bash -e
exec() {
    docker-compose exec api bash
}

help() {
    echo 'Available subcommands: exec'
}

[[ -z $@ ]] && (help ; exit 1)
$@
