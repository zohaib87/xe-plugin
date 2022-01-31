
var config = require('./config.json');
var wpPot = require('wp-pot');
var copydir = require('copy-dir');
var path = require('path');
var rimraf = require("rimraf");

var name = config.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');
var nameUnderscores = nameLower.replace(/ /g, '_');

var targetUrl = config.build+'/'+nameHyphen;
var currentPlugin = path.resolve(__dirname, '..');

// Copy Theme
copydir.sync( currentPlugin, targetUrl, {

  utimes: true,  // keep add time and modify time
  mode: true,    // keep file mode
  cover: true,    // cover file when exists, default is true

  filter: function(stat, filepath, filename) {

    // do not want copy directories
    if (stat === 'directory' && path.basename(filename) === '.vscode') {
      return false;
    }
    if (stat === 'directory' && path.basename(filename) === 'node_modules') {
      return false;
    }
    if (stat === 'directory' && path.basename(filename) === 'node_scripts') {
      return false;
    }
    if (stat === 'directory' && path.basename(filename) === 'assets_dev') {
      return false;
    }

    // do not want copy files with specific extension
    if (stat === 'file' && path.extname(filepath) === '.psd') {
      return false;
    }
    if (stat === 'file' && path.extname(filepath) === '.settings') {
      return false;
    }

    // do not want copy files with specific name and extension
    if (stat === 'file' && path.basename(filepath) === 'package.json') {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'package-lock.json') {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'sftp-config.json') {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'build.js') {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'copy.js') {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'init.js') {
      return false;
    }
    if (stat === 'file' && path.basename(filepath) === 'gulpfile.js') {
      return false;
    }

    // do not want copy symbolicLink directories
    if (stat === 'symbolicLink') {
      return false;
    }

    return true;  // remind to return a true value when file check passed.

  }

});
console.log('Plugin copied successfully.');

// Remove unnecessary folders/files.
rimraf.sync(targetUrl+'/.vscode/');
console.log(".vscode folder removed.");

rimraf.sync(targetUrl+'/node_modules/');
console.log("node_modules folder removed.");

rimraf.sync(targetUrl+'/node_scripts/');
console.log("node_scripts folder removed.");

rimraf.sync(targetUrl+'/assets_dev/');
console.log("assets_dev folder removed.");

// Generate POT file.
wpPot({
  destFile: targetUrl+'/languages/'+nameHyphen+'.pot',
  domain: '',
  package: name,
  src: '**/*.php'
});
console.log('POT file Generated.');