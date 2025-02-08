<?php
/**
 * @package TourBooking
 */

namespace Inc\Base;

class Activate
{
    public static function activate()
    {
        flush_rewrite_rules();

        add_option( 'aiob_settings', [  ] );
        add_option( 'aiob_cpts', [  ] );
    }
}
