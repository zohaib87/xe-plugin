
var config = require('./config.json');
var fs  = require('fs');
var wpPot = require('wp-pot');
var copydir = require('copy-dir');
var path = require('path');
var rimraf = require("rimraf");

var name = config.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace(/ /g, '-');

var targetUrl = config.build+'/'+nameHyphen;
var currentPlugin = path.resolve(__dirname, '..');

// Delete old folder
fs.rmSync(targetUrl, {
  recursive: true,
  force: true
});
console.log("Old folder removed.");

// Copy Theme
copydir.sync( currentPlugin, targetUrl, {

  utimes: true,  // keep add time and modify time
  mode: true,    // keep file mode
  cover: true,    // cover file when exists, default is true

  filter: function(stat, filepath, filename) {

    // do not want copy files with specific extension
    var extensions = [
      '.psd',
      '.settings'
    ];
    if ( stat === 'file' && extensions.includes(path.extname(filepath)) ) {
      return false;
    }

    // do not want copy files with specific name and extension
    var fileNames = [
      '.gitignore',
      'package.json',
      'package-lock.json',
      'composer.json',
      'composer.lock',
      'sftp-config.json',
      'build.js',
      'copy.js',
      'init.js',
      'browser_sync.js',
      'README.md',
      'LICENSE.md'
    ];
    if (stat === 'file' && fileNames.includes(path.basename(filepath)) ) {
      return false;
    }

    // do not want copy directories
    var directories = [
      '.git',
      '.github',
      '.vscode',
      'node_modules',
      'node_scripts'
    ];
    if ( stat === 'directory' && directories.includes(path.basename(filename)) ) {
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

// Generate POT file.
wpPot({
  destFile: targetUrl+'/languages/'+nameHyphen+'.pot',
  domain: '',
  package: name,
  src: '**/*.php'
});
console.log('POT file Generated.');