
var pk = require('./package.json');
var wpPot = require('wp-pot');
var copydir = require('copy-dir');
var path = require('path');
var rimraf = require("rimraf");

var name = pk.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');
var targetUrl = path.join(__dirname, '..', nameHyphen);

wpPot({
  destFile: 'languages/'+nameHyphen+'.pot',
  domain: '',
  package: name,
  src: '**/*.php'
});
console.log('POT file Generated.');

// Copy Theme
copydir( __dirname, targetUrl, {

  utimes: true,  // keep add time and modify time
  mode: true,    // keep file mode
  cover: true,    // cover file when exists, default is true

  filter: function(stat, filepath, filename) {

    // do not want copy directories
    if (stat === 'directory' && path.basename(filename) === 'node_modules') {
      return false;
    } 

    // do not want copy .html files
    if (stat === 'file' && path.extname(filepath) === '.json' ) {
      return false;
    }
    if (stat === 'file' && path.extname(filepath) === '.settings' ) {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'build.js' ) {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'init.js' ) {
      return false;
    }

    // do not want copy symbolicLink directories
    if (stat === 'symbolicLink') {
      return false;
    }

    return true;  // remind to return a true value when file check passed.

  }

}, function(err) {

  if (err) throw err;

  console.log('Theme copied successfully.');

  rimraf(targetUrl+'/node_modules/', function() {
    console.log("Removing unnecessary folders/files.");
    console.log("All done!");
    console.log(targetUrl);
  });

});

