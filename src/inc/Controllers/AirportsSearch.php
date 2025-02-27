<?php
/**
 * Airports Search Class
 *
 * Provides AJAX-based search functionality for airports.
 * It queries the wp_airports table and returns results containing:
 * code, city, state, country, and name.
 *
 * @package TourBooking
 */

namespace Inc\Controllers;

class AirportsSearch {

    /**
     * Registers the AJAX actions.
     */
    public function register() {
        add_action('wp_ajax_searchAirports', [ $this, 'searchAirports' ]);
        add_action('wp_ajax_nopriv_searchAirports', [ $this, 'searchAirports' ]);
    }

    /**
     * AJAX handler for searching airports.
     *
     * Retrieves the search query from $_REQUEST['q'].
     * For queries of at least 2 characters, it splits the query into words and builds
     * a WHERE clause using LIKE conditions on the "code", "city", "state", "country", and "name" columns.
     *
     * Returns up to 6 results.
     *
     * @return void JSON response with the airport data.
     */
    public function searchAirports() {
        global $wpdb;
        $table = $wpdb->prefix . 'airports';
        $q     = isset($_REQUEST['q']) ? sanitize_text_field($_REQUEST['q']) : '';

        if (strlen($q) < 2) {
            wp_send_json_success([]);
        }

        // Split query into words.
        $words        = explode(' ', $q);
        $whereClauses = [];
        $params       = [];

        foreach ($words as $word) {
            $word = trim($word);
            if (empty($word)) {
                continue;
            }
            $like = '%' . $wpdb->esc_like($word) . '%';
            $whereClauses[] = "(code LIKE %s OR city LIKE %s OR state LIKE %s OR country LIKE %s OR name LIKE %s)";
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
            $params[] = $like;
        }

        if (empty($whereClauses)) {
            wp_send_json_success([]);
        }

        $whereSQL = implode(' AND ', $whereClauses);
        $sql      = "SELECT code, city, state, country, name FROM {$table} WHERE {$whereSQL} LIMIT 6";
        $results  = $wpdb->get_results($wpdb->prepare($sql, $params), ARRAY_A);

        wp_send_json_success($results);
    }
}
