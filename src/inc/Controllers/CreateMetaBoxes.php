<?php
/**
 * @package TourBooking
 */

namespace Inc\Controllers;

use \Inc\Base\BaseController;
use \Inc\Api\MetaBoxGenerator;

class CreateMetaBoxes extends BaseController
{
    public $mb_generator;
    public $meta_boxes = [  ];

    public function register()
    {
        $this->mb_generator = new MetaBoxGenerator();
        $this->setMetaBoxes();
        $this->mb_generator->register(); // Register after all meta boxes are configured
    }

    public function setMetaBoxes()
    {
        $this->meta_boxes = [
            [
                'flight',
                [ 'status', 'featured', 'departure_time', 'arrival_time', 'currency', 'user_email', 'refundable', 'rating', 'flight_amenities', 'booking_age' ],
                'flight_fields_nonce',
                'flight_fields_nonce_action',
                'flight-custom-fields.php',
             ],
            [
                'hotel',
                [ 'status', 'featured', 'check_in', 'check_out', 'currency', 'user_email', 'refundable', 'rating', 'hotel_amenities', 'booking_age' ],
                'hotel_fields_nonce',
                'hotel_fields_nonce_action',
                'hotel-custom-fields.php',
             ],
            [
                'tour',
                [ 'status', 'featured', 'check_in', 'check_out', 'currency', 'user_email', 'refundable', 'rating', 'hotel_amenities', 'booking_age' ],
                'hotel_fields_nonce',
                'hotel_fields_nonce_action',
                'hotel-custom-fields.php',
             ],
         ];

        foreach ( $this->meta_boxes as $meta_box ) {
            list( $cpt, $fields, $nonce_name, $nonce_action, $template_path ) = $meta_box;
            $this->mb_generator->setConfig( $cpt, $fields, $nonce_name, $nonce_action, $template_path );
        }
    }
}
