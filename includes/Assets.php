<?php

namespace JWP\JAB;

/**
 * Assets handler class
 */
class Assets {
    /**
     * Class constructor
     */
    function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'register_assets'] );
        add_action( 'admin_enqueue_scripts', [ $this, 'register_assets'] );
    }

    /**
     * Retrives stylesheet info
     *
     * @return object
     */
    protected function get_styles() {

        return [
            'jwp-ab-enquiry-style' => [
                'src'  => JWP_AB_ASSETS . '/css/enquiry.css',
                'deps' => false,
                'ver'  => filemtime( JWP_AB_PATH . '/assets/css/enquiry.css' ),
            ],
            'jwp-ab-style' => [
                'src'  => JWP_AB_ASSETS . '/css/style.css',
                'deps' => false,
                'ver'  => filemtime( JWP_AB_PATH . '/assets/css/style.css' ),
            ],
        ];

    }

    /**
     * Retrives scripts info
     *
     * @return object
     */
    protected function get_scripts() {

        return [
            'jwp-ab-enquiry-script' => [
                'src'    => JWP_AB_ASSETS . '/js/enquiry.js',
                'deps'   => [ 'jquery' ],
                'ver'    => filemtime( JWP_AB_PATH . '/assets/js/enquiry.js' ),
                'footer' => true
            ]
        ];
    }

    /**
     * Registers the assets
     *
     * @return void
     */
    public function register_assets() {

        $styles = $this->get_styles();

        foreach ( $styles as $handle => $style ) {

            wp_register_style( $handle, $style['src'], $style['deps'], $style['ver'] );
        }

        $scripts = $this->get_scripts();

        foreach ( $scripts as $handle => $script ) {

            wp_register_script( $handle, $script['src'], $script['deps'], $script['ver'], $script['footer'] );

            if( 'jwp-ab-enquiry-script' == $handle ) {
                wp_localize_script( 
                    $handle, 
                    'jwp_ab', 
                    array(
                        'ajaxurl' => admin_url( 'admin-ajax.php' ),
                        'error'   => __( 'Something went wrong', 'jwp-author-box' )
                    )
                );
            }
        }
    }
}