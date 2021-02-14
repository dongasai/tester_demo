#!/bin/bash

sudo service docker start
# sudo docker-compose build
sudo docker-compose -p testerdemo up -d 

sudo docker exec -it testerdemo_php_1 bash