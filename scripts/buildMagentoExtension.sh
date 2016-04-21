tar cf turnto-magento-extension.tar /Users/jherring/work/turnto/projects/magento-extension/app
mkdir ../build
mv turnto-magento-extension.tar ../build
php ./lib/magento-tar-to-connect.php ./conf/magento-connect-config.php