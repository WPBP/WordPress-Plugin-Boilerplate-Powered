# WordPress Plugin Boilerplate Powered

<p align="center">
  <img src="https://raw.githubusercontent.com/WPBP/boilerplate-assets/master/icon-256x256.png" alt="Logo">
</p>

[![Backers on Open Collective](https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/backers/badge.svg)](#backers)
[![Sponsors on Open Collective](https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsors/badge.svg)](#sponsors)

**WordPress Plugin Boilerplate Powered** is a complete foundation for building your WordPress plugins following PSR-4 standard.  
The project history is part of the [Wiki](https://wpbp.github.io/wiki.html) that also includes the workflow and how it is organized.

Every experienced WordPress developer uses always the same libraries (or snippets) but at the same time follows best practices.  
Choose a library or a snippet and the boilerplate (with the help of the [Code Generator](https://wpbp.github.io/#generator))
will generate everything without the need of manual copy&paste way or searching on the Internet!

## Features

### Available Libraries and other stuff

* [Code Generator](https://github.com/WPBP/generator) to start development
* Sass support and Grunt (not mandatory because the generator can remove them)
* PSR-4 support by Composer but [extended](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/blob/master/plugin-name/engine/class-initialize.php)
  to load classes based on request type and folder structure
* Tools integrated like [GrumpPHP](https://github.com/phpro/grumphp) (automatically on commit)
  and [PHPStan](https://github.com/phpstan/phpstan/)
* [GitHub Action](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/blob/master/.github/workflows/integrate.yml) and [GitLab CI](https://gist.github.com/Mte90/abbb816e9755f189ad52272e71b7c959) available
* Many libraries already available (with starter code)

| WPBP Libraries  | Other libraries |
| --------------- | --------------- |
| [WPBP/PointerPlus](https://github.com/WPBP/PointerPlus) | [CMB2/CMB2](https://github.com/CMB2/CMB2) |
| [WPBP/CronPlus](https://github.com/WPBP/CronPlus) | [micropackage/requirements](https://github.com/micropackage/requirements) |
| [WPBP/Widgets-Helper](https://github.com/WPBP/Widgets-Helper)  | [yoast/i18n-module](https://github.com/yoast/i18n-module) |
| [WPBP/FakePage](https://github.com/WPBP/FakePage)  | [origgami/CMB2-grid](https://github.com/origgami/cmb2-grid) |
| [WPBP/Template](https://github.com/WPBP/Template)  | [johnbillion/extended-cpts](https://github.com/johnbillion/extended-cpts/) |
| [WPBP/Debug](https://github.com/WPBP/Debug)  | [Freemius/wordpress-sdk](https://github.com/Freemius/wordpress-sdk) |
| [WPBP/CPT_Columns](https://github.com/WPBP/CPT_Columns)  | [wpdesk/wp-notice](https://gitlab.com/wpdesk/wp-notice/-/tree/master) |
| [WPBP/Language](https://github.com/WPBP/Language)  | [julien731/WP-Review-Me](https://github.com/julien731/WP-Review-Me) |
|                 | [stevegrunwell/wp-cache-remember](https://github.com/stevegrunwell/wp-cache-remember) |
|                 | [Seravo/wp-custom-bulk-actions](https://github.com/Seravo/wp-custom-bulk-actions) |
|                 | [yahnis-elsts/plugin-update-checker](https://github.com/YahnisElsts/plugin-update-checker/) |

### Available Snippets

* Dashicons as dependency of admin stylesheet
* Bubble notification on pending CPTs
* Import/Export settings
* Custom capabilities with CPTs and taxonomy support
* `wp_localize_script` for passing PHP variables to JavaScript on the frontend
* Class in frontend body with the slug of plugin
* Shortcode example included
* WP-CLI support
* Support for CMB2 in the options page
* Transient examples with caching

Do you want to see which plugins have been made with this boilerplate?
Check out [this Wiki page](https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/wiki/Plugins-made-with-this-Boilerplate)!  

## Contributors

This project exists thanks to all the people who contribute.
<a href="https://github.com/WPBP/WordPress-Plugin-Boilerplate-Powered/graphs/contributors"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/contributors.svg?width=890"></a>

## Backers

Thank you to all our backers! 🙏
[[Become a backer](https://opencollective.com/WordPress-Plugin-Boilerplate-Powered#backer)]

<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered#backers" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/backers.svg?width=890"></a>

## Sponsors

Support this project by becoming a sponsor.
Your logo will show up here with a link to your website.
[[Become a sponsor](https://opencollective.com/WordPress-Plugin-Boilerplate-Powered#sponsor)]

<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/0/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/0/avatar.svg"></a>
<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/1/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/1/avatar.svg"></a>
<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/2/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/2/avatar.svg"></a>
<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/3/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/3/avatar.svg"></a>
<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/4/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/4/avatar.svg"></a>
<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/5/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/5/avatar.svg"></a>
<a href="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/6/website" target="_blank"><img src="https://opencollective.com/WordPress-Plugin-Boilerplate-Powered/sponsor/6/avatar.svg"></a>

## License

WordPress Plugin Boilerplate Powered is licensed under the GPL v2 or later;
however, if you opt-in to use third-party code that is not compatible with v2,
then you may need to switch to using code that is GPL v3 compatible.
