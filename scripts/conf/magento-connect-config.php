<?php
$releaseNotes = str_ireplace('<br>', '', file_get_contents(getcwd() . '/conf/releasenotes.txt'));

return array(

//The base_dir and archive_file path are combined to point to your tar archive
//The basic idea is a separate process builds the tar file, then this finds it
    'base_dir'               => '/Users/jherring/work/turnto/projects/magento-extension/build',
    'archive_files'          => 'turnto-magento-extension.tar',

//The Magento Connect extension name.  Must be unique on Magento Connect
//Has no relation to your code module name.  Will be the Connect extension name
    'extension_name'         => 'socialcommerce_suite_by_turnto',

//Your extension version.  By default, if you're creating an extension from a
//single Magento module, the tar-to-connect script will look to make sure this
//matches the module version.  You can skip this check by setting the
//skip_version_compare value to true
    'extension_version'      => '3.1.12',
    'skip_version_compare'   => false,

//You can also have the package script use the version in the module you
//are packaging with.
    'auto_detect_version'    => false,

//Where on your local system you'd like to build the files to
    'path_output'            => '/Users/jherring/work/turnto/projects/magento-extension/build',

//Magento Connect license value.
    'stability'              => 'stable',

//Magento Connect license value
    'license'                => 'MIT',

//Magento Connect channel value.  This should almost always (always?) be community
    'channel'                => 'community',

//Magento Connect information fields.
    'summary'                => 'Connect your shoppers to your customers',
    'description'            => 'The TurnTo Social Commerce Suite helps you put the good will you have earned from your customers to work by opening direct communications between your shoppers and your past customers.',
    'notes'                  => $releaseNotes,
//Magento Connect author information. If author_email is foo@example.com, script will
//prompt you for the correct name.  Should match your http://www.magentocommerce.com/
//login email address
    'author_name'            => 'TurnTo',
    'author_user'            => 'TurnTo',
    'author_email'           => 'contact@turnto.com',

//PHP min/max fields for Connect.  I don't know if anyone uses these, but you should
//probably check that they're accurate
    'php_min'                => '5.2.0',
    'php_max'                => '6.0.0'
);