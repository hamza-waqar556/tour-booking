<?php

/**
 * @package TourBooking
 */

namespace Inc\Pages;

use \Inc\Base\BaseController;

class HotelCustomFields extends BaseController
{

    public function register()
    {
        add_action( 'add_meta_boxes', [ $this, 'createMetaBoxes' ] );
        add_action( 'save_post', [ $this, 'saveHotelsFields' ] );
    }

    public function createMetaBoxes()
    {
        add_meta_box(
            'hotels_cpt_fields', // Meta Box ID
            'Additional Information', // Title
            [ $this, 'addHotelsFields' ], // Callback Function
            'hotel', // Change this to your CPT slug
            'normal',
            'high'
        );
    }

    public function addHotelsFields( $post )
    {
        return require_once "$this->plugin_path/src/templates/hotel-custom-fields.php";
    }

    public function saveHotelsFields( $post_id )
    {
        if ( ! isset( $_POST[ 'hotel_fields_nonce' ] ) || ! wp_verify_nonce( $_POST[ 'hotel_fields_nonce' ], 'hotel_fields_nonce_action' ) ) {
            return;
        }

        $fields = [ 'status', 'featured', 'check_in', 'check_out', 'currency', 'user_email', 'refundable', 'rating', 'hotel_amenities', 'booking_age' ];

        foreach ( $fields as $field ) {
            if ( isset( $_POST[ $field ] ) ) {
                update_post_meta( $post_id, '_' . $field, is_array( $_POST[ $field ] ) ? $_POST[ $field ] : sanitize_text_field( $_POST[ $field ] ) );
            } else {
                delete_post_meta( $post_id, '_' . $field );
            }
        }
    }

}
