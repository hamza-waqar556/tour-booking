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
                [ 'status', 'refundable', 'flight_airlines', 'from_airport', 'to_airport', 'departure_time', 'arrival_time', 'user_email', 'adult_seat_price', 'child_seat_price', 'infant_seat_price', 'duration', 'baggage', 'cabin_baggage', 'flight_type', 'flight_currency' ],
                'flight_fields_nonce',
                'flight_fields_nonce_action',
                'flight-custom-fields.php',
             ],
            [
                'hotel',
                [ 'status', 'featured', 'check_in', 'check_out', 'hotel_currency', 'user_email', 'refundable', 'star', 'rating', 'hotel_amenities', 'booking_age', 'hotel_location','hotel_address', 'hotel_location_code', 'hotel_email', 'hotel_website', 'hotel_phone' ],
                'hotel_fields_nonce',
                'hotel_fields_nonce_action',
                'hotel-custom-fields.php',
             ],
            [
                'tour',
                [ 'currency', 'refundable', 'star', 'rating', 'adult_tour_price', 'child_tour_price' ],
                'tour_fields_nonce',
                'tour_fields_nonce_action',
                'tour-custom-fields.php',
             ],
            [
                'api',
                [ 'status', 'api_name', 'api_type', 'api_key', 'secret_key', 'markup' ],
                'api_fields_nonce',
                'api_fields_nonce_action',
                'api-form.php',
             ],

         ];

        foreach ( $this->meta_boxes as $meta_box ) {
            list( $cpt, $fields, $nonce_name, $nonce_action, $template_path ) = $meta_box;
            $this->mb_generator->setConfig( $cpt, $fields, $nonce_name, $nonce_action, $template_path );
        }
    }
}
