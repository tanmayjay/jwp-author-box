<?php

namespace JWP\JAB;

/**
 * Frontend handler class
 */
class Frontend {

    /**
     * Class constructor
     */
    function __construct() {

        if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            new Frontend\Ajax();
        }

        new Frontend\Author_Box();
        new Frontend\Enquiry();
    }
}