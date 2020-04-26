#!/bin/bash
docker-compose exec -u `echo $UID` php composer "$@"