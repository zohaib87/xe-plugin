
var config = require('./config.json');
var wpPot = require('wp-pot');
var path = require('path');

var name = config.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');
var currentPlugin = path.resolve(__dirname, '..');

// Generate POT file.
wpPot({
  destFile: currentPlugin+'/languages/'+nameHyphen+'.pot',
  relativeTo: currentPlugin,
  package: name,
  src: currentPlugin+'/**/*.php'
});
console.log('POT file Generated.');
