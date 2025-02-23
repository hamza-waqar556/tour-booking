<?php
/**
 * @package TourBooking
 */

namespace Inc\Data;

class GetCptMeta
{
    private $api_meta_data = [  ];

    public $api_data = [  ];

    public function register()
    {

        $args = [
            'post_type'      => 'api',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
         ];

        $this->getPostTypeMetaData( $args );
        $this->categorizeAPIs();

        return $this;
    }

    public function getPostTypeMetaData( $args )
    {

        $posts = get_posts( $args );

        if ( ! empty( $posts ) ) {
            foreach ( $posts as $post ) {
                $post_id   = $post->ID;
                $meta_data = get_post_meta( $post_id );

                $filtered_meta = [  ];
                foreach ( $meta_data as $key => $value ) {
                    if ( ! in_array( $key, [ '_edit_lock', '_edit_last' ] ) ) {
                        $filtered_meta[ $key ] = maybe_unserialize( $value[ 0 ] );
                    }
                }

                $this->api_meta_data[ $post_id ] = $filtered_meta;
            }
        }

    }

    public function categorizeAPIs()
    {
        $categorized = [  ];

        foreach ( $this->api_meta_data as $key => $api ) {
            $type = strtolower( $api[ '_api_type' ] ); // Convert type to lowercase
            $name = $api[ '_api_name' ];

            if ( ! isset( $categorized[ $type ] ) ) {
                $categorized[ $type ] = [  ];
            }

            $categorized[ $type ][ $name ] = $api;
        }

        // update_option('aiob_api_meta', $api_meta_data);

        $this->api_data = $categorized;
    }

    public function getApiCreds( $category, $name )
    {
        // Ensure the api_data property exists and is an array
        if ( ! isset( $this->api_data[ $category ] ) || ! is_array( $this->api_data[ $category ] ) ) {
            return null; // Return null if the category is not found
        }

        // Check if the requested API exists in the category
        if ( ! isset( $this->api_data[ $category ][ $name ] ) ) {
            return null; // Return null if the specific API name is not found
        }

        // Return the API credentials array
        return $this->api_data[ $category ][ $name ];
    }
}
