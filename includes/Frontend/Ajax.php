<?php

namespace JWP\JAB\Frontend;

/**
 * Ajax handler class
 */
class Ajax {
    
    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_ajax_jwp_ab_enquiry', [ $this, 'submit_enquiry' ] );
        add_action( 'wp_ajax_nopriv_jwp_ab_enquiry', [ $this, 'submit_enquiry' ] );
    }

    /**
     * Submits enquiry request
     *
     * @return void
     */
    public function submit_enquiry() {
        
        if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'jwp-ab-enquiry-form' ) ) {
            wp_send_json_error( [
                'message' => 'Authorization Failed!'
            ] );
        }

        $data = array(
            'name' => esc_attr( $_POST['name'] ),
            'email' => esc_attr( $_POST['email'] ),
            'enquiry' => esc_textarea( $_POST['message'] )
        );

        wp_send_json_success( $data );

        wp_send_json_error( [
            'message' => 'Something isn\'t right'
        ] );
    }
}