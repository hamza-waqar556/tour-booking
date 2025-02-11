<?php
namespace Inc\Api\Modules;

use Inc\Api\BaseApi;

class Hotelbed extends BaseApi
{

    // Set your actual endpoint URL for Hotelbed here.
    protected $endpoint = 'https://api.hotelbed.example.com/search';

    /**
     * Parse and normalize the API response.
     *
     * The method should transform the raw API response into your
     * normalized data structure (for hotels, include name, price, ratings, etc.)
     *
     * @return array
     */
    public function parseResponse(): array
    {
        $normalized = [  ];

        // Decode the JSON response
        $data = json_decode( $this->rawResponse, true );

        // Check for errors or empty data
        if ( empty( $data ) || ! isset( $data[ 'hotels' ] ) ) {
            return $normalized;
        }

        // Normalize each hotel entry
        foreach ( $data[ 'hotels' ] as $hotel ) {
            $normalized[  ] = [
                'name'    => $hotel[ 'name' ] ?? 'N/A',
                'price'   => $hotel[ 'price' ] ?? 0,
                'ratings' => $hotel[ 'ratings' ] ?? 0,
                // Add any other fields you need
                // 'address' => $hotel['address'] ?? '',
             ];
        }
        return $normalized;
    }
}
