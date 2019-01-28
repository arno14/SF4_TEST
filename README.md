### Sample application ###
using :
- Symfony 4.2
- docker
- webpack / Encore /vue.js


### running this project ###

```
git clone
cp docker-compose.yml.dist docker-compose.yml
docker-compose up -d
docker-compose exec -u `echo $UID` app composer install

docker-compose exec -u `echo $UID` node yarn install

docker-compose exec -u `echo $UID` node yarn encore dev --watch
# or
docker-compose exec -u `echo $UID` node yarn encore dev-server --hot --host 0.0.0.0 --port 8032

docker-compose exec -u `echo $UID` app bin/console doctrine:schema:update --force

docker-compose exec -u `echo $UID` app bin/console hautelook:fixtures:load

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
