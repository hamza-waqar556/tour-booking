<?php
/**
 * @package TourBooking
 */

namespace Inc\Api\Callbacks;

use \Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{
    public function dashboard()
    {
        return require_once "$this->plugin_path/src/templates/admin.php";
    }

    public function cpt()
    {
        return require_once "$this->plugin_path/src/templates/cpt.php";
    }

    public function apiSettings()
    {
        return require_once "$this->plugin_path/src/templates/api-settings.php";
    }

    public function tourBookingTextExample()
    {
        $value = esc_attr( get_option( 'text_example' ) );
        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here!">';
    }

    public function tourBookingFirstName()
    {
        $value = esc_attr( get_option( 'first_name' ) );
        echo '<input type="text" class="regular-text" name="first_name" value="' . $value . '" placeholder="Write something here!">';
    }
}
