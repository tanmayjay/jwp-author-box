<?php

namespace JWP\JAB\User;

/**
 * User handler class
 */
class Profile {

    /**
     * CLass constructor
     */
    function __construct() {
        add_filter( 'user_contactmethods', [ $this, 'add_user_contacts_methods' ] );
    }

    /**
     * Adds user contact methods
     *
     * @param array $methods
     * 
     * @return array
     */
    public function add_user_contacts_methods( $methods ) {
        
        $methods['linkedin'] = __( 'LinkedIn', 'jwp-author-box' );
        $methods['github']   = __( 'GitHub', 'jwp-author-box' );
        $methods['twitter']  = __( 'Twitter', 'jwp-author-box' );
        $methods['facebook'] = __( 'Facebook', 'jwp-author-box' );

        return $methods;
    }
}