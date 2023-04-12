CONTAINER_NAME=php-fpm
WORKING_DIR=/app
CONTAINER=docker-compose exec -w $(WORKING_DIR) $(CONTAINER_NAME)

up:
	docker-compose up -d

down:
	docker-compose down

composer-install:
	$(CONTAINER) composer install

test:
	$(CONTAINER) composer tests

check-cs:
	$(CONTAINER) composer check-cs

fix-cs:
	$(CONTAINER) composer fix-cs

phpstan:
	$(CONTAINER) composer phpstan

fixture:
	$(CONTAINER) php ./fixtures/texttest_fixture.php $(count)
