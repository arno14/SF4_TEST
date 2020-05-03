#!/bin/bash
docker-compose exec -u `echo $UID` node yarn encore "$@"