
## About Xe Plugin

[![Issues](https://img.shields.io/github/issues/zohaib87/xe-plugin)](https://github.com/zohaib87/xe-plugin/issues)
[![Release Latest](https://img.shields.io/github/v/release/zohaib87/xe-plugin?color=yellowgreen)](https://github.com/zohaib87/xe-plugin/releases/latest)
[![Downloads](https://img.shields.io/github/downloads/zohaib87/xe-plugin/total)](https://github.com/zohaib87/xe-plugin/releases/latest/download/xe-plugin.zip)
![Repo Size](https://img.shields.io/github/repo-size/zohaib87/xe-plugin.svg)
[![License](https://img.shields.io/github/license/zohaib87/xe-plugin)](https://github.com/zohaib87/xe-plugin/blob/master/LICENSE.md)

Xe Plugin is a starter boilerplate for WordPress plugin developers. It provides a clean, modular codebase along with a pre-configured build process to speed up plugin development. Designed with scalability in mind, this plugin helps you quickly set up your own functionality — whether you’re building for clients or preparing a product for the marketplace.

**Key Features:**

* Organized file structure following WordPress best practices
* Saves time by providing reusable core plugin features
* Easily extendable to support custom post types, shortcodes, admin pages, and more
* Ideal for rapid development of client projects or commercial plugins

**Who it's for:**

Freelancers, agencies, or product developers who want a reliable, modern foundation for creating powerful WordPress plugins.

[![Download Latest Release](https://img.shields.io/badge/Download_Latest_Release-blue?style=for-the-badge)](https://github.com/zohaib87/xe-plugin/releases/latest/download/xe-plugin.zip)
[![Explore Documentation »](https://img.shields.io/badge/Explore_Documentation-282a2e?style=for-the-badge)](https://zohaib87.github.io/xe-plugin)

## Requirements

Latest version of:
* [WordPress](https://wordpress.org/)
* [Composer](https://getcomposer.org)
* PHP 8.0+

## Getting Started

1. Rename the plugin folder to your desired plugin name. Example: `xurais` or `xu-rais`.
2. Open `config.json` with your favorite editor.
    - Change `"name"` to your plugin name eg: `Xurais` or `Xu Rais`.
    - Change `"jsObject"` to a unique JS object name. e.g: `xuRais`.
    - Change `"endpointsKeyPrefix"` to a unique prefix for endpoints. e.g: `xurais` or `xus`.
    - Change `"build"` to your desired folder path.
3. Open command line and navigate to the plugin directory.
4. Run `php xe init` command to change text-domain, prefixes, DocBlocks etc.
5. Run `php xe build` command to generate a clean copy in build folder.

*Note: Translation .pot files are generated inside the languages folder during the build process.*

## Contributing

🖥️ Hello, fellow developer! 🙂

Your [pull requests](https://github.com/zohaib87/xe-plugin/pulls) will be highly welcomed. If you're looking for something to start with, you can check the [issues](https://github.com/zohaib87/xe-plugin/issues) or open one about something you want to contribute and we can discuss it before your pull request.

1. You must have latest version of [WordPress](https://wordpress.org/) and [Composer](https://getcomposer.org).
2. Create a fork of this repository.
3. Clone the fork on your local machine. Your remote repo on Github is called `origin`.
4. Add the original repository as a remote called `upstream`.
5. If you created your fork a while ago be sure to pull upstream changes into your local repository.
6. Create a new branch to work on. Keep in mind that code should meet the [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/).
7. Once changes/feature/fix is completed, push your branch to your fork on Github, the remote `origin`.
8. From your fork open a pull request in the correct branch. Target this project's `main` branch.
