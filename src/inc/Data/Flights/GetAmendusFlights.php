<?php

/**
 * @package TourBooking
 */

namespace Inc\Data\Flights;


use \Inc\Data\GetApiCredentials;
use \DateTime;

class GetAmendusFlights
{
    private $api_creds;

    public $api_data;
    public $response;

    public function register()
    {
        $this->getApiCreds();
        $this->getAuthToken();

        // $args = [
        //     'originLocationCode'      => 'PAR',
        //     'destinationLocationCode' => 'ICN',
        //     'departureDate'           => '2025-03-10',
        //     'returnDate'              => '',
        //     'adults'                  => 2,
        //     'max'                     => 1,
        // ];

        // $this->getFlights($args);

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

        $this->api_data = $responseData;

        $this->filterApiData($this->api_data);

        return $this;
    }


    public function filterApiData($flights)
    {

        if (is_object($flights))
        {
            $flights_array = json_decode(json_encode($flights), true);
        }
        elseif (is_array($flights))
        {
            $flights_array = $flights;
        }
        else
        {
            $flights_array = [];
        }

        $flight_data = [];

        function calculateFlightDuration($departure, $arrival)
        {
            if (empty($departure) || empty($arrival))
            {
                return 'N/A';
            }

            $dep_time = new DateTime($departure);
            $arr_time = new DateTime($arrival);
            $interval = $dep_time->diff($arr_time);

            return $interval->format('%h hrs %i mins');
        }

        if (!empty($flights_array['data']))
        {
            $dictionaries = $flights_array['dictionaries'] ?? [];
            $airport_list = $dictionaries['locations'] ?? [];
            $airline_list = $dictionaries['carriers'] ?? [];

            foreach ($flights_array['data'] as $flight)
            {
                $segments = $flight['itineraries'][0]['segments'] ?? [];
                $first_segment = $segments[0] ?? [];
                $last_segment = end($segments) ?? [];

                // Airport and airline details
                $departure_code = $first_segment['departure']['iataCode'] ?? 'N/A';
                $arrival_code = $last_segment['arrival']['iataCode'] ?? 'N/A';
                $airline_code = $flight['validatingAirlineCodes'][0] ?? 'N/A';

                // Stops & Stop Names
                $stops = count($segments) - 1;
                $stop_names = [];
                if ($stops > 0)
                {
                    foreach ($segments as $index => $segment)
                    {
                        if ($index > 0 && $index < count($segments))
                        {
                            $stop_code = $segment['departure']['iataCode'] ?? 'N/A';
                            $stop_names[] = $airport_list[$stop_code]['name'] ?? $stop_code;
                        }
                    }
                }

                // Extract Prices (Adults, Child, Infant)
                $price_adult = 'N/A';
                $price_child = 'N/A';
                $price_infant = 'N/A';
                $total_price = 'N/A';

                if (!empty($flight['travelerPricings']))
                {
                    foreach ($flight['travelerPricings'] as $traveler)
                    {
                        $travelerType = $traveler['travelerType'] ?? '';
                        $travelerPrice = $traveler['price']['total'] ?? 'N/A';
                        $currency = $flight['price']['currency'] ?? '';

                        if ($travelerType == 'ADULT')
                        {
                            $price_adult = $travelerPrice . ' ' . $currency;
                        }
                        elseif ($travelerType == 'CHILD')
                        {
                            $price_child = $travelerPrice . ' ' . $currency;
                        }
                        elseif ($travelerType == 'HELD_INFANT')
                        {
                            $price_infant = $travelerPrice . ' ' . $currency;
                        }
                    }
                }

                if (!empty($flight['price']))
                {
                    $currency = $flight['price']['currency'] ?? '';
                    $totalPrice = isset($flight['price']['grandTotal'])
                        ? $flight['price']['grandTotal'] . ' ' . $currency : '';
                }


                // Extract Flight Class, Baggage, and Cabin Baggage
                $flight_class = 'N/A';
                $baggage = 'N/A';
                $cabin_baggage = 'N/A';

                if (!empty($flight['travelerPricings']))
                {
                    foreach ($flight['travelerPricings'] as $traveler)
                    {
                        if (!empty($traveler['fareDetailsBySegment']))
                        {
                            foreach ($traveler['fareDetailsBySegment'] as $fareSegment)
                            {
                                if (!empty($fareSegment['includedCheckedBags']))
                                {
                                    if (isset($fareSegment['includedCheckedBags']['weight']))
                                    {
                                        $baggage = $fareSegment['includedCheckedBags']['weight'] . ' kg';
                                    }
                                    elseif (isset($fareSegment['includedCheckedBags']['quantity']))
                                    {
                                        $baggage = $fareSegment['includedCheckedBags']['quantity'];
                                    }
                                    if (isset($fareSegment['includedCabinBags']['weight']))
                                    {
                                        $cabin_baggage = $fareSegment['includedCabinBags']['weight'] . ' kg';
                                    }
                                }
                                if (!empty($fareSegment['cabin']))
                                {
                                    $flight_class = $fareSegment['cabin'];
                                }
                            }
                        }
                    }
                }

                // Extract VAT (Taxes)
                $vat = 'N/A';
                if (!empty($flight['price']['taxes']))
                {
                    $vat = $flight['price']['taxes'] . ' ' . $flight['price']['currency'];
                }

                $flight_data[] = [
                    'airline'        => $airline_list[$airline_code] ?? $airline_code, // Full Airline Name
                    'flight_class'   => $flight_class,
                    'departure_date' => isset($first_segment['departure']['at']) ? date('Y-m-d', strtotime($first_segment['departure']['at'])) : 'N/A',
                    'departure_airport' => $airport_list[$departure_code]['name'] ?? $departure_code, // Full Departure Airport Name
                    'arrival_date'   => isset($last_segment['arrival']['at']) ? date('Y-m-d', strtotime($last_segment['arrival']['at'])) : 'N/A',
                    'arrival_airport' => $airport_list[$arrival_code]['name'] ?? $arrival_code, // Full Arrival Airport Name
                    'from_city'      => $departure_code,
                    'to_city'        => $arrival_code,
                    'departure_time' => isset($first_segment['departure']['at']) ? date('h:i A', strtotime($first_segment['departure']['at'])) : 'N/A', // 12-hour format with AM/PM
                    'arrival_time'   => isset($last_segment['arrival']['at']) ? date('h:i A', strtotime($last_segment['arrival']['at'])) : 'N/A', // 12-hour format with AM/PM
                    'duration'       => calculateFlightDuration($first_segment['departure']['at'] ?? '', $last_segment['arrival']['at'] ?? ''),
                    'flight_number'  => ($first_segment['carrierCode'] ?? 'N/A') . '-' . ($first_segment['number'] ?? 'N/A'),
                    'price_adult'    => $price_adult,
                    'price_child'    => $price_child,
                    'price_infant'   => $price_infant,
                    'total_price'    => $totalPrice,
                    'baggage'        => $baggage,
                    'cabin_baggage'  => $cabin_baggage,
                    'stops'          => $stops,
                    'stop_names'     => implode(', ', $stop_names),
                    'vat'            => $vat,
                ];
            }
        }




        // echo "<pre>";
        // print_r($flights);
        // print_r($flight_data);
        // echo "</pre>";


        // wp_die();

        $this->response = $flight_data;

        return $this;
    }
}
