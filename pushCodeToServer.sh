#!/bin/bash

#usage: ./pushCodeToServer ec2-54-205-13-34.compute-1.amazonaws.com /Users/jherring/aws/jherring.pem /home/bitnami/apps/magento/htdocs

server=$1;
keyfile=$2;
pathtomagento=$3
user=$4

echo "posting the server $server with key file $keyfile"

scp -r -i $keyfile app $user@$server:$pathtomagento

