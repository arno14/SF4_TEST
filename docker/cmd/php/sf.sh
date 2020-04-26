#!/bin/bash
docker-compose exec -u `echo $UID` php bin/console "$@"