
# About Xe Plugin

[![Issues](https://img.shields.io/github/issues/XeCreators/xe-plugin)](https://github.com/XeCreators/xe-plugin/issues)
[![Download Latest](https://img.shields.io/github/downloads/XeCreators/xe-plugin/total)](https://github.com/XeCreators/xe-plugin/releases/latest)
[![Release Latest](https://img.shields.io/github/v/release/XeCreators/xe-plugin?color=yellowgreen)](https://github.com/XeCreators/xe-plugin/releases/latest)
![Repo Size](https://img.shields.io/github/repo-size/XeCreators/xe-plugin.svg)
[![License](https://img.shields.io/badge/License-GPL%202.0-blue.svg)](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html)

Xe Plugin is a starter WordPress plugin which have built-in functionalities that are used in almost every plugin. So just focus on the main functionality that you want to built for WordPress.

## Getting Started

1. You must have latest version of [Nodejs](https://nodejs.org/en/) installed.
2. Install `gulp` globally using `npm install gulp -g` from your command line.
3. Change folder name to your plugin name. e.g: `xurais` or `xu-rais`.
4. Navigate to `node_scripts` folder and open `config.json` with your favorite editor, Change `"name"` to your plugin name eg: `Xurais` or `Xu Rais` and change the `"proxy"` to your local WordPress site url.
5. Open command line, navigate to project folder and run `npm install` to install dependencies.
6. Now run `gulp init` command to automatically change text-domain, prefixes, DocBlocks etc to your plugin name.
7. Run `gulp` command to watch your plugin files for changes and start making an awesome WordPress plugin. ;-)
8. Once you have completed your plugin run `gulp build` command to generate a clean copy of your plugin. `.pot` file will also be generated inside languages folder. 

## Useful Commands

* `gulp css`: Concatenate and minify CSS files.
* `gulp js`: Concatenate and minify JS files.
* `gulp img`: Optimize images.
* To automate all the above just use `gulp`. To stop automation use `CTRL+C` in windows and `CMD+C` on mac.
