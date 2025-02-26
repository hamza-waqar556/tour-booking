<?php
/**
 * @package TourBooking
 */

namespace Inc\Base;

class BaseController
{
    public $plugin;
    public $plugin_url;
    public $plugin_path;
    public $ajax_url;

    // This used for (Settings & Fields) in Admin.php through (SettingsApi.php)
    public $aiob_settings = [  ];
    public $aiob_cpts     = [  ];

    public function __construct()
    {
        $this->plugin_path = plugin_dir_path( dirname( __FILE__, 3 ) );
        $this->plugin_url  = plugin_dir_url( dirname( __FILE__, 3 ) );
        $this->ajax_url      = admin_url( 'admin-ajax.php' );
        $this->plugin      = plugin_basename( dirname( __FILE__, 4 ) ) . '/aio-booking-plugin.php';

        $this->settingsOptions();
    }

    public function settingsOptions()
    {
        $this->aiob_settings = [
            'bookings_cpt'       => 'Activate Booking CPT',
            'flights_cpt'        => 'Activate Flights CPT',
            'tours_cpt'          => 'Activate Tours CPT',
            'car_booking_cpt'    => 'Activate Car CPT',
            'hotels_cpt'         => 'Activate Hotels CPT',
            'add_api_cpt'        => 'Activate API Integration',
            'shortcodes_manager' => 'Activate ShortCodes',
         ];
    }

    public function isActivated( string $key )
    {
        $option = get_option( 'aiob_settings' );
        return isset( $option[ $key ] ) && $option[ $key ];
    }
}
