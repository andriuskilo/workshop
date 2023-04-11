CONTAINER_NAME=php-fpm
WORKING_DIR=/app
CONTAINER=docker-compose exec -w $(WORKING_DIR) $(CONTAINER_NAME)

up:
	docker-compose up -d

down:
	docker-compose down

composer-install:
	$(CONTAINER) composer install

tests:
	$(CONTAINER) composer tests

phpstan:
	$(CONTAINER) composer phpstan
