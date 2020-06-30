<?php

/**
 * Plugin Name:       JWP Author Box
 * Plugin URI:        https://github.com/tanmayjay/wordpress/tree/master/11-Users/jwp-author-box
 * Description:       A plugin to add some usermeta for user's social links and show them as user bio under user's posts and also adds a shortcode for enquiry form that is handled using jQuery AJAX.
 * Version:           1.1.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tanmay Kirtania
 * Author URI:        https://linkedin.com/in/tanmay-kirtania
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       jwp-author-box
 * 
 * 
 * Copyright (c) 2020 Tanmay Kirtania (jktanmay@gmail.com). All rights reserved.
 * 
 * This program is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see the License URI.
 */

if ( ! defined('ABSPATH') ) {
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class JWP_Author_Box {
    
    /**
     * Static class object
     *
     * @var object
     */
    private static $instance;

    const version    = '1.1.1';
    const enquiry_sc = 'jwp_ab_enquiry';

    /**
     * Private class constructor
     */
    private function __construct() {
        $this->define_constants();
        register_activation_hook( __FILE__, [ $this, 'activate' ] );
        add_action( 'plugins_loaded', [ $this, 'init_plugin' ] );
    }

    /**
     * Private class cloner
     */
    private function __clone() {}

    /**
     * Initializes a singleton instance
     * 
     * @return \JWP_Author_Box
     */
    public static function get_instance() {

        if ( ! isset( self::$instance ) ) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * Defines the required constants
     *
     * @return void
     */
    public function define_constants() {
        define( 'JWP_AB_VERSION', self::version );
        define( 'JWP_AB_FILE', __FILE__ );
        define( 'JWP_AB_PATH', __DIR__ );
        define( 'JWP_AB_URL', plugins_url( '', JWP_AB_FILE ) );
        define( 'JWP_AB_ASSETS', JWP_AB_URL . '/assets' );
        define( 'JWP_AB_ENQUIRY', self::enquiry_sc );
    }

    /**
     * Updates info on plugin activation
     *
     * @return void
     */
    public function activate() {
        $activator = new JWP\JAB\Activator();
        $activator->run();
    }

    /**
     * Initializes the plugin
     *
     * @return void
     */
    public function init_plugin() {
        
        load_plugin_textdomain( 'jwp-author-box', false, dirname( plugin_basename( __file__ ) ) . '/assets/languages' );

        new JWP\JAB\Assets();
        new JWP\JAB\Frontend();

        if ( is_user_logged_in() ) {
            new JWP\JAB\User();
        }
    }
}

/**
 * Initializes the main plugin
 *
 * @return \JWP_Author_Box
 */
function jwp_author_box() {
    return JWP_Author_Box::get_instance();
}

//kick off the plugin
jwp_author_box();