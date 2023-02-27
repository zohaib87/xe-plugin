
# About Xe Plugin

[![Issues](https://img.shields.io/github/issues/XeCreators/xe-plugin)](https://github.com/XeCreators/xe-plugin/issues)
[![Release Latest](https://img.shields.io/github/v/release/XeCreators/xe-plugin?color=yellowgreen)](https://github.com/XeCreators/xe-plugin/releases/latest)
[![Downloads](https://img.shields.io/github/downloads/XeCreators/xe-plugin/total)](https://github.com/XeCreators/xe-plugin/releases/latest)
![Repo Size](https://img.shields.io/github/repo-size/XeCreators/xe-plugin.svg)
[![License](https://img.shields.io/github/license/XeCreators/xe-plugin)](https://github.com/XeCreators/xe-plugin/blob/master/LICENSE.md)

Xe Plugin is a starter WordPress plugin which have built-in functionalities that are used in almost every plugin. So just focus on the main functionality that you want to built for WordPress.

[Explore Documentation »](https://xecreators.github.io/xe-plugin)

## Requirements

* Latest versions of [WordPress](https://wordpress.org/) and [Nodejs](https://nodejs.org/en/).

## Download

You can download the [latest stable release](https://github.com/XeCreators/xe-plugin/releases/latest) or use the following command if you have `composer` installed.

    composer create-project xecreators/xe-plugin

## Getting Started

1. Change folder name to your plugin name. e.g: `xurais` or `xu-rais`.
2. Navigate to `node_scripts` folder and open `config.json` with your favorite editor.
    - Change `"name"` to your plugin name eg: `Xurais` or `Xu Rais`.
    - Change `"global"` to a unique prefix. e.g: `xurais` or `xus`.
    - Change `"build"` to your desired folder path.
3. Open command line, navigate to project folder and run `npm install` to install dependencies.
4. Run `npm run init` command to change text-domain, prefixes, DocBlocks etc.
5. Run `npm run build` command to generate a clean copy in destination folder.

*Note: `.pot` file will also be generated inside languages folder.*
