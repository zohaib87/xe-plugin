
About Xe Plugin
=============

Xe Plugin is a WordPress plugin framework which have built-in functionalities that are used in almost every plugin. So just focus on the main functionality that you want to built for WordPress.

Getting Started
---------------
1. You must have latest version of [Nodejs](https://nodejs.org/en/) installed.
2. Change folder name to your plugin name with `dev` suffix. e.g: `xurais-core-dev`.
3. Open `package.json` with your favorite editor and change `name` eg: `Xurais Core`.
4. Open command line, navigate to project folder and run `npm install` to install dependencies.
5. Now run `node init` command and text-domain, prefixes, DocBlocks etc will be changed automatically to your plugin name.
6. Open main plugin file e.g: `xurais-core.php`, navigate to line `39` and start making an awesome WordPress Plugin. ;-)
7. Once you have completed your plugin run `node build` command to generate a clean copy of plugin without `dev` suffix and a `.pot` file inside languages folder. 

Getting Started The Old Way (Deprecated)
---------------

The first thing you want to do is copy the `xe-plugin` plugin directory and change the name to something else (like, say, `xurais`), and then you'll need to do a eight-step find and replace on the name in all the templates.

1. Search for `'xe-plugin'` (inside single quotations) to capture the text domain.
2. Search for `_xe_plugin_` to capture all the function names.
3. Search for `Text Domain: xe-plugin` 
4. Search for <code>&nbsp;Xe Plugin</code> (with a space before it) to capture DocBlocks.
5. Search for `xe-plugin-` to capture prefixed handles.
6. Search for `$xe_plugin_core` to capture global variables.
7. Search for `Xe_Plugin_` to capture prefixed classes.
8. Search for `/xe-plugin` to capture theme folder names that are used inside plugin.

OR

1. Search for: `'xe-plugin'` and replace with: `'xurais'`
2. Search for: `_xe_plugin_` and replace with: `xurais`
3. Search for `Text Domain: xe-plugin` and replace with `Text Domain: xurais`
4. Search for <code>&nbsp;Xe Plugin</code> (with a space before it) and replace with <code>&nbsp;Xurais</code>
5. Search for `xe-plugin-` and replace with `xurais-`
6. Search for `$xe_plugin_opt` and replace with `$xurais_opt`
7. Search for `Xe_Plugin_` and replace with `Xurais_`
8. Search for `/xe-plugin` and replace with `/xurais`

Then, update the header in `xe-plugin.php` and change its name to your plugin directory name.

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress Plugin. ;-)

Good luck!

Documentation
-------------

[Click Here](http://docs.xecreators.pk/xe-plugin/) to read the documentation.