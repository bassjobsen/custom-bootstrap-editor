Custom Bootstrap Editor (WordPress Plugin)
==========================================
Add Twitter's Bootstrap CSS with LESS editor to your site.


Installation
------------

[Download the latest version as .zip file](https://github.com/bassjobsen/custom-bootstrap-editor/archive/master.zip). Upload the .zip file to your Wordpress plugin directory (wp-content/plugin) and use the activate function in your dashboard.
( Plugins > installed plugins ). Go to the settings. Save settings once, even without any code, to create your CSS.

CSS files are saves in `wp-contents/uploads` make sure the directory is writable.

Profits
-------
* Installs the latest version of Twitter's Bootstrap
* No extra checks (server time) to load your lastest CSS
* Overwrite all variables and mixins of Twitter's Bootstrap
* Add new LESS code and mixins

Example
-------
Go to settings. Write `@btn-success-bg:purple;` in the textarea and save. From now all your `<button class="btn btn-success">` 
will be purple instead of green.


Requirements
------------
* [Wordpress](http://wordpress.org/download/) tested with >= 3.6
* A Bootstrap ready WordPress Theme, try [JBST](https://github.com/bassjobsen/jamedo-bootstrap-start-theme/)

Contributions
-------------
This plugin is build with: [LESS.php](https://github.com/oyejorge/less.php)

Support
-------
We are always happy to help you. If you have any question regarding this code. [Send us a message](http://www.jamedowebsites.nl/contact/) or contact us on twitter [@JamedoWebsites](http://twitter.com/JamedoWebsites).

Changelog
---------

1.0

* First version
