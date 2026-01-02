=== Xe Plugin ===
Requires at least: 6
Tested up to: 6.9
Requires PHP: 7.4
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A modern, boilerplate WordPress plugin structure with a streamlined build process — perfect for developers building custom or commercial plugins.

== Description ==

Xe Plugin is a starter boilerplate for WordPress plugin developers. It provides a clean, modular codebase along with a pre-configured build process to speed up plugin development. Designed with scalability in mind, this plugin helps you quickly set up your own functionality — whether you’re building for clients or preparing a product for the marketplace.

**Key Features:**

* Organized file structure following WordPress best practices
* Saves time by providing reusable core plugin features
* Easily extendable to support custom post types, shortcodes, admin pages, and more
* Ideal for rapid development of client projects or commercial plugins

**Who it's for:**

Freelancers, agencies, or product developers who want a reliable, modern foundation for creating powerful WordPress plugins.

== Changelog ==

= 1.3.0 =

* New: Added PSR-4 autoloading.
* New: Added elementor widget samples.
* Updated: Namespaces and class locations.

= 1.2.7 =

* Fixed: Some minor bugs

= 1.2.6 =

* New Added: Page Templates support.
* Updated: Class Views static methods to action hooks.
* Fixed: Some minor bugs.

= 1.2.5 =

* New Added: debug property in Helpers\PluginOptions class.
* Fixed: Some minor bugs.

= 1.2.4 =

* New Added: verify_save method in helpers class.
* Fixed: CSS & Nonce prefixes change on initialization.
* Fixed: Some minor bugs.

= 1.2.3 =

* Fixed: Some minor bugs.

= 1.2.2 =

* Updated: File names according to WP Coding Standards.

= 1.2.1 =

* Fixed: Redundant files download with release.

= 1.2.0 =

* Updated: All functions to Classes except for functions.php file.
* Updated: preClasses to namespaces in init.js for string replacing.
* Removed: copy.js script completely.
* Fixed: Some minor bugs.

= 1.1.14 =

* Fixed: Some minor bugs.

= 1.1.13 =

* New Added: Enqueue method in helper class.
* New Added: localhost variable to localize script.
* New Added: Auto change of global obj prefix in scripts on npm run init.
* Moved: localhost method from helpers class to plugin options class.
* Fixed: Some minor bugs.

= 1.1.12 =

* New Added: Sample classes for product types, custom fields, tabs.
* New Added: Views class for reusable sections.
* New Added: wp_localize_script() function.
* New Added: sanitize_email() and sanitize_url() to update_field().
* Fixed: Plugin options not saving.
* Fixed: Minor bugs.

= 1.1.11 =

* New Added: Shortcode sample.
* New Added: Metabox sample.
* Fixed: Minor bugs.

= 1.1.10 =

* New Added: Sample Plugin Options menu page.
* New Added: Class for default options.

= 1.1.9 =

* New Added: Standalone .pot file generation script.
* Fixed: Generating empty .pot file

= 1.1.8 =

* Fixed: Minor bugs.

= 1.1.7 =

* Fixed: Script version auto changes when file is modified.

= 1.1.6 =

* New Added: Version control in scripts.
* Removed: Repeated code from build.js.
* Removed: TGM plugin activation script.

= 1.1.5 =

* New Added: Custom name for global variable in config.json

= 1.1.4 =

* Removed: Freemius SDK.

= 1.1.3 =

* Fixed: Minor bugs.
* Removed: Support for gulp, concat, minify and image minification.

= 1.1.2 =

* New Added: Freemius SDK
* Fixed: Uninstall function now compatible with Freemius.

= 1.1.1 =

* Fixed: Minor Bugs.

= 1.1.0 =

* New Added: Sample custom post types and taxonomies.
* Updated: Structure is now more like an MVC Framework.

= 1.0.0 =
*Released on 2019/12/29*
