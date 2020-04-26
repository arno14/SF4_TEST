#!/bin/bash
docker-compose exec -u `echo $UID` node yarn run encore dev-server --hot --host 0.0.0.0 --port 8032