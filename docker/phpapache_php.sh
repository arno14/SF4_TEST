#!/bin/bash
docker-compose exec -u `echo $UID` phpapache php "$@"