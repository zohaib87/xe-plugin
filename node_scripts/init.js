
var fs  = require( 'fs' );
var replace = require( 'replace-in-file' );
var config = require( './config.json' );
var path = require( 'path' );

var name = config.name;
var global = config.global;
var nameLower = name.toLowerCase();
var nameUpper = name.toUpperCase();
var nameHyphen = nameLower.replace( / /g, '-' );
var nameUnderscores = nameLower.replace( / /g, '_' );

var textDomain = "'"+nameHyphen+"'";
var funcNames = nameUnderscores;
var mainPluginFile = "Text Domain: "+nameHyphen;
var docBlocks = " "+name;
var preHandles = nameHyphen+"-";
var namespaces = name.replace( / /g, '_' );
var globals = nameUpper.replace( / /g, '_' )+"_";
var globalObj = "'"+global+"'";

var currentPlugin = path.resolve( __dirname, '..' );

// Replacing strings
var options = {
  files: [
    currentPlugin+'/**/*.css',
    currentPlugin+'/**/*.php',
    currentPlugin+'/readme.txt',
    currentPlugin+'/composer.json'
  ],
  from: [ /'xe-plugin'/g, /_xe_plugin/g, /Text Domain: xe-plugin/g, / Xe Plugin/g, /xe-plugin-/g, /Xe_Plugin/g, /XE_PLUGIN_/g, /'xePlugin'/g ],
  to: [ textDomain, funcNames, mainPluginFile, docBlocks, preHandles, namespaces, globals, globalObj ],
};

fs.rename( currentPlugin+'/xe-plugin.php', currentPlugin+'/'+nameHyphen+'.php', function( error ) {

  if ( error ) console.log( 'ERROR: ' + error );

} );

try {

  var results = replace.sync( options );

  console.log( 'Text Domains, Function Names, Dock Blocks, Prefix Handles and Classes replaced.' );
  // console.log( 'Replacement results:', results );

}
catch ( error ) {

  console.error( 'Error occurred:', error );

}
