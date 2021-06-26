
var fs  = require('fs');
var replace = require('replace-in-file');
var config = require('./config.json');
var path = require('path');

var name = config.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');
var nameUnderscores = nameLower.replace(/ /g, '_');

var txtDomain = "'"+nameHyphen+"'";
var funcNames = nameUnderscores+"_";
var styleCss = "Text Domain: "+nameHyphen;
var dockBlocks = " "+name;
var preHandles = nameHyphen+"-";
var gloVars = "$"+nameUnderscores+"_opt";
var preClasses = name.replace(/ /g, '_')+"_";
var folderNames = "/"+nameHyphen;

var currentPlugin = path.resolve(__dirname, '..');

// Replacing strings
var options = {
  files: [
    currentPlugin+'/style.css',
    currentPlugin+'/**/*.php',
    currentPlugin+'/readme.txt',
  ],
  from: [/'xe-plugin'/g, /_xe_plugin_/g, /Text Domain: xe-plugin/g, / Xe Plugin/g, /xe-plugin-/g, /\$xe_plugin_opt/g, /Xe_Plugin_/g, /\/xe-plugin/g],
  to: [txtDomain, funcNames, styleCss, dockBlocks, preHandles, gloVars, preClasses, folderNames],
};

fs.rename(currentPlugin+'/xe-plugin.php', currentPlugin+'/'+nameHyphen+'.php', function(err) {
  if (err) console.log('ERROR: ' + err);
});

try {
  var results = replace.sync(options);
  console.log('Text Domains, Function Names, Dock Blocks, Prefix Handles and Classes replaced.');
  // console.log('Replacement results:', results);
}
catch (error) {
  console.error('Error occurred:', error);
}
