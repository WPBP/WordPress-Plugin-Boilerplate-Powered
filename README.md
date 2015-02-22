# WordPress Plugin Boilerplate Powered
![Logo](./plugin-name/assets/icon-256x256.png)

The WordPress Plugin Boilerplate Powered is a complete foundation (without framework only wrapper) for building your WordPress plugins.  
*Look in Recommended tools section of this readme for the Yeoman Generator and Vagrant.*   
Check the [Wiki](https://github.com/sudar/wp-plugin-in-github/wiki) for other info.

##Features

###Library integrated

* Plugin Boilerplate Powered is based on Plugin Boilerplate by Tom McFarlin
* Checked the minimum version required with PHPCompatInfo (PHP 5.2)
* Sass support with Compass and Grunt
* [CPT Core](https://github.com/jtsternberg/CPT_Core) and [Taxonomy Core](https://github.com/jtsternberg/Taxonomy_Core) integrated
* [CMB2 + Shortcode Button](https://github.com/WebDevStudios/CMB2)
* [Widget Boilerplate](https://github.com/Mte90/WordPress-Widget-Boilerplate) based on https://github.com/tommcfarlin/WordPress-Widget-Boilerplate
* [WP Contextual Help](https://github.com/voceconnect/wp-contextual-help) integrated
* [WP Admin Notice](https://github.com/nathanielks/wordpress-admin-notice) integrated
* [PointerPlus](https://github.com/Mte90/pointerplus) integrated
* Function for custom template (like WooCommerce) in `includes/template.php`
* Fake Page class in `includes/language.php` in `includes/fake-page.php`
* Language function wrapper for WPML/Ceceppa Multilingua/Polylang in `includes/language.php`
* [Modified Debug system](https://github.com/benbalter/wordpress-plugin-boilerplate-classes) in `admin/includes/debug.php`
* [Very modified requirements detection on activation](https://github.com/dsawardekar/wp-requirements) in `public/includes/requirements.php`

###Snippet included

* Shortcode example code
* Dashicon as dependence of admin stylesheet
* Bubble notification on pending cpts
* Import/Export settings
* Custom capabilities with cpts and taxonomy support
* wp_localize_script for pass PHP var to JS in the frontend
* Class in frontend body with the slug of plugin
* Support for your CPTs in At glance widget in dashboard
* Support for CMBF in the options page
* Integrated DOM-Based Routing of [Roots Template](https://github.com/roots/roots/blob/master/assets/js/_main.js)

###WordPress Plugin Boilerplate Feature
* The Plugin Boilerplate Powered is fully-based on the WordPress [Plugin API](http://codex.wordpress.org/Plugin_API).
* Uses [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) conventions to document the code.
* Example values are given, so you can see what needs to be changed.
* Uses a strict file organization scheme to make sure the assets are easily maintainable.
* Note that this boilerplate includes a `.pot` as a starting translation file.

##Shell Script & Tools

###Included

* wp-boilerplate-version.sh (check below)
* phpcompatinfo.json for [PHP Compat Info](https://github.com/llaville/php-compat-info)
* .php_cs for [PHP-CS-Fixer](https://github.com/fabpot/PHP-CS-Fixer)
* apigen.sh script for generate a docs folder with the documentation

####wp-boilerplate-version

USE:

```
wp-boilerplate-version /path/my-new-plugin/ 1.1.1
```
Change the version in README.txt, plugin-slug.php and public/class-plugin-slug.php

Download the script, move in /usr/local/bin and set the permission 
```
wget -O /usr/local/bin/wp-boilerplate-version https://raw.githubusercontent.com/Mte90/WordPress-Plugin-Boilerplate-Powered/master/wp-boilerplate-version.sh | chmod +x /usr/local/bin/wp-boilerplate-version
```

####phpcompatinfo

```
phpcompatinfo analyser:run . --php=">= 5.2"
```

Check if the plugin can work on PHP 5.2 (minimum requirement for WordPress).  
There may be a false positive for ```JSON_PRETTY_PRINT``` but in the code there is a version check for this.

###Suggestion

On [https://github.com/sudar/wp-plugin-in-github](https://github.com/sudar/wp-plugin-in-github) there is many useful snippet for the deploy.  

    clone-from-svn-to-git.sh - Use this script to clone your WordPress Plugins from SVN into git/github
    deploy-plugin.sh - Use this script to push your WordPress Plugin updates to SVN from git/github
    readme-converter.sh - Use this script to convert readme files between Github markdown and WordPress repo markdown format
    create-archive.sh - Use this script to create a zip archive of the Plugin
    update-version.sh - Use this script to update version string in all the files of the Plugin

###Note

* Make Wordpress Core Handbook http://make.wordpress.org/core/handbook/
* Plugin Developer Handbook http://make.wordpress.org/docs/plugin-developer-handbook/
* Theme Developer Handbook https://make.wordpress.org/docs/theme-developer-handbook/
* Custom use of Wordpress Media Picker: https://github.com/thomasgriffin/New-Media-Image-Uploader  
* Useful snippet for wordpress development: https://github.com/richjenks/wp-utils
* WP Code Generator http://generatewp.com/

##Installation

PS: Use the Yeoman generator in the Generator Tool is better and simple!

1. Copy the `plugin-name` directory into your `wp-content/plugins` directory
2. Navigate to the *Plugins* dashboard page
3. Locate the menu item that reads *TODO*
4. Click on *Activate*

This will activate the WordPress Plugin Boilerplate Powered.  
Because the Boilerplate has no real functionality, nothing will be added to WordPress; however, this demonstrates exactly how your plugin should behave while you're working with the Boilerplate.

###Git Clone
	
	git clone https://github.com/Mte90/WordPress-Plugin-Boilerplate-Powered
	cd WordPress-Plugin-Boilerplate-Powered/plugin-name
	git submodule update --init --recursive

##Git update submodule

    git submodule update --recursive
    git submodule foreach git pull origin master

##Recommended Tools

###Generator Tool

For WordPress Plugin Boilerplate Powered exist a Yeoman generator that allows you to choose the libraries you need with a small customization.  
Link to repo: [https://github.com/Mte90/generator-wp-plugin-boilerplate-powered/](https://github.com/Mte90/generator-wp-plugin-boilerplate-powered/)

###Vagrant

Exist also a VVV modded version (Vagrant configuration) called [VVVWPBP](https://github.com/Mte90/VVVWPBP) that contain Compass, PHPCompatInfo, ApiGen and Yeoman for a fast development (the missing tool from the original VVV).

###Localization Tools

The WordPress Plugin Boilerplate uses a variable to store the text domain used when internationalizing strings throughout the Boilerplate. To take advantage of this method,
there are tools that are recommended for providing correct, translatable files:

* [Poedit](http://www.poedit.net/)
* [makepot](http://i18n.svn.wordpress.org/tools/trunk/)
* [i18n](https://github.com/grappler/i18n)
* [grunt-wp-i18n](https://github.com/blazersix/grunt-wp-i18n)

Any of the above tools should provide you with the proper tooling to localize the plugin.

##License

The WordPress Plugin Boilerplate Powered is licensed under the GPL v2 or later; however, if you opt to use third-party code that is not compatible with v2, then you may need to switch to using code that is GPL v3 compatible.

> This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

For reference, [here's a discussion](http://make.wordpress.org/themes/2013/03/04/licensing-note-apache-and-gpl/) that covers the Apache 2.0 License used by [Bootstrap](http://twitter.github.io/bootstrap/).
