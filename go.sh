#!/bin/sh

sudo service docker start
# sudo docker-compose build
sudo docker-compose up -d

sudo docker exec -it testerdemo_php56_1 bash