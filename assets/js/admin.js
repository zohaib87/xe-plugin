/*--------------------------------------------------------------
# Admin Js Start
--------------------------------------------------------------*/
( function ( $ ) {

	/**
   * # Active menu fix
   */
  if ( xepObj.postType.indexOf( 'xe-plugin-' ) !== -1 && ( xepObj.base == 'post' || xepObj.base == 'edit-tags' ) ) {

    $( '#toplevel_page_xe-plugin-options, #toplevel_page_xe-plugin-options > a.toplevel_page_xe-plugin-options' )
      .removeClass( 'wp-not-current-submenu' )
      .addClass( 'wp-has-current-submenu wp-menu-open' );

  }

} )( jQuery );
