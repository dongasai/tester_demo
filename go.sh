#!/bin/bash

sudo service docker start
# sudo docker-compose build
sudo docker-compose up -d

sudo docker exec -it tester_demo_php_1 bash