<?php
/*
 * Plugin Name:       AIO Booking System
 * Description:       Handle tour bookings with ease.
 * Version:           0.01
 * Author:            Anonymous
 * Text Domain:       tour-booking
 * Domain Path:       /languages
 * Prefix:       aiob
 */

// Prevent direct access to the file
defined( 'ABSPATH' ) or die;

// Add Composer autoload
require_once dirname( __FILE__ ) . '/vendor/autoload.php';

/**
 * The code that runs during plugin activation
 */
function activateAiobPlugin()
{
    Inc\Base\Activate::activate();
}

register_activation_hook( __FILE__, 'activateAiobPlugin' );

/**
 * The code that runs during plugin deactivation
 */
function deactivateAiobPlugin()
{
    Inc\Base\Deactivate::deactivate();
}

register_deactivation_hook( __FILE__, 'deactivateAiobPlugin' );

// Initialize all the core classes of the plugin
if ( class_exists( 'Inc\\Init' ) ) {
    Inc\Init::registerServices();
}
