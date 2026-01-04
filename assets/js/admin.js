/*--------------------------------------------------------------
# Admin Js Start
--------------------------------------------------------------*/
( function ( $ ) {

  'use strict';

	/**
   * Active menu fix
   */
  if ( xePlugin.postType.indexOf( 'xe-plugin-' ) !== -1 && ( xePlugin.base == 'post' || xePlugin.base == 'edit-tags' ) ) {

    $( '#toplevel_page_xe-plugin-options, #toplevel_page_xe-plugin-options > a.toplevel_page_xe-plugin-options' )
      .removeClass( 'wp-not-current-submenu' )
      .addClass( 'wp-has-current-submenu wp-menu-open' );

  }

} )( jQuery );
