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
  $( '#login_btn' ).on( 'click', function ( e ) {

    e.preventDefault();

		var redirectTo = new URLSearchParams( window.location.search ).get( 'redirect_to' );

		$.ajax( {
			url: xePlugin.ajaxUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'xem_pos_user_login',
				user_login: $( '#user_login' ).val(),
				user_password: $( '#user_password' ).val(),
				remember_me: $( '#remember_me' ).is( ':checked' ) ? true : false,
				nonce: xePlugin.nonce
			},
			beforeSend: function () {

				$( '#login_btn' ).addClass( 'disabled' );
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

						window.location.href = xePlugin.dashboardUrl;

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

				$( '#login_btn' ).removeClass( 'disabled' );

			},
		} );

  } );

	/**
	 * Reset password
	 */
	$( '#reset_btn' ).on( 'click', function ( e ) {

		e.preventDefault();

		$.ajax( {
			url: xePlugin.ajaxUrl,
			method: 'POST',
			dataType: 'json',
			data: {
				action: 'xem_pos_reset_password',
				user_login: $( '#user_login' ).val(),
				nonce: xePlugin.nonce
			},
			beforeSend: function () {

				$( '#reset_btn' ).addClass( 'disabled' );
				$( '#alerts' ).html( xemPosAlert( 'info', xePlugin.strings.pleaseWait, true, false ) );

			},
			success: function ( data ) {

				$( '#reset_btn' ).removeClass( 'disabled' );

				if ( data.error != '' ) {

					$( '#alerts' ).html( xemPosAlert( 'danger', data.error, false, true ) );

				} else if ( data.success != '' ) {

					$( '#alerts' ).html( xemPosAlert( 'success', data.success, false, true ) );

				}

			}
		} );

	} );

} )( jQuery );
