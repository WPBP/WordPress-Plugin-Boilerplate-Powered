#WordPress Plugin Boilerplate Powered
<p align="center">
<img src="./assets/icon-256x256.png" alt="Logo" title="Logo">
</p>

**WordPress Plugin Boilerplate Powered** is a complete foundation for building your WordPress plugins.  
DO you want to see which plugins have been made with this boilerplate or add them to the list? Check [here](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugin-made-with-this-Boilerplate)!  
Check the [Wiki](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/) for other info.

##Features

The mainly purpose of this boilerplate: you choose a library and the boilerpalte contain already the example for use it without need a manual copy&paste way.  
*Look in Recommended tools section of this readme for the Yeoman Generator that clean the boilerplate from the stuff that you don't need.*

###Library integrated

* Sass support with Compass and Grunt
* CoffeeScript support with Grunt (not mandatory with the Yeoman generator)
* Custom folder for Composer libraries
* Many libraries already avalaible (with starter code) in composer.json (with the yeoman generator you can choose)
	* [WPBP/PointerPlus](https://github.com/WPBP/PointerPlus)
	* [WPBP/CronPlus](https://github.com/WPBP/CronPlus)
	* [WPBP/Widgets-Helper](https://github.com/WPBP/Widgets-Helper)
	* [WPBP/FakePage](https://github.com/WPBP/FakePage)
	* [WPBP/Template](https://github.com/WPBP/Template)
	* [WPBP/Debug](https://github.com/WPBP/Debug)
	* [WPBP/CPT_Columns](https://github.com/WPBP/CPT_Columns)
	* [WPBP/Requirements](https://github.com/WPBP/Requirements)
	* [WPBP/Language](https://github.com/WPBP/Language)
	* [WebDevStudios/CMB2](https://github.com/WebDevStudios/CMB2)
	* [voceconnect/wp-contextual-help](https://github.com/voceconnect/wp-contextual-help)
	* [nathanielks/wp-admin-notice](https://github.com/nathanielks/wordpress-admin-notice)
	* [origgami/CMB2-grid](https://github.com/origgami/cmb2-grid)
	* [WebDevStudios/CPT_Core](https://github.com/WebDevStudios/CPT_Core)
	* [WebDevStudios/Taxonomy_Core](https://github.com/WebDevStudios/Taxonomy_Core)
	* [Freemius/wordpress-sdk](https://github.com/Freemius/wordpress-sdk)
	* [julien731/WP-Dismissible-Notices-Handler](https://github.com/julien731/wp-dismissible-notices-handler)
	* [julien731/WP-Review-Me](https://github.com/julien731/WP-Review-Me)
	* [wpackagist-plugin/posts-to-posts](https://github.com/scribu/wp-posts-to-posts)
	* [athlan/custom-fields-permalink-plugin](https://github.com/athlan/wordpress-custom-fields-permalink-plugin)

###Snippet included

* Shortcode example code
* Dashicon as dependence of admin stylesheet
* Bubble notification on pending cpts
* Import/Export settings
* Custom capabilities with cpts and taxonomy support
* wp_localize_script for pass PHP var to JS in the frontend
* Class in frontend body with the slug of plugin
* Support for your CPTs in At Glance widget/Activity widget in dashboard
* Support for CMB in the options page
* Support for email template with language detection
* Integrated DOM-Based Routing of [Roots Template](https://github.com/roots/roots/blob/master/assets/js/_main.js)

##Shell Script & Tools

###Included

* wp-boilerplate-version.sh (check below)
* apigen.sh script for generate a docs folder with the documentation
* .php_cs for [PHP-CS-Fixer](https://github.com/FriendsOfPHP/PHP-CS-Fixer)

Check on the [wiki](https://github.com/Mte90/WordPress-Plugin-Boilerplate-Powered/wiki/How-use-the-Scripts-and-CLI-tools) for discover how to use this script!

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

##Recommended Tools

###Generator Tool

For WordPress Plugin Boilerplate Powered exist a Yeoman generator that allows you to choose the libraries you need with a small customization.  
Link to repo: [https://github.com/Mte90/generator-wp-plugin-boilerplate-powered/](https://github.com/Mte90/generator-wp-plugin-boilerplate-powered/)

##License

The WordPress Plugin Boilerplate Powered is licensed under the GPL v2 or later; however, if you opt to use third-party code that is not compatible with v2, then you may need to switch to using code that is GPL v3 compatible.
