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
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueuePublic' ] );
    }

    public function enqueue()
    {
        // enqueue all our scripts

        // CSS
        wp_enqueue_style( 'admin', $this->plugin_url . 'src/assets/scss/admin.css', [  ], '1.0.0' );

        // JS
        wp_enqueue_script( 'admin', $this->plugin_url . 'src/assets/js/admin.js', [ 'jquery' ], '1.0.0', false );

        wp_enqueue_script( 'aiob-searchable-select', $this->plugin_url . 'src/assets/js/modules/aiob-searchable-select.js', [ 'jquery' ], '1.0.0', false );
        wp_enqueue_script( 'aiob-multi-select', $this->plugin_url . 'src/assets/js/modules/aiob-multi-select.js', [ 'jquery' ], '1.0.0', false );
    }

    public function enqueuePublic()
    {
        // enqueue all our scripts

        // CSS
        wp_enqueue_style( 'admin', $this->plugin_url . 'src/assets/scss/public.css', [  ], '1.0.0' );

        // JS
        wp_enqueue_script( 'admin', $this->plugin_url . 'src/assets/js/public.js', [ 'jquery' ], '1.0.0', false );
    }
}
