# WordPress Plugin Boilerplate Powered

The WordPress Plugin Boilerplate Powered is a complete powered foundation for building your WordPress plugins.  
Look in Recommended tools section of this readme for the Yeoman Generator.  
Check the [Wiki](https://github.com/sudar/wp-plugin-in-github/wiki) for other info.

##Features

###Library integrated

* Plugin Boilerplate Powered is based on Plugin Boilerplate by Tom McFarlin
* Checked the minimum version required with PHPCompatInfo (PHP 5.2)
* [CPT Core](https://github.com/jtsternberg/CPT_Core) and [Taxonomy Core](https://github.com/jtsternberg/Taxonomy_Core) integrated
* [CMBF + Select2](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress) and [CMB](https://github.com/humanmade/Custom-Meta-Boxes)
* [Widget Boilerplate](https://github.com/Mte90/WordPress-Widget-Boilerplate) based on https://github.com/tommcfarlin/WordPress-Widget-Boilerplate
* [WP Contextual Help](https://github.com/voceconnect/wp-contextual-help) integrated
* Added function for custom template (like WooCommerce) in `includes/template.php`
* Added Fake Page class in `includes/language.php` in `includes/fake-page.php`
* Added language function wrapper for WPML/Ceceppa Multilingua/Polylang in `includes/language.php`
* Added [modified Debug system](https://github.com/benbalter/wordpress-plugin-boilerplate-classes) in `admin/includes/debug.php`
* Added [very modified requirements check on activation](https://github.com/dsawardekar/wp-requirements) in `public/includes/requirements.php`

###Snippet included

* Shortcode example code
* Dashicon as dependence of admin stylesheet
* Added bubble notification on cpts
* Import/export settings
* Custom capabilities with cpts and taxonomy support
* wp_localize_dscript for pass PHP var to JS in the frontend
* Added class in frontend body with the slug of plugin
* Support for your CPTs in At glance widget in dashboard
* Support for CMBF in the options page
* Integrated DOM-Based Routing of [Roots Template](https://github.com/roots/roots/blob/master/assets/js/_main.js)

###WordPress Plugin Boilerplate Feature
* The Plugin Boilerplate Powered is fully-based on the WordPress [Plugin API](http://codex.wordpress.org/Plugin_API).
* Uses [PHPDoc](http://en.wikipedia.org/wiki/PHPDoc) conventions to document the code.
* Example values are given, so you can see what needs to be changed.
* Uses a strict file organization scheme to make sure the assets are easily maintainable.
* Note that this boilerplate includes a `.pot` as a starting translation file.

###Extra

* deploy.sh script for simple upload on Wordpress.Org SVN
* phpcompatinfo.json for [PHP Compat Info](https://github.com/llaville/php-compat-info)
* .php_cs for [PHP-CS-Fixer](https://github.com/fabpot/PHP-CS-Fixer)

###Note

* Make Wordpress Core Handbook http://make.wordpress.org/core/handbook/
* Plugin Developer Handbook http://make.wordpress.org/docs/plugin-developer-handbook/
* Theme Developer Handbook https://make.wordpress.org/docs/theme-developer-handbook/
* Support for a custom use of Wordpress Media Picker: https://github.com/thomasgriffin/New-Media-Image-Uploader  
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

##Recommended Tools

###Generator Tool

For WordPress Plugin Boilerplate Powered exist a Yeoman generator that allows you to choose the libraries you need with a small customization.  
Link to repo: [https://github.com/Mte90/generator-wp-plugin-boilerplate-powered/](https://github.com/Mte90/generator-wp-plugin-boilerplate-powered/)

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
