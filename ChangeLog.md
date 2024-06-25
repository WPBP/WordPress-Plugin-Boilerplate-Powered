## 3.3.3

* Enhancement: New filter on \Initialize to get the class instance 
* Updated: CS changes
* Updated: to latest libraries changes

## 3.3.2

* Enhancement: Tests use a dedicated .env file instead to manipulate the env file (GitHub/GitLab CI updated)
* Enhancement: Ajax tests improved to work with latest updates
* Enhancement: Improvements on editorconfig support
* Enhancement: New Readme
* Enhancement: NPM and JS stuff improved
* Fix: GitHub CI updated with different NodeJS versions tests

## 3.3.1

* Fix: Replaced Yoast i18n-module with wpbp/i18n-notice to keep support
* Enhancement: Improvements on Initialize for class detection

## 3.3.0

* Enhancement: wp-scripts integration
* Enhancement: Custom block example in React.js
* Enhancement: JS example with REST and nonce
* Enhancement: Page-Madness-Detector and Assets package added
* Enhancement: GitHub Action added Codeception WPunit tests
* Enhancement: Removed `fakepage` library
* Improved: Cli tests better example
* Removed: Grunt replaced by Webpack

## 3.2.7

* Fix: Activation/Deactivation and capabilities are saved rightly
* Enhancement: Removed `language` library
* Updated: i18n-module to a mte90 fork
* CI: readme.txt validation added

## 3.2.6

* Enhancement: Bump PHP minimum requirements to 7.4
* Fix: Some issue on boilerpalte generation

## 3.2.5

* Enhancement: Added support for PHP 8.1
* Enhancement: Updated DB test dump

## 3.2.4

* Changes: Now GPLv3 as default
* Refactor: Is_methods replaced with Context class using inpyside/wpcontext
* Enhancement: Tagged library added
* Enhancement: Improved doc for CMB2
* Enhancement: Updated the dependencies

## 3.2.3

* Enhancement: Now there are constants for minimum php/wp versions
* Enhancement: Added wp-super-duper library
* Updated: CI for latest php versions

## 3.2.2

* Enhancement: Code is fully checked with new GitHub Action for Static Code analysis (PHPStan), Codee Style (PHPCS) and EditorConfig
* Enhancement: Now the code is passing everything from PHPStan to PHPCS
* Fix: example tests cases included

## 3.2.1

* Enhancement: On .env file some parameters are better with apostrophes
* Enhancement: Settings now support better the new improvements to WordPress Visual changes of last releases
* Enhancement: New PHPStan exceptions added
* Fix: ImpExp class wasn't possible to change the file name exported by generator
* Fix: Bubble notification is now removed by the generator
* 
## 3.2.0

* Enhancement: Added micropackage/requirements 
* Enhancement: Added yahnis-elsts/plugin-update-checker
* Enhancement: Improved code style with WPCS
* Enhancement: Updated example pot files with new folder to exclude
* Enhancement: PSR-4 support with file and class renaming
* Enhancement: PHPStan support improved
* Enhancement: Code optimized with PHPStan help
* Enhancement: New `Initialize` class to avoid static class list
* Removed: mte90/wp-contextual-help
* Removed: CoffeeScript support
* Replace: `wordpress-admin-notices` and `WP-Dismissable-Notice-Handler` with `wpdesk/wp-notice`

## 3.1.3

* Enhancement: Bump version of PHP supported to PHP) 7.0
* Enhancement: removed Requirements library as not working anymore

## 3.1.2

* Enhancement: Added Seravo/wp-custom-bulk-actions
* Enhancement: Removed Activity widget support because Extended-Cpts integrated

## 3.1.1

* Fix: Missing 2 placeholders
* Fix: Use `if` for the generation instead of `unless`

## 3.1.0

* Enhancement: Added support for phpstan (it is not complete)
* Enhancement: Scanned the boilerplate with phpstan and fixed some docs issues
* Enhancement: Improved the `Pn_Is` class methods
* Enhancement: Bumped version of few libraries
* Enhancement: Added phpdoc and phpstan to grumphp

## 3.0.3

* Fix: Issue on generation when the library debug is not chosen

## 3.0.2

* Fix: Removed reference to a library for CMB not used anymore
* Fix: Replace all the reference of CMB2 to the new repo
* Enhancement: Added index.php files in folder where was missing

## 3.0.1

* Enhancement: bump of the various packages and tools used to avoid errors

## 3.0.0

* Enhancement: Moved PN_Uninstall.php to uninstall.php
* Enhancement: New folder structure
* Enhancement: New tests for the various suites
* Enhancement: 2 new pages on the wiki https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Useful-resources and https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Cool-libraries
* Enhancement: Added a page about codeception trick on the wiki https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Cool-libraries
* Enhancement: improved Freemius snippet
* Removed: Few libraries that was to much specific
* Removed: Requirements library that doesn't work pretty well
* Added: WP_Query_Multisite library
* Updated: All the composer dependences
* Feature: Block plugin loading/activate if PHP < 5.6
* Feature: Composer for autoloading of Plugin's classes

## 2.2.1

* Many bugfixes and improvements of code indentation

## 2.2.0

