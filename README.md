# PHP REST API (Lumen)

#### A simple Docker + PHP REST API using Lumen Framework

## :bookmark: Summary
1. [Requirements](#requirements)
2. [Stack](#stack)
3. [Setup and init API](#setup)
4. [Open API container bash](#api)
5. [Run Tests](#tests)
6. [Connect to mysql shell](#mysql)
7. [Create data to test](#seed)
8. [Generate APIDOC](#docs)
9. [Read docs](#readdocs)
10. [Contribuiting](#contribuiting)

## :ballot_box_with_check: Requirements <a id="requirements"></a>
- :whale: [docker](https://www.docker.com/get-started)
- :octopus: [docker-compose](https://docs.docker.com/compose/install/)

## :open_file_folder: Stack <a id="stack"></a>
- :whale: Docker
- :octopus: Docker Compose
- :elephant: PHP 7
- :dolphin: MySQL 8.0
- :musical_score: Composer
- :bulb: Lumen Framework
- :dog: Dingo

## :rocket: Setup and init API <a id="setup"></a>
```sh
$    cp .env.example .env
$    docker-compose up
```

## :robot: Open API container bash <a id="api"></a>
```sh
$    ./bin/api.sh create
```

## :skull: Run Tests <a id="tests"></a>
```sh
$    ./bin/tests.sh run
```

## :dolphin: Connect to mysql shell <a id="mysql"></a>
```sh
$    ./bin/mysql.sh exec
```

## :scroll: Create data to test <a id="seed"></a>
```sh
$    ./bin/seeder.sh run
```

## :newspaper: Generate APIDOC <a id="docs"></a>
```sh
$    ./bin/doc.sh create
```

## :books: Read docs <a id="readdocs"></a>
- To learn how to use the API, read: docs/APIDOC.md
- To speed up the use of API, see postman requests collection: docs/api_doc.postman_collection.json

## :wrench: Contribuiting [![contributions welcome](https://img.shields.io/badge/contributions-welcome-brightgreen.svg?style=flat)](https://github.com/rafaeldias98/php-lumen-rest-api/issues/new) <a id="contribuiting"></a>
Contribuitions are welcome. If you find any problem or have a suggestion, please [open an issue](https://github.com/rafaeldias98/php-lumen-rest-api/issues/new).
