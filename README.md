
About Xe Plugin
=============

Just another WordPress plugin framework.

Getting Started With Xe Plugin
--------------------------------

The first thing you want to do is copy the `xe-plugin` plugin directory and change the name to something else (like, say, `xurais`), and then you'll need to do a eight-step find and replace on the name in all the templates.

1. Search for `'xe-plugin'` (inside single quotations) to capture the text domain.
2. Search for `_xe_plugin_` to capture all the function names.
3. Search for `Text Domain: xe-plugin` 
4. Search for ` Xe Plugin` (with a space before it) to capture DocBlocks.
5. Search for `xe-plugin-` to capture prefixed handles.
6. Search for `$xe_plugin_opt` to capture global variables.
7. Search for `Xe_Plugin_` to capture prefixed classes.
8. Search for `/xe-plugin` to capture theme folder names that are used inside plugin.

OR

1. Search for: `'xe-plugin'` and replace with: `'xurais'`
2. Search for: `_xe_plugin_` and replace with: `xurais`
3. Search for `Text Domain: xe-plugin` and replace with `Text Domain: xurais`
4. Search for ` Xe Plugin` (with a space before it) and replace with `Xurais`
5. Search for `xe-plugin-` and replace with `xurais-`
6. Search for `$xe_plugin_opt` and replace with `$xurais_opt`
7. Search for `Xe_Plugin_` and replace with `Xurais_`
8. Search for `/xe-plugin` and replace with `/xurais`

Then, update the header in `xe-plugin.php` and change its name to your plugin directory name.

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress Plugin. :-)

Good luck!
