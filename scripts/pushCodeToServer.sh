#!/bin/bash

#usage: ./pushCodeToServer.sh ec2-54-211-93-13.compute-1.amazonaws.com /Users/jherring/aws/jherring.pem /home/bitnami/apps/magento/htdocs bitnami

server=$1;
keyfile=$2;
pathtomagento=$3
user=$4

echo "posting the server $server with key file $keyfile"

scp -r -i $keyfile ../app $user@$server:$pathtomagento
scp -r -i $keyfile ../var $user@$server:$pathtomagento
