/**
 * Authentication JS Start
 */
( function ( $ ) {

  "use strict";

	/**
   * Login
   *
   * @link http://natko.com/wordpress-ajax-login-without-a-plugin-the-right-way/
   */
  $( '#login' ).on( 'submit', function ( e ) {

    e.preventDefault();

		var redirectTo = new URLSearchParams( window.location.search ).get( 'redirect_to' );

		$.ajax( {
			url: xePlugin.ajaxUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: '_xe_plugin_user_login',
				user_login: $( '#user-login' ).val(),
				user_password: $( '#user-password' ).val(),
				remember_me: $( '#remember-me' ).is( ':checked' ) ? true : false,
				nonce: xePlugin.nonce
			},
			beforeSend: function () {

				$( '#login-btn' ).addClass( 'disabled' );
				$( '#alerts' ).html( xemPosAlert( 'info', xePlugin.strings.pleaseWait, true, false ) );

			},
			success: function ( data ) {

				if ( data.error != '' ) {

					$( '#alerts' ).html( xemPosAlert( 'danger', data.error, false, true ) );

				} else if ( data.success != '' ) {

					$( '#alerts' ).html( xemPosAlert( 'success', data.success, false, true ) );

					if ( redirectTo !== null ) {

						window.location.href = redirectTo;

					} else {

						window.location.href = xePlugin.strings.dashboardUrl;

					}

				}

			},
			error: function ( xhr, status, error ) {

				if ( status === 'timeout' ) {

					$( '#alerts' ).html( xemPosAlert( 'danger', xePlugin.string.timeout, false, true ) );

				} else {

					$( '#alerts' ).html( xemPosAlert( 'danger', xePlugin.strings.errorOccurred + error, false, true ) );

				}

			},
			complete: function () {

				$( '#login-btn' ).removeClass( 'disabled' );

			},
		} );

  } );

	/**
	 * Reset password
	 */
	$( '#password-reset' ).on( 'click', function ( e ) {

		e.preventDefault();

		$.ajax( {
			url: xePlugin.ajaxUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: '_xe_plugin_reset_password',
				user_login: $( '#user-login' ).val(),
				nonce: xePlugin.nonce
			},
			beforeSend: function () {

				$( '#reset-btn' ).addClass( 'disabled' );
				$( '#alerts' ).html( xemPosAlert( 'info', xePlugin.strings.pleaseWait, true, false ) );

			},
			success: function ( data ) {

				$( '#reset-btn' ).removeClass( 'disabled' );

				if ( data.error != '' ) {

					$( '#alerts' ).html( xemPosAlert( 'danger', data.error, false, true ) );

				} else if ( data.success != '' ) {

					$( '#alerts' ).html( xemPosAlert( 'success', data.success, false, true ) );

				}

			}
		} );

	} );

} )( jQuery );
