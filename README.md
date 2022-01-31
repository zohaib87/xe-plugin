
# About Xe Plugin

[![Issues](https://img.shields.io/github/issues/XeCreators/xe-plugin)](https://github.com/XeCreators/xe-plugin/issues)
[![Download Latest](https://img.shields.io/github/downloads/XeCreators/xe-plugin/total)](https://github.com/XeCreators/xe-plugin/releases/latest)
[![Release Latest](https://img.shields.io/github/v/release/XeCreators/xe-plugin?color=yellowgreen)](https://github.com/XeCreators/xe-plugin/releases/latest)
![Repo Size](https://img.shields.io/github/repo-size/XeCreators/xe-plugin.svg)
[![License](https://img.shields.io/github/license/XeCreators/xe-plugin)](https://github.com/XeCreators/xe-plugin/blob/master/LICENSE.md)

Xe Plugin is a starter WordPress plugin which have built-in functionalities that are used in almost every plugin. So just focus on the main functionality that you want to built for WordPress.

## Getting Started

1. You must have latest version of [Nodejs](https://nodejs.org/en/) installed.
2. Change folder name to your plugin name. e.g: `xurais` or `xu-rais`.
3. Navigate to `node_scripts` folder and open `config.json` with your favorite editor.
4. Change `"name"` to your plugin name eg: `Xurais` or `Xu Rais` and change the `"proxy"` to your local WordPress site url.
5. Open command line, navigate to project folder and run `npm install` to install dependencies.
6. Now run `npm run init` command to automatically change text-domain, prefixes, DocBlocks etc to your plugin name.
7. Run `npm run serve` command to watch your plugin files for changes and auto reload browser. ;-)
8. Once you have completed your plugin run `npm run build` command to generate a clean copy of your plugin. `.pot` file will also be generated inside languages folder. 
9. To stop auto browser reload use `CTRL+C` in windows and `CMD+C` on mac.
