
var fs  = require( 'fs' );
var replace = require( 'replace-in-file' );
var config = require( './config.json' );
var path = require( 'path' );

var name = config.name;
var global = config.global;
var nameLower = name.toLowerCase();
var nameHyphen = nameLower.replace( / /g, '-' );
var nameUnderscores = nameLower.replace( / /g, '_' );

var textDomain = "'"+nameHyphen+"'";
var funcNames = nameUnderscores+"_";
var mainPluginFile = "Text Domain: "+nameHyphen;
var docBlocks = " "+name;
var preHandles = nameHyphen+"-";
var namespaces = name.replace( / /g, '_' )+"\\";
var globalObj = "'"+global+"'";

var currentPlugin = path.resolve( __dirname, '..' );

// Replacing strings
var options = {
  files: [
    currentPlugin+'/**/*.css',
    currentPlugin+'/**/*.php',
    currentPlugin+'/readme.txt',
  ],
  from: [ /'xe-plugin'/g, /_xe_plugin_/g, /Text Domain: xe-plugin/g, / Xe Plugin/g, /xe-plugin-/g, /Xe_Plugin\\/g, /'xePlugin'/g ],
  to: [ textDomain, funcNames, mainPluginFile, docBlocks, preHandles, namespaces, globalObj ],
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
