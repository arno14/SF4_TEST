#!/bin/bash

docker-compose exec -u `echo $UID` phpapache composer validate

docker-compose exec -u `echo $UID` phpapache bin/console lint:yaml config

docker-compose exec -u `echo $UID` phpapache bin/console lint:yaml translations

docker-compose exec -u `echo $UID` phpapache bin/console lint:twig templates

docker-compose exec -u `echo $UID` phpapache vendor/bin/php-cs-fixer fix src --dry-run 

docker-compose exec -u `echo $UID` phpapache vendor/bin/phpstan analyse


docker-compose exec -u `echo $UID` nodejs yarn audit

docker-compose exec -u `echo $UID` nodejs node_modules/.bin/retire --ignore bin/.phpunit
# /home/app/bin/.phpunit/phpunit-7.5/vendor/phpunit/php-code-coverage/src/Report/Html/Renderer/Template/js/bootstrap.min.js
#  ↳ bootstrap 4.1.3
# bootstrap 4.1.3 has known vulnerabilities: severity: high; issue: 28236

docker-compose exec -u `echo $UID` nodejs yarn run eslint webpack.config.js

docker-compose exec -u `echo $UID` nodejs yarn run eslint assets/js

docker-compose exec -u `echo $UID` nodejs yarn run eslint assets/js/components/*

docker-compose exec -u `echo $UID` nodejs yarn run encore production