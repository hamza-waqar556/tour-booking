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
        wp_enqueue_style( 'public', $this->plugin_url . 'src/assets/scss/public.css', [  ], '1.0.0', false );

        // libs
        // bootstrap css
        wp_enqueue_style( 'bootstrap', $this->plugin_url . 'src/assets/libs/css/bootstrap.min.css', [], '5.3', false );
        
        // font awesome css
        wp_enqueue_style( 'font-awesome', $this->plugin_url . 'src/assets/libs/css/font-awesome.css', [], '6.5.1' );

        // date picker css
        wp_enqueue_style( 'jquery-ui', $this->plugin_url . 'src/assets/libs/css/jquery-ui.min.css', [], '1.13.2' );

        // select 2 css
        wp_enqueue_style( 'select2', $this->plugin_url . 'src/assets/libs/css/select2.min.css', [], '4.1.0' );

        // JS
        wp_enqueue_script( 'public', $this->plugin_url . 'src/assets/js/public.js', [ 'jquery' ], '1.0.0', false );

        // libs
        // bootstrap js
        wp_enqueue_script( 'bootstrap', $this->plugin_url . 'src/assets/libs/js/bootstrap.bundle.min.js', [ 'jquery' ], '5.3', false );
        
        // font awesome js
        wp_enqueue_script( 'font-awesome', $this->plugin_url . 'src/assets/libs/js/font-awesome.js', [ 'jquery' ], '6.5.1' );
        
        // date picker js
        wp_enqueue_script( 'jquery-ui', $this->plugin_url . 'src/assets/libs/js/jquery-ui.min.js', [ 'jquery' ], '4.1.0' );
       
        // select 2 js
        wp_enqueue_script( 'select2', $this->plugin_url . 'src/assets/libs/js/select2.min.js', [ 'jquery' ], '1.13.2' );

        
        // shortcodes js 
        // flights js
        wp_enqueue_script( 'flights', $this->plugin_url . 'src/assets/js/shortcodes-js/flights.js', [ 'jquery' ], '1.0.0', false );

    }
}
