<?php

/**
 * @package TourBooking
 */

namespace Inc\Base;

use \Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueueAdmin' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueuePublic' ] );
    }

    public function enqueueAdmin()
    {

        wp_enqueue_style( 'admin', $this->plugin_url . 'src/assets/admin/scss/admin.min.css', [  ], '1.0.0' );

        wp_enqueue_script( 'admin', $this->plugin_url . 'src/assets/admin/js/admin.min.js', [ 'jquery' ], '1.0.0', false );

    }

    public function enqueuePublic()
    {

        // Custom Files
        wp_enqueue_style( 'main', $this->plugin_url . 'src/assets/public/scss/main.min.css', [  ], '1.0.0', false );
        wp_enqueue_script( 'main', $this->plugin_url . 'src/assets/public/js/main.min.js', [ 'jquery' ], '1.0.0', false );
        // Define jQuery ($) var as global
        wp_add_inline_script( 'jquery', 'var $ = jQuery;' );

        // -> Libraries

        // Font Awesome
        wp_enqueue_style( 'font-awesome', $this->plugin_url . 'src/assets/lib/font-awesome/font-awesome.css', [  ], '1.0.0', false );
        wp_enqueue_script( 'font-awesome', $this->plugin_url . 'src/assets/lib/font-awesome/font-awesome.js', [ 'jquery' ], '1.0.0', false );

        // Bootstrap
        wp_enqueue_style( 'bootstrap', $this->plugin_url . 'src/assets/lib/bootstrap/bootstrap.css', [  ], '1.0.0', false );
        wp_enqueue_script( 'bootstrap', $this->plugin_url . 'src/assets/lib/bootstrap/bootstrap.js', [ 'jquery' ], '1.0.0', false );

        // jQuery-ui
        wp_enqueue_style( 'jquery-ui', $this->plugin_url . 'src/assets/lib/jquery-ui/jquery-ui.css', [  ], '1.0.0', false );
        wp_enqueue_script( 'jquery-ui', $this->plugin_url . 'src/assets/lib/jquery-ui/jquery-ui.js', [ 'jquery' ], '1.0.0', false );

        // select2
        wp_enqueue_style( 'select-2', $this->plugin_url . 'src/assets/lib/select2/select2.css', [  ], '1.0.0', false );
        wp_enqueue_script( 'select-2', $this->plugin_url . 'src/assets/lib/select2/select2.js', [ 'jquery' ], '1.0.0', false );

        // -> Set Ajax Url

        $rest_routes = [
            'search_flights' => esc_url( rest_url( 'aiob/v1/search-flights' ) ),
         ];

        wp_localize_script( 'main', 'AIOB', [
            'ajax_url' => $rest_routes,
            'nonce'    => wp_create_nonce( 'wp_rest' ),
         ] );

    }
}
