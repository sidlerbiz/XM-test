# XM Test Project

## Requirements
- PHP 7.4 or higher
- Symfony CLI for local usage
- Docker for container usage
- MySQL

## Local usage
1. Clone project. 
2. Run `docker-compose up -d`
3. Run `docker exec -it php composer install`
4. Run `docker exec -it php bin/console doctrine:migrations:migrate -n`
5. Run `docker exec -it php bin/console app:company-store`
6. Configuration envs need to set in `docker/docker-compose.yaml` or need to create `docker-compose.override.yaml`
7. Open `http://127.0.0.1/historical`

## Tools
- tests: `docker exec -it php bin/phpunit`
