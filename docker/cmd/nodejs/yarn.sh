#!/bin/bash
docker-compose exec -u `echo $UID` nodejs yarn "$@"