#!/usr/bin/make

SHELL = /bin/sh

CURRENT_UID := $(shell id -u)
CURRENT_GID := $(shell id -g)

export CURRENT_UID
export CURRENT_GID

env-up:
	chmod -R o+r,o+w pgadmin_storage
	docker-compose up --build
env-start:
	docker-compose start
env-stop:
	docker-compose stop
env-down:
	docker-compose down
php-attach:
	docker exec -u 0 -it tmp_php bash
php-logs:
	docker-compose logs -f php
migrate-up:
	docker-compose exec -u 0 php ./yii migrate --interactive=0
migrate-down:
	docker-compose exec -u 0 php ./yii migrate/down --interactive=0