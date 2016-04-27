#!/bin/bash



#usage: ./pushCodeToServer.sh ec2-54-211-93-13.compute-1.amazonaws.com /Users/jherring/aws/jherring.pem /home/bitnami/apps/magento/htdocs bitnami [clean]

server=$1;
keyfile=$2;
pathtomagento=$3
user=$4

echo "posting the server $server with key file $keyfile"

if [ $5 == "clean" ]
then
  scp -r -i $keyfile cleanMagento.sh $user@$server:$pathtomagento
  ssh -i $keyfile $user@$server "chmod +x "$pathtomagento"/cleanMagento.sh"
  ssh -i $keyfile $user@$server "$pathtomagento/cleanMagento.sh $pathtomagento"
else
  scp -r -i $keyfile ../app $user@$server:$pathtomagento
fi



