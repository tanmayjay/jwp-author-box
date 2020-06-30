<?php

namespace JWP\JAB\Frontend;

/**
 * Enquiry shortcode handler class
 */
class Enquiry {

    /**
     * Class constructor
     */
    function __construct() {
        add_shortcode( JWP_AB_ENQUIRY, [ $this, 'render_shortcode' ] );
    }

    /**
     * Renders shortcode
     *
     * @param array $atts
     * @param string $content
     * @return string
     */
    public function render_shortcode( $atts, $content = '' ) {
        $this->enqueue_scripts();

        $template = __DIR__ . '/views/enquiry_form.php';

        ob_start();

        if ( file_exists( $template ) ) {
            include $template;
        }
        
        return ob_get_clean();
    }

    /**
     * Enqueues required scripts
     *
     * @return void
     */
    private function enqueue_scripts() {
        wp_enqueue_style( 'jwp-ab-enquiry-style' );
        wp_enqueue_script( 'jwp-ab-enquiry-script' );
    }
}