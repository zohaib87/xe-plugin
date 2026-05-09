
var config = require( './config.json' );
var execSync = require('child_process').execSync;
var path = require( 'path' );

var name = config.name;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace( / /g, '-' );
var currentPlugin = path.resolve( __dirname, '..' );

execSync(
  `wp i18n make-pot "${currentPlugin}" "${currentPlugin}/languages/${nameHyphen}.pot"`,
  { stdio: 'inherit' }
);
