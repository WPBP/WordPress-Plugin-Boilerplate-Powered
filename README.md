# WordPress Plugin Boilerplate Powered

<p align="center">
  <img src="https://raw.githubusercontent.com/WPBP/boilerplate-assets/master/icon-256x256.png" alt="Logo">
</p>

[![GitHub CI](https://img.shields.io/github/actions/workflow/status/WPBP/WordPress-Plugin-Boilerplate-Powered/integrate.yml)](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/actions)
[![Workflow](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/actions/workflows/integrate.yml/badge.svg)](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/actions)

[Website](https://wpbp.github.io/index.html) | [Wiki](https://wpbp.github.io/wiki.html) | [GitHub](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered) | [Code Generator](https://github.com/WPBP/generator)

**WordPress Plugin Boilerplate Powered** is a complete foundation for building your WordPress plugins following PSR-4 standard.  
The project history is part of the [Wiki](https://wpbp.github.io/wiki.html) that also includes the workflow and how it is organized.  
Every experienced WordPress developer uses always the same libraries (or snippets) but at the same time follows best practices.  
Choose a library or a snippet and the boilerplate (with the help of the [Code Generator](https://wpbp.github.io/#generator)) will generate everything without the need of manual copy & paste way or searching on the Internet!

## Features

* [Code Generator](https://github.com/WPBP/generator) to start development
* Sass support and WebPack (not mandatory because the generator can remove them)
* PSR-4 support by Composer  but [extended](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/blob/master/plugin-name/engine/class-initialize.php) to load classes based on request type and folder structure
  * Tools integrated like [GrumpPHP](https://github.com/phpro/grumphp) (automatically on commit) and [PHPStan](https://github.com/phpstan/phpstan/)
* [GitHub Action](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/blob/master/.github/workflows/integrate.yml) and [GitLab CI](https://gist.github.com/Mte90/abbb816e9755f189ad52272e71b7c959) available
* Many libraries already available (with starter code)

## Generator

The final usage ultimately depends on what you edit in the wpbp.json and composer.json files, and of course any other changes you've made.  
You should be able to run the commands and edit the files mentioned below to get started.  
Read all these links and edit the code however you like using the libraries, snippets, and tools listed below.

> :warning: These steps may be incomplete and need expanded upon and testing. For example, you may also want to run
> tests, Codeception, etc.

1. `wpbp-generator --json` - Generate a new wpbp.json file in the current folder.
2. Edit the wpbp.json to your liking by removing what you don't want.
3. `wpbp-generator` - Download WPBP and extract it to a new folder and removes the parts you don't want.   
   Your new plugin folder is created as a subfolder in the current working directory.
4. `cd your-plugin-folder` - Change into your plugin folder:
5. Edit composer.json and change versions or packages to your liking.
6.
    1. `composer install` - Install fresh with dev files.  
       When moving to production you should run ii and iii instead:
    2. `composer --no-dev update` - Update composer with no dev files.
    3. `composer dumpautoload -o` - Optimize composer
     classes. [More info](https://getcomposer.org/doc/articles/autoloader-optimization.md).
7. `npm install` - Install node packages.
8. `npm run plugin-zip` - Zip plugin files.

> :information_source: `npm pack --dry-run` - You can verify files to zip by running this command.

> :memo: **Remember: Don't edit the vendor or node-modules folders. They are overwritten on updates.**

## Libraries

These are options in wpbp.json.
| WPBP Libraries  | Other libraries |
| --------------- | --------------- |
| [WPBP/PointerPlus](https://github.com/WPBP/PointerPlus)<br>Create a WP Admin wizard-like system.| [CMB2/CMB2](https://github.com/CMB2/CMB2)<br>CMB2 is a developer's toolkit for building metaboxes, custom fields, and forms.|
| [WPBP/CronPlus](https://github.com/WPBP/CronPlus)<br>Add and remove cronjobs.| [micropackage/requirements](https://github.com/micropackage/requirements)<br>A requirements checker.|
| [WPBP/Widgets-Helper](https://github.com/WPBP/Widgets-Helper)<br>A class to ease creating powered Widgets.| [inpsyde/assets](https://github.com/inpsyde/assets)<br>A Composer package to deal with scripts and styles.|
| [WPBP/Page-Madness-Detector](https://github.com/WPBP/Page-Madness-Detector)<br>Detect if the website is using a pagebuilder/visual builder.| [origgami/CMB2-grid](https://github.com/origgami/cmb2-grid)<br>CMB2 grid columns.|
| [WPBP/Template](https://github.com/WPBP/Template)<br>Load template files with autosearch and multilanguage folder for email template.| [johnbillion/extended-cpts](https://github.com/johnbillion/extended-cpts/)<br>A library which provides extended functionality to WordPress custom post types and taxonomies.|
| [WPBP/Debug](https://github.com/WPBP/Debug)<br>Query Monitor Wrapper.| [Freemius/wordpress-sdk](https://github.com/Freemius/wordpress-sdk)<br>Freemius truly empowers developers to create prosperous subscription-based businesses.|
| [WPBP/CPT_Columns](https://github.com/WPBP/CPT_Columns)<br>Improve the CPT list in the backend.| [wpdesk/wp-notice](https://gitlab.com/wpdesk/wp-notice/)<br>Library to display notices in wp-admin.|
| [WPBP/i18n-notice](https://github.com/WPBP/i18n-notice)<br>Handle i18n for plugins, based on Yoast i18n-module.| [julien731/WP-Review-Me](https://github.com/julien731/WP-Review-Me)<br>A lightweight library to include in your WordPress theme/plugin to ask the user to review it on WordPress.org|
|                 | [stevegrunwell/wp-cache-remember](https://github.com/stevegrunwell/wp-cache-remember)<br>Helper for the object cache and transients.|
|                 | [Seravo/wp-custom-bulk-actions](https://github.com/Seravo/wp-custom-bulk-actions)<br>Custom bulk actions for any type of post.|
|                 | [yahnis-elsts/plugin-update-checker](https://github.com/YahnisElsts/plugin-update-checker/)<br>A custom update checker that supports GitHub,GItlab and others.|
|                 | [AyeCode/wp-super-duper](https://github.com/AyeCode/wp-super-duper)<br>A class to build a widget, shortcode and Gutenberg block.|
|                 | [decodelabs/tagged](https://github.com/decodelabs/tagged)<br>PHP markup generation in... PHP.|

## Snippets

> :memo: Specific code snippets already integrated that is possible to remove with the generator

### Backend

* bubble-notification-pending-cpt - Bubble notification on pending CPTs
* donate-link-plugin-list - Add the donate link in the plugin description inside the WP backend
* block support
* impexp-settings - Import/Export settings

### Frontend

* body-class - Class in frontend body with the slug of plugin
* cpt-search-support - Support on frontend to auto add the post type of the plugin to the global search
* wp-localize-script - `wp_localize_script` for passing PHP variables to JavaScript on the frontend
* shortcode - Shortcode example included
* template-system

### System

* capability-system - Custom capabilities with CPTs and taxonomy support
* upgrade-procedure - Basic procedure executed on plugin update
* transient - Transient examples with caching
* rest support

### More...

* Dashicons as dependency of admin stylesheet
* WP-CLI support
* Support for CMB2 in the options page

## Other Tools

[WPBP/tools](https://github.com/WPBP/tools)  
Bash scripts. Currently, has some for wp-bump-version and wp-readme-last-wp-tested.

[CodeAtCode/freemius-suite](https://github.com/CodeAtCode/freemius-suite)  
Suite to package and deploy the free version of the plugin by Freemius on WordPress SVN.

## Made With WPBP

Do you want to see which plugins have been made with this boilerplate?
Check out [this Wiki page](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugins-made-with-this-Boilerplate)!

## License

WordPress Plugin Boilerplate Powered is licensed under the GPL v3 or later;
however, if you opt-in to use third-party code that is not compatible with v3,
then you may need to switch to using code that is GPL v3 compatible.
