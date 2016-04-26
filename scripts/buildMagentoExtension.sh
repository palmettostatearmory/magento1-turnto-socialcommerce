#!/bin/sh

if [ $(git status | grep "modified:" -c) -ne 0 ]
then
  echo "\n*** Found modified files in your path. Please commit and push before building the magento extension.\n"
  //exit
fi

tar cf turnto-magento-extension.tar /Users/jherring/work/turnto/projects/magento-extension/app
mkdir ../build
mv turnto-magento-extension.tar ../build
php ./lib/magento-tar-to-connect.php ./conf/magento-connect-config.php

# create release if user supplied tag
#if [ $# -ne 0 ]
#then
#  echo "Are you sure you want to create a release in GitHub, which will also create a tag (Y/n)?"
#  read -n 1 yesNo
#  echo
#  if [ $yesNo = "Y" ]
#  then
#    # a tag was passed in
#    tag=$1
#    body=$(cat ./conf/releasenotes.txt | sed -e ':a' -e 'N' -e '$!ba' -e 's/\n/ /g')
#    echo '{"tag_name": "v'$tag'", "target_commitish": "master", "name": "TurnTo Magento Extension '$tag'", "body": "'"${body/NEWLINE/NL}"'", "draft": true, "prerelease": true}'
#
#    # make a call to github api to create a release
#    curl -vi \
#      -H "Authorization: token 9bf639104ade6abdca8307aaf9168ca2ff187f11" \
#      -d '{"tag_name": "v'$1'", "target_commitish": "master", "name": "TurnTo Magento Extension '$1'", "body": "'"$body"'", "draft": true, "prerelease": true}' \
#      "https://api.github.com/repos/turnto/magento-extension/releases"
#
#    echo "REMINDER: Can not attach files via the API so you'll need to manually upload the packaged magento extension to the release"
#  else
#    echo "You said no.  Exiting..."
#  fi
#else
#  echo "\n*** Not creating a release because no tag was specified.\n"
#fi

