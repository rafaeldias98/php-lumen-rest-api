#!/bin/bash -e
create() {
    docker-compose exec database mysql -uroot -ppass -e "GRANT ALL PRIVILEGES ON *.* TO 'name'@'%';" &>/dev/null
    docker-compose exec database mysql -uname -ppass -e "CREATE DATABASE IF NOT EXISTS users_test;" &>/dev/null
    docker-compose exec database mysql -uname -ppass -e "
        use users_test;
        CREATE TABLE IF NOT EXISTS user (
            id int NOT NULL AUTO_INCREMENT,
            name varchar(100) NOT NULL,
            age int(2) NOT NULL,
            email varchar(100) NOT NULL,
            created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
    " &>/dev/null
}

help() {
    echo 'Available subcommands: create'
}

[[ -z $@ ]] && (help ; exit 1)
$@
