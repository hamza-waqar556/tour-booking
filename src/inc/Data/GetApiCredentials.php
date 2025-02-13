<?php
/**
 * @package TourBooking
 */

namespace Inc\Data;

class GetApiCredentials
{
    private $api_meta_data = [  ];

    public $api_data = [  ];

    public function register()
    {
        $this->getApiMetaData();
        $this->categorizeAPIs();
    }

    public function getApiMetaData()
    {
        $args = [
            'post_type'      => 'api',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
         ];

        $posts = get_posts( $args );

        if ( ! empty( $posts ) ) {
            foreach ( $posts as $post ) {
                $post_id   = $post->ID;
                $meta_data = get_post_meta( $post_id );

                // Filtering and formatting metadata
                $filtered_meta = [  ];
                foreach ( $meta_data as $key => $value ) {
                    if ( ! in_array( $key, [ '_edit_lock', '_edit_last' ] ) ) {
                        // Exclude unwanted keys
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
}
