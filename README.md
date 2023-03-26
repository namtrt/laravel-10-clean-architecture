# Laravel 10 clean architechture

Laravel with DDD and clean architecture

## Setup & start
#### 1. Setup Docker
The first, install **Docker** and **Docker Compose**:

- https://docs.docker.com/install/
- https://docs.docker.com/compose/install/

#### 2. Clone source code

Clone this project to your server or local machine.

#### 3. Make config file

Run below command to make config file from sample file:

```bash
cp .env.example .env
```

#### 4. Build & start application
Run following command to build & start your application

```bash
docker-compose up
```

Run in background

```bash
docker-compose up -d
```

#### 5. Install packages

```bash
composer install
```

## Executes tests
```bash
php artisan test
```

## Executes check code quality
```bash
./vendor/bin/rector process
```

## Useful link
- command/bus: https://tactician.thephpleague.com/installation/
- laravel-jwt https://github.com/tymondesigns/jwt-auth
- code quality: https://getrector.com/documentation

