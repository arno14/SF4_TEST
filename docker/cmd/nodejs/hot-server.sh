#!/bin/bash
docker-compose exec -u `echo $UID` nodejs yarn run encore dev-server --hot --host 0.0.0.0 --port 8032