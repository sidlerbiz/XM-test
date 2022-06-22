# XM Test Project

## Requirements
- PHP 7.4 or higher
- Symfony CLI for local usage
- Docker for container usage
- MySQL

## Local usage
1. Clone project
2. Run `docker-compose up -d --build`
3. Run `docker exec -it php composer install`
4. Run `docker exec -it bin/console doctrine:migrations:migrate -n`
