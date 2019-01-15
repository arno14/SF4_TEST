
### running this project ###

```
git clone
cp docker-compose.yml.dist docker-compose.yml
docker-compose up -d
docker-compose exec -u `echo $UID` app composer install
docker-compose exec -u `echo $UID` app /bin/bash
```

### creation process of this project###

```
### copy the docker-compose.yml 
### copy  the docker/front/Dockerfile
docker-compose build
docker-compose up -d
docker-compose exec -u `echo $UID` app /bin/bash
    mv ./docker /tmp/docker
    mv ./docker-compose.yml /tmp/docker-compose.yml
    composer create-project symfony/skeleton ./
    mv /tmp/docker ./docker 
    mv /tmp/docker-compose.yml ./docker-compose.yml 
```