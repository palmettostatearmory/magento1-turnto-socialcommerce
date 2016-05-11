# magento-extension<br />

# Installation

Before installing the Magento extension, follow these steps:

1. Login to Magento admin panel
2. If enabled, disable Cache (in System->Cache Management)
3. If enabled, disable Compilation (in System->Tools->Compilation)
4. Logout of Magento admin panel
5. Continue to one of the two installation methods below.

## Installation by copying files

1. Backup Magento /app folder
2. Unzip contents of module's /app directory into Magento /app directory
3. Login back to Magento admin panel
4. Go to Turnto->Integration menu to configure the module
5. Flush Cache and/or Compilation, if desired.
 
## Installation using Modman

1. On the command line, cd to your Magento installation
2. Run these commands: `modman init` and `modman clone git@github.com:turnto/Magento1_TurnTo_SocialCommerce.git`
3. Login back to Magento admin panel
4. Go to System->Configuration->Developer->Template Settings and change "Allow Symlinks" to "Yes"
5. Go to Turnto->Integration menu to configure the module
6. Flush Cache and/or Compilation, if desired.

<h1>Building Extension</h1>
<ul style="list-style:none">
  <li>1. Make sure all config.xml files have been updated to the correct version</li>
  <li>2. Commit changes for release and push to github</li>
  <li>3. Packaged extension will be in &lt;PROJECT_DIRECTORY&lt;/build<li>
</ul>
<h1>Building Extension and Creating a release</h1>
<ul style="list-style:none">
  <li>1. Commit changes for release</li>
  <li>2. Make sure all config.xml files have been updated to the correct version</li>
  <li>3. Run buildMangetoExtension.sh &lt;TAG_NAME&gt;</li>
  <li>4. Packaged extension will be created in &lt;PROJECT_DIRECTORY&gt;/build<li>
</ul>

