#!/usr/bin/make

SHELL = /bin/bash

PHP_CLI_CONTAINER_NAME := backend-php-server

docker := $(shell command -v docker 2> /dev/null)
docker_compose := $(shell command -v docker-compose 2> /dev/null)

# Docker aliases
version:
	$(docker_compose) --version

up:
	$(docker_compose) up --build -d

down:
	$(docker_compose) down

restart:
	$(docker_compose) restart


# General aliases
shell:
	$(docker_compose) exec "$(PHP_CLI_CONTAINER_NAME)" /bin/bash

