#WordPress Plugin Boilerplate Powered
<p align="center">
<img src="./plugin-name/assets/icon-256x256.png" alt="Logo" title="Logo">
</p>

**WordPress Plugin Boilerplate Powered** is a complete foundation (without frameworks with many independent libaries ) for building your WordPress plugins.  
*Look in Recommended tools section of this readme for the Yeoman Generator and Vagrant.*   
You want to see which plugins have been made with this boilerplate or add them to the list? Check [here](https://github.com/Mte90/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate)!  
Check the [Wiki](https://github.com/sudar/wp-plugin-in-github/wiki) for other info.

##Features

###Library integrated

* Plugin Boilerplate Powered is based on Plugin Boilerplate by Tom McFarlin
* Checked the minimum version required with PHPCompatInfo (PHP 5.2)
* Sass support with Compass and Grunt
* [CPT Core](https://github.com/jtsternberg/CPT_Core) and [Taxonomy Core](https://github.com/jtsternberg/Taxonomy_Core) integrated
* [CMB2](https://github.com/WebDevStudios/CMB2)
* [CMB2-Shortcode](https://github.com/jtsternberg/Shortcode_Button)
* [CMB2-grid](https://github.com/origgami/CMB2-grid)
* [WordPress Widgets Helper Class](https://github.com/jabga/WordPress-Widgets-Helper-Class) 
* [WP Contextual Help](https://github.com/voceconnect/wp-contextual-help) integrated
* [WP Admin Notice](https://github.com/nathanielks/wordpress-admin-notice) integrated
* [PointerPlus](https://github.com/Mte90/pointerplus) integrated
* Function for custom template (like WooCommerce) in `includes/template.php`
* Fake Page class in `includes/language.php` in `includes/fake-page.php`
* Language function wrapper for WPML/Ceceppa Multilingua/Polylang in `includes/language.php`
* [Modified Debug system](https://github.com/benbalter/wordpress-plugin-boilerplate-classes) in `admin/includes/debug.php`
* [Very modified requirements detection on activation](https://github.com/dsawardekar/wp-requirements) in `public/includes/requirements.php`
* [Modified CPT_Columns](https://en.bainternet.info/custom-post-types-columns/) Class for CPTs columns in `admin/includes/CPT_Columns.php`

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

Check on the [wiki](https://github.com/Mte90/WordPress-Plugin-Boilerplate-Powered/wiki/How-to-the-Script-and-CLI-tool) for discover how to use this script!

###Useful resources or code examples

Check on the [wiki](https://github.com/Mte90/WordPress-Plugin-Boilerplate-Powered/wiki/Useful-resources-or-code-examples)!

##Installation

PS: Use the Yeoman generator in the Generator Tool is better and simple!

1. Copy the `plugin-name` directory into your `wp-content/plugins` directory
2. Navigate to the *Plugins* dashboard page
3. Locate the menu item that reads *TODO*
4. Click on *Activate*

This will activate the WordPress Plugin Boilerplate Powered.  
Because the Boilerplate has no real functionality, nothing will be added to WordPress; however, this demonstrates exactly how your plugin should behave while you're working with the Boilerplate.

###Git Clone
	
	git clone --recursive git@github.com:Mte90/WordPress-Plugin-Boilerplate-Powered.git
	cd WordPress-Plugin-Boilerplate-Powered/plugin-name

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
