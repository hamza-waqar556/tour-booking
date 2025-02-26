<?php

namespace Inc\Routes;

use \WP_REST_Controller;
use \WP_REST_Request;
use \Inc\Data\GetAmendusFlights;

class FlightSearch extends WP_REST_Controller
{

    public function register()
    {
        add_action( 'rest_api_init', [ $this, 'registerRoutes' ] );
    }

    public function registerRoutes()
    {
        register_rest_route( 'aiob/v1', '/search-flights', [
            'methods'             => 'POST',
            'callback'            => [ $this, 'searchFlights' ],
            'permission_callback' => '__return_true',
         ] );
    }

    public function searchFlights( WP_REST_Request $request )
    {
        $params = [
            'originLocationCode'      => sanitize_text_field( $request->get_param( 'origin' ) ),
            'destinationLocationCode' => sanitize_text_field( $request->get_param( 'destination' ) ),
            'departureDate'           => sanitize_text_field( $request->get_param( 'departure_date' ) ),
            'returnDate'              => sanitize_text_field( $request->get_param( 'return_date' ) ),
            'adults'                  => intval( $request->get_param( 'adults' ) ),
            'max'                     => intval( $request->get_param( 'max_results' ) ),
         ];

        $params = array_filter( $params ); // Remove empty values

        $apiResponse = $this->fetchFlightsFromApi( $params );

    }

    public function fetchFlightsFromApi( $params )
    {
        $class = new GetAmendusFlights();
        $class->register()->getFlights( $params );

        return $class->response;
    }
}