* New code for capabilities adding with a upgrade procedure
* New singleton pattern with filters to disable specific classes and other stuff (in few files no singleton anymore)
* Removed assets/bin folders from this repo and moved to different ones
* Updated Composer dependences
* Removed DOM routing because for plugins is better to create specific files to load by php
* Removed Custom actions (hooks, filters, shortcode) because is a choice by the dev where to put them
* New constants for the path of the plugin (used for load/enqueue files)
* Support for Grunt CoffeeScript 2.0.0
* Improved the Act/Deact code
* Updated logo and links on right sidebar box on settings page
* Added FunctionMocker on tests
* Removed `.php_cs` to switch on a parameter to the generator

## 2.1.0

* New css/js file for all the administration and one for the plugin settings page
* Split tabs in the plugin settings page in different files
* Improved the quality code and docs with PHPCS
* Removed At Glance widget for new library that support that
* New folder and files for AJAX on admin and front-end
* Replaced CPT-Core, Taxonomy-Core with Extendend-Cpts, Extendend-Taxos
* Added Whip by Yoast and CMB2 Tabs for post types
* Replace previous package for custom directories with a new one with less dependencies
* Remove athlan/custom-fields-permalink-plugin
* Improving the script `wp-boilerplate-version.sh`

## 2.0.5

* Updated code to load the textdomain using the mo for the last version of WP
* Added Yoast/i18n-module
* Added WPBP/Backbone-Modal-View

## 2.0.4

* WP CLI example code
* Improved PHPDoc comments

## 2.0.3

* Added GrumPHP
* Added unit test with WP-Browser/Codeception
* Updated .php_cs

## 2.0.2

* Fixed few bugs with the generator
* Removed prefix for CMB fields on admin view

## 2.0.1

* Fixed few bugs with the generator

## 2.0.0

* Moved slug, plugin name and version as constants
* File renamed and new positions
* Moved all the libraries to composer
* Added Posts 2 Posts, Custom Fields Permalink, Wp Review Me, WP Dismissible Notice
* New snippet for use the browser push notification by Web Push plugin
* New logo
* Comments inside the code for the new wpbp generator
* Improved code for the filter by cpt
* Uninstall moved inside the plugin
* Improved replace version script

## 1.2.0

* Added Unit test
* Added example for transient with external request
* Improved PHPDoc comment 
* Improved code for shortcode and filter
* Fixed Apigen and [git hook](https://github.com/Mte90/WordPress-Plugin-Boilerplate-Powered/wiki/Hook-for-generate-doc-and-pushing)
* Moved code in class-admin-plugin-name.php in dedicated files
* Moved activaction and deactivation on specific file in public/includes
* Moved help-docs in admin/includes

## 1.1.7

* Support for email template with language detection
* Added CMB2 Google Maps field
* Added Freemius SDK
* Added WP Background Processing
* Added CoffeeScript files and Grunt configuration
* Removed CMB2 Shortcode
* Fix in admin settings CSS
* Improved uninstall.php page

## 1.1.6

* New Debug system for Debug Bar
* Support for activity dashboard widget
* New fields for Widgets Helper Class by riesurya
* Added CronPlus
* CPT_Columns support the sort for custom_value
* Update instructions for PHP CompatInfo 4.x

## 1.1.5

* Moved Export/Import code in a class
* Fix in Fake Page example by jmarceli
* Bump Wordpress version in Readme

## 1.1.4 

* Better comment in the code 
* Pluggable functions added in language.php
* TextDomain in a dedicated file for better priority
* Correct parameter for Apigen
* Integrated CMB2-Grid
* Removed folder public/views

## 1.1.3

* Fix on language.php from overclockk
* Improvment on PHPDoc

## 1.1.2 

* New code of CMB2 with all of the examples in the settings
* Better example reference for requirements.php
* Add custom ctps on the search
* Change the text for the settings page with the plugin name
* Right box for custom image or banner in settings page
* Added CPT_Columns class with new feature
* Improvement and fix to fake-page.php

## 1.1.1

* Added CMB2
* Added CMB2 Shortcode Button
* Added PointerPlus
* Removed CMBF
* Removed CMB

## 1.1.0

* Sass support for the css with Grunt
* Added Class on all the frontend page
* Added Multi CMB in settings page
* Added tabs in settings page
* Added bubble notification on cpt
* Added override system for templates
* Added capabilities creator function
* Added wp_localize_script for PHP var to javascript in frontend
* Added menu page example
* Added wp-boilerplate-version.sh, change the version in the plugins file with a command!
* Fix text-domain wrong
* Fix pn_get_template_part now support a undefined 2 parameter
* Fix __() in CPT/Tax Core
* Fix in admin view because the field are not showed
* Fix support for PHP < 5.3
* Integrated DOM-Based Routing of Roots Template
* Integrated import/export settings system
* Integrated debug system
* Integrated WP Contextual Help for help tabs
* Integrated Requirements library
* Integrated Wp Admin Notice
* Support for PHPCompatInfo that confirm the minimum version PHP 5.2
* Removed deploy.sh (read the readme for useful alternative)

## 1.0.0

* Based on WordPress Plugin Boilerplate 2.6.2 (9 May 2014)
* Added deploy.sh (https://github.com/ericrallen/wp-base-plugin/blob/master/deploy.sh)
* Added Shortcode base code
* Added CPT_Core and Taxonomy_Core
* Added Custom-Metaboxes-and-Fields-for-WordPress (with cmb-field-select2) and Custom-Meta-Boxes
* Added Widget Boilerplate
* Added Dashicon as dependence of admin stylesheet
* Support for CPTs in At glance widget in dashboard
* Support for CMBF in options page
* Added function for custom template (like WooCommerce)
* Added Fake Page class
* Added language function wrapper for WPML/Ceceppa Multilingua/Polylang
