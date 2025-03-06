<?php

/**
 * @package TourBooking
 */

namespace Inc\Data\Flights;

use \Inc\Data\GetApiCredentials;

class GetAmendusFlights
{
    private $api_creds;

    public $response = [];

    public function register()
    {
        $this->getApiCreds();
        $this->getAuthToken();

        $args = [
            'originLocationCode'      => 'PAR',
            'destinationLocationCode' => 'ICN',
            'departureDate'           => '2025-03-10',
            'returnDate'              => '',
            'adults'                  => 2,
            'max'                     => 1,
        ];

        $this->getFlights($args);

        echo "<pre>";
        print_r($this->response);
        echo "</pre>";
        wp_die();

        return $this;
    }

    private function getApiCreds()
    {
        $class           = new GetApiCredentials();
        $this->api_creds = $class->register()->getApiCreds('flights', 'Amendus');

        if (! isset($this->api_creds['_api_key'], $this->api_creds['_secret_key']))
        {
            throw new \Exception("API credentials missing");
        }
        return $this;
    }

    public function getAuthToken()
    {
        $auth_url = 'https://test.api.amadeus.com/v1/security/oauth2/token';

        $response = wp_remote_post($auth_url, [
            'body'    => [
                'grant_type'    => 'client_credentials',
                'client_id'     => $this->api_creds['_api_key'],
                'client_secret' => $this->api_creds['_secret_key'],
            ],
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
            'timeout' => 10,
        ]);

        if (is_wp_error($response))
        {
            throw new \Exception('Request error: ' . $response->get_error_message());
        }

        $responseData = json_decode(wp_remote_retrieve_body($response), true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            throw new \Exception("JSON decode error: " . json_last_error_msg());
        }

        if (! isset($responseData['access_token']))
        {
            throw new \Exception("Failed to retrieve auth token");
        }

        $this->api_creds['_token'] = $responseData['access_token'];
        return $this;
    }

    public function getFlights($args = [])
    {
        if (! isset($this->api_creds['_token']))
        {
            throw new \Exception("Access token is missing. Please authenticate first.");
        }

        $base_url = 'https://test.api.amadeus.com/v2/shopping/flight-offers';

        // Filter out empty params
        $query_params = array_filter($args);
        $query_string = http_build_query($query_params);
        $api_url      = $base_url . ($query_string ? ('?' . $query_string) : '');

        $response = wp_remote_get($api_url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->api_creds['_token'],
                'Content-Type'  => 'application/json',
            ],
            'timeout' => 10,
        ]);

        if (is_wp_error($response))
        {
            throw new \Exception('Request error: ' . $response->get_error_message());
        }

        $responseData = json_decode(wp_remote_retrieve_body($response), true);

        if (json_last_error() !== JSON_ERROR_NONE)
        {
            throw new \Exception("JSON decode error: " . json_last_error_msg());
        }

        // Remove meta key if exists
        if (isset($responseData['meta']))
        {
            unset($responseData['meta']);
        }

        $this->response = $responseData;

        return $this;
    }
}
