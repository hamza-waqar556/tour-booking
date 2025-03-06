<?php

namespace Inc\Routes;

use WP_REST_Controller;
use WP_REST_Request;
use WP_REST_Response;
use Inc\Data\Flights\GetAmendusFlights;
use Inc\Api\CptQueryHandler;

class FlightSearch extends WP_REST_Controller
{
    /**
     * Registers the REST API routes.
     */
    public function register()
    {
        add_action('rest_api_init', [$this, 'registerRoutes']);
    }

    /**
     * Defines the custom REST API routes.
     */
    public function registerRoutes()
    {
        register_rest_route('aiob/v1', '/search-flights', [
            'methods'             => 'POST',
            'callback'            => [$this, 'searchFlights'],
            'permission_callback' => '__return_true',
        ]);
    }

    /**
     * Handles the flight search request from the frontend.
     * 
     * @param WP_REST_Request $request
     * @return WP_REST_Response
     */
    public function searchFlights(WP_REST_Request $request)
    {
        // Sanitize and retrieve request parameters
        $params = [
            'origin_code'      => sanitize_text_field($request->get_param('origin_code')),
            'destination_code' => sanitize_text_field($request->get_param('destination_code')),
            'departure_date'   => sanitize_text_field($request->get_param('departure_date')),
            'return_date'      => sanitize_text_field($request->get_param('return_date')),
            'adults'           => intval($request->get_param('adults')),
            'children'         => intval($request->get_param('children')),
            'infants'          => intval($request->get_param('infants')),
            'max_results'      => intval($request->get_param('max_results')),
        ];

        // Remove empty values from the parameters
        $params = array_filter($params);

        // Fetch flights from external API
        $apiResponse = $this->fetchFlightsFromApi($params);

        // Fetch flights from local CPT
        $cptResponse = $this->fetchFlightsFromCpt($params);

        // Combine both API and CPT responses (you may need to merge intelligently)
        return $this->returnRestResponse([
            'api_flights' => $apiResponse,
            'cpt_flights' => $cptResponse
        ]);
    }

    /**
     * Fetches flights from the external API.
     * 
     * @param array $params
     * @return mixed
     */
    public function fetchFlightsFromApi($params)
    {
        $class = new GetAmendusFlights();
        $class->register()->getFlights($params);

        return $class->response;
    }

    /**
     * Fetches flights from the Custom Post Type (CPT) based on parameters.
     * 
     * @param array $params
     * @return array
     */
    public function fetchFlightsFromCpt($params)
    {
        $class = new CptQueryHandler();

        // Build the query dynamically based on available parameters
        $query = $class->setPostType('flight')->whereMeta('_status', 1);

        if (!empty($params['origin']))
        {
            $query->whereMeta('_from_airport', $params['origin']);
        }

        if (!empty($params['destination']))
        {
            $query->whereMeta('_to_airport', $params['destination']);
        }

        // if (!empty($params['departure_date']))
        // {
        //     $query->whereMeta('_departure_time', $params['departure_date']);
        // }

        // if (!empty($params['return_date']))
        // {
        //     $query->whereMeta('_arrival_time', $params['return_date']);
        // }

        $results = $query->getResults();

        return $results;
    }

    /**
     * Returns a standardized REST API response.
     * 
     * @param mixed $response
     * @return WP_REST_Response
     */
    public function returnRestResponse($response)
    {
        if (is_wp_error($response))
        {
            return new WP_REST_Response([
                'success' => false,
                'message' => $response instanceof \WP_Error ? $response->get_error_message() : 'Unknown API error'
            ], 500);
        }

        return new WP_REST_Response([
            'success' => true,
            'data'    => $response
        ], 200);
    }
}
