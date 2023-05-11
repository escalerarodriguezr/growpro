# Growpro Technical Test + Docker 

## What is this?
This is a PHP Growpro Technical Test which includes `Docker configuration`.

## Usage /app
- `make build` to build the docker environment
- `make run` to spin up containers
- `make restart` to stop and start containers
- `make prepare` to install dependencies
- `make all-tests` to run all test
- `make ssh-be` to access the PHP container bash

## Stack:
- `NGINX 1.19` container
- `PHP 8.0.6 FPM` container
