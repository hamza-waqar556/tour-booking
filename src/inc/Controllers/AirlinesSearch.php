<?php
/**
 * Airlines Search Class
 *
 * Provides AJAX-based search functionality for the airlines.
 * For queries of at least 2 characters, it splits the query into words and builds
 * a WHERE clause using simple LIKE conditions on the "name" and "code" columns.
 *
 * Expected table structure (wp_airlines):
 *   - id   (auto-increment primary key)
 *   - code (holds the original JSON "id" value)
 *   - lcc  (not used in the select)
 *   - name
 *   - logo
 *
 * @package TourBooking
 */

namespace Inc\Controllers;

class AirlinesSearch
{

    /**
     * Registers the AJAX actions.
     */
    public function register()
    {
        add_action( 'wp_ajax_searchAirlines', [ $this, 'searchAirlines' ] );
        add_action( 'wp_ajax_nopriv_searchAirlines', [ $this, 'searchAirlines' ] );
    }

    /**
     * AJAX handler for searching airlines.
     *
     * Retrieves the search query from $_REQUEST['q'].
     * - If the query is less than 2 characters, returns an empty result.
     * - For queries of at least 2 characters, splits the query into words and builds a
     *   WHERE clause using LIKE on both the "name" and "code" columns.
     *
     * Returns up to 6 results.
     *
     * @return void JSON response with the airline data.
     */
    public function searchAirlines()
    {
        global $wpdb;
        $table = $wpdb->prefix . 'airlines';
        $q     = isset( $_REQUEST[ 'q' ] ) ? sanitize_text_field( $_REQUEST[ 'q' ] ) : '';

        // If the query is less than 2 characters, return an empty array.
        if ( strlen( $q ) < 2 ) {
            wp_send_json_success( [  ] );
        }

        // Split query into words.
        $words        = explode( ' ', $q );
        $whereClauses = [  ];
        $params       = [  ];

        // Build where clause for each word.
        foreach ( $words as $word ) {
            $word = trim( $word );
            if ( empty( $word ) ) {
                continue;
            }
            $like             = '%' . $wpdb->esc_like( $word ) . '%';
            $whereClauses[  ] = "(name LIKE %s OR code LIKE %s)";
            $params[  ]       = $like;
            $params[  ]       = $like;
        }

        // If no words remain after trimming.
        if ( empty( $whereClauses ) ) {
            wp_send_json_success( [  ] );
        }

        $whereSQL = implode( ' AND ', $whereClauses );
        $sql      = "SELECT * FROM {$table} WHERE {$whereSQL} LIMIT 6";

        // Prepare and run the query.
        $results = $wpdb->get_results( $wpdb->prepare( $sql, $params ), ARRAY_A );

        wp_send_json_success( $results );
    }
}
