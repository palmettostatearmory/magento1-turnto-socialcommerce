#!/usr/bin/env bash

# run on remote server.  script should be placed in magento home

echo "START - cleaning TurnTo install"
rm -rf $1/app/code/community/Turnto
rm -rf $1/app/design/adminhtml/default/default/template/turnto
rm -rf $1/app/design/frontend/base/default/layout/turnto*.xml
rm -rf $1/app/design/frontend/base/default/template/turnto
rm -rf $1/app/etc/modules/Turnto*.xml
echo "END - cleaning TurnTo install"