<?php

/**
 * @package TourBooking
 */

namespace Inc\Api;

use \Inc\Base\BaseController;

class MetaBoxGenerator extends BaseController
{
    private $meta_boxes = [  ]; // Store all configurations

    public function register()
    {
        add_action( 'add_meta_boxes', [ $this, 'createMetaBoxes' ] );
        add_action( 'save_post', [ $this, 'saveFields' ] );
    }

    public function setConfig( $cpt, $fields, $nonce_name, $nonce_action, $template_path )
    {
        // Store each meta box as an associative array
        $this->meta_boxes[  ] = [
            'cpt'           => $cpt,
            'fields'        => $fields,
            'nonce_name'    => $nonce_name,
            'nonce_action'  => $nonce_action,
            'template_path' => $template_path,
         ];

        return $this; // Enable method chaining
    }

    public function createMetaBoxes()
    {
        foreach ( $this->meta_boxes as $meta_box ) {
            add_meta_box(
                "{$meta_box[ 'cpt' ]}_cpt_fields", // Meta Box ID
                'Additional Information', // Title
                function ( $post ) use ( $meta_box ) {
                    require_once "$this->plugin_path/src/templates/meta-box/{$meta_box[ 'template_path' ]}";
                }, // Callback Function
                $meta_box[ 'cpt' ], // CPT slug
                'normal',
                'high'
            );
        }
    }

    public function saveFields( $post_id )
    {
        foreach ( $this->meta_boxes as $meta_box ) {
            if ( ! isset( $_POST[ $meta_box[ 'nonce_name' ] ] ) || ! wp_verify_nonce( $_POST[ $meta_box[ 'nonce_name' ] ], $meta_box[ 'nonce_action' ] ) ) {
                continue;
            }

            foreach ( $meta_box[ 'fields' ] as $field ) {
                if ( isset( $_POST[ $field ] ) ) {
                    update_post_meta( $post_id, '_' . $field, is_array( $_POST[ $field ] ) ? $_POST[ $field ] : sanitize_text_field( $_POST[ $field ] ) );
                } else {
                    delete_post_meta( $post_id, '_' . $field );
                }
            }
        }
    }
}
