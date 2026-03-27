<?php
/**
 * Class for ajax requests.
 *
 * @package Xe Plugin
 */

namespace Xe_Plugin;

class Ajax {

  /**
   * Constructor (optional) for initial setup.
   */
  public function __construct() {}

  /**
   * Register the hooks and filters.
   *
   * @return void
   */
  public function register(): void {

    add_action( 'wp_ajax__xe_plugin_sample', [ $this, 'sample' ] );
    add_action( 'wp_ajax_nopriv__xe_plugin_sample', [ $this, 'sample' ] );

    add_action( 'wp_ajax_nopriv__xe_plugin_user_login', [ $this, 'user_login' ] );
    add_action( 'wp_ajax_nopriv__xe_plugin_reset_password', [ $this, 'reset_password' ] );

  }

  /**
   * Sample ajax request.
   */
  public function sample() {

    check_ajax_referer( '_xe_plugin_ajax_nonce', 'nonce' );

    wp_send_json_error( [
      'message' => 'Ajax request failed.'
    ] );

    wp_send_json_success( [
      'message' => 'Ajax request successful.'
    ] );

  }

  /**
   * Action for the user login ajax request
   */
  public function user_login() {

    check_ajax_referer( '_xe_plugin_ajax_nonce', 'nonce' );

    $success = $error = '';

    if ( isset( $_POST ) ) {

      $user_login = $_POST['user_login'];
      $user_password = $_POST['user_password'];
      $remember_me = $_POST['remember_me'];

      if ( empty( $user_login ) ) {

        $error = esc_html__( 'Username cannot be empty.', 'xe-plugin' );

      } elseif ( empty( $user_password ) ) {

        $error = esc_html__( 'Password cannot be empty.', 'xe-plugin' );

      } else {

        $user_data = '';

        if ( strpos( $user_login, '@' ) ) {

          $user_data = get_user_by( 'email', $user_login );

        }

        if ( empty( $user_data ) ) {

          $user_data = get_user_by( 'login', $user_login );

        }

        if ( empty( $user_data ) ) {

          $error = sprintf(
            esc_html__( '%sError:%s There is no account with that username or email address.', 'xe-plugin' ),
            '<strong>',
            '</strong>'
          );

        } else {

          $user_signon = wp_signon( [
            'user_login' => $user_login,
            'user_password' => $user_password,
            'remember' => $remember_me
          ], is_ssl() );

          if ( is_wp_error( $user_signon ) ) {

            $error = $user_signon->get_error_message();

          } else {

            $success = esc_html__( 'Login successful, redirecting...', 'xe-plugin' );

          }

        }

      }

    }

    echo wp_json_encode( [
      'error' => $error,
      'success' => $success
    ] );

    wp_die();

  }

  /**
   * Action for the user login ajax request
   */
  public function reset_password() {

    check_ajax_referer( '_xe_plugin_ajax_nonce', 'nonce' );

    $success = $error = '';

    if ( isset( $_POST ) ) {

      $user_login = $_POST['user_login'];

      if ( empty( $user_login ) ) {

        $error = esc_html__( 'Username cannot be empty.', 'xe-plugin' );

      } else {

        $user_data = '';

        if ( strpos( $user_login, '@' ) ) {

          $user_data = get_user_by( 'email', $user_login );

        }

        if ( empty( $user_data ) ) {

          $user_data = get_user_by( 'login', $user_login );
          $user_login = $user_data->user_email;

        }

        if ( empty( $user_data ) ) {

          $error = sprintf(
            esc_html__( '%sError:%s There is no account with that username or email address.', 'xe-plugin' ),
            '<strong>',
            '</strong>'
          );

        } else {

          $results = retrieve_password( $user_login );

          if ( $results === true ) {

            $success = sprintf( esc_html__( 'A password reset link was emailed to %s.', 'xe-plugin' ), $user_login );

          } else {

            $error = $results->get_error_message();

          }

        }

      }

    }

    echo wp_json_encode( [
      'error' => $error,
      'success' => $success
    ] );

    wp_die();

  }

}
