# magento-extension<br />
<br />
Magento Extension<br />
1. Login to Magento admin panel<br />
2. If enabled, disable Cache (in System->Cache Management)<br />
3. If enabled, disable Compilation (in System->Tools->Compilation)<br />
4. Logout of Magento admin panel<br />
4. Backup Magento /app folder<br />
5. Unzip contents of module's /app directory into Magento /app directory<br />
6. Login back to Magento admin panel<br />
7. Go to Turnto->Integration menu to configure the module<br />
8. Re-enable Cache and/or Compilation, if desired.<br />
<br />
<br />
<h1>Building Extension</h1>
<ul>
  <li>Make sure all config.xml files have been updated to the correct version</li>
  <li>Commit changes for release and push to github</li>
  <li>Packaged extension will be in <PROJECT_DIRECTORY>/build<li>
</ul>
<h1>Building Extension and Creating a release</h1>
<ul>
  <li>Commit changes for release</li>
  <li>Make sure all config.xml files have been updated to the correct version</li>
  <li>Run buildMangetoExtension.sh &lt;TAG_NAME&gt;</li>
  <li>Packaged extension will be created in &lt;PROJECT_DIRECTORY&gt;/build<li>
</ul>

