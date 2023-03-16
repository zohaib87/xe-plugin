
var fs  = require('fs');
var replace = require('replace-in-file');
var config = require('./config.json');
var path = require('path');

var name = config.name;
var global = config.global;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');
var nameUnderscores = nameLower.replace(/ /g, '_');

var txtDomain = "'"+nameHyphen+"'";
var funcNames = nameUnderscores+"_";
var styleCss = "Text Domain: "+nameHyphen;
var dockBlocks = " "+name;
var preHandles = nameHyphen+"-";
var globalVars = "$"+global+"_opt";
var namespaces = name.replace(/ /g, '_')+"\\";
var folderNames = "/"+nameHyphen;
var globalObj = "'"+global+"Obj'";

var currentPlugin = path.resolve(__dirname, '..');

// Replacing strings
var options = {
  files: [
    currentPlugin+'/**/*.css',
    currentPlugin+'/**/*.php',
    currentPlugin+'/readme.txt',
  ],
  from: [/'xe-plugin'/g, /_xe_plugin_/g, /Text Domain: xe-plugin/g, / Xe Plugin/g, /xe-plugin-/g, /\$xep_opt/g, /Xe_Plugin\\/g, /\/xe-plugin/g, /'xepObj'/g],
  to: [txtDomain, funcNames, styleCss, dockBlocks, preHandles, globalVars, namespaces, folderNames, globalObj],
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
