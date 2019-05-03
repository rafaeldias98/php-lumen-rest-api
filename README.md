# PHP REST API (Lumen)

#### A simple Docker + PHP REST API using Lumen Framework

## :bookmark: Summary
1. [Requirements](#ballot_box_with_check-requirements)
2. [Stack](#open_file_folder-stack)
3. [Setup and init API](#rocket-setup-and-init-api)
4. [Open API container bash](#robot-open-api-container-bash)
5. [Run Tests](#skull-run-tests)
6. [Connect to mysql shell](#dolphin-connect-to-mysql-shell)
7. [Create fake users](#scroll-create-fake-users)
8. [Generate APIDOC](#newspaper-generate-apidoc)
9. [Read docs](#books-read-docs)
10. [Contribuiting](#wrench-contribuiting)

## :ballot_box_with_check: Requirements
- :whale: [docker](https://www.docker.com/get-started)
- :octopus: [docker-compose](https://docs.docker.com/compose/install/)

## :open_file_folder: Stack
- :whale: Docker
- :octopus: Docker Compose
- :elephant: PHP 7
- :dolphin: MySQL 8.0
- :musical_score: Composer
- :bulb: Lumen Framework
- :dog: Dingo

## :rocket: Setup and init API
```sh
$    cp .env.example .env
$    docker-compose up
```

## :robot: Open API container bash
```sh
$    ./bin/api.sh exec
```

## :skull: Run Tests
```sh
$    ./bin/tests.sh run
```

## :dolphin: Connect to mysql shell
```sh
$    ./bin/mysql.sh exec
```

## :scroll: Create fake users
```sh
$    ./bin/seeder.sh run
```

## :newspaper: Generate APIDOC
```sh
$    ./bin/doc.sh create
```

## :books: Read docs
- To learn how to use the API, read: docs/APIDOC.md
- To speed up the use of API, see postman requests collection: docs/api_doc.postman_collection.json

## :wrench: Contribuiting
[![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/rafaeldias98/php-lumen-rest-api/issues/new)

If you find any problem or have a suggestion, please [open an issue](https://github.com/rafaeldias98/php-lumen-rest-api/issues/new).
