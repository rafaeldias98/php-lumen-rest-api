#!/bin/bash -e
exec() {
    docker-compose exec database mysql -uname -ppass
}

help() {
    echo 'Available subcommands: exec'
}

[[ -z $@ ]] && (help ; exit 1)
$@
