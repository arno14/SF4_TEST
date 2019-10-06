#!/bin/bash

docker-compose exec -u `echo $UID` phpapache composer validate

docker-compose exec -u `echo $UID` phpapache bin/console lint:yaml config

docker-compose exec -u `echo $UID` phpapache bin/console lint:yaml translations

docker-compose exec -u `echo $UID` phpapache bin/console lint:twig templates

docker-compose exec -u `echo $UID` phpapache vendor/bin/php-cs-fixer fix src --dry-run 

docker-compose exec -u `echo $UID` phpapache vendor/bin/phpstan analyse src --level=7
