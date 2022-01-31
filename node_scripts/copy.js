
var config = require('./config.json');
var copydir = require('copy-dir');
var path = require('path');
var rimraf = require("rimraf");

var targetUrl = config.local_repo;
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

    // do not want copy files with specific extension
    if (stat === 'file' && path.extname(filepath) === '.settings' ) {
      return false;
    }

    // do not want copy files with specific name and extension
    if (stat === 'file' && path.basename(filepath) === 'sftp-config.json' ) {
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