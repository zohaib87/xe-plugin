
var fs  = require('fs');
var replace = require('replace-in-file');
var pk = require('./package.json');

var name = pk.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');
var nameUnderscores = nameLower.replace(/ /g, '_');

var txtDomain = "'"+nameHyphen+"'";
var funcNames = nameUnderscores+"_";
var styleCss = "Text Domain: "+nameHyphen;
var dockBlocks = " "+name;
var preHandles = nameLower+"-";
var gloVars = "$"+nameUnderscores+"_opt";
var preClasses = name.replace(/ /g, '_')+"_";
var folderNames = "/"+nameHyphen;

var options = {
  files: [
    'style.css',
    '**/*.php',
  ],
  from: [/'xe-plugin'/g, /_xe_plugin_/g, /Text Domain: xe-plugin/g, / Xe Plugin/g, /xe-plugin-/g, /\$xe_plugin_opt/g, /Xe_Plugin_/g, /\/xe-plugin/g],
  to: [txtDomain, funcNames, styleCss, dockBlocks, preHandles, gloVars, preClasses, folderNames],
};

fs.rename(__dirname+'/xe-plugin.php', __dirname+'/'+nameHyphen+'.php', function(err) {
    if (err) console.log('ERROR: ' + err);
});

try {
  var results = replace.sync(options);
  console.log('Replacement results:', results);
}
catch (error) {
  console.error('Error occurred:', error);
}