<?php
namespace Inc\Api;

abstract class BaseApi
{

    // Credentials
    protected $apiKey;
    protected $secretKey;

    // Search parameters and endpoint
    protected $params   = [  ];
    protected $endpoint = '';

    // Results and error storage
    protected $rawResponse = null;
    protected $error       = null;

    /**
     * Set credentials for the API.
     *
     * @param string $apiKey
     * @param string $secretKey
     * @return $this
     */
    public function setCredentials( string $apiKey, string $secretKey )
    {
        $this->apiKey    = $apiKey;
        $this->secretKey = $secretKey;
        return $this;
    }

    /**
     * Set search parameters.
     *
     * @param array $params
     * @return $this
     */
    public function setParameters( array $params )
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Execute the API call using wp_remote_post().
     *
     * @return $this
     */
    public function search()
    {
        // Prepare request arguments
        $args = [
            'body'    => json_encode( $this->params ),
            'headers' => [
                'Content-Type' => 'application/json',
                // Using custom headers for credentials (adjust as required per API)
                'Api-Key'      => $this->apiKey,
                'Secret-Key'   => $this->secretKey,
             ],
            'timeout' => 30,
         ];

        // Make the request via the WP HTTP API
        $response = wp_remote_post( $this->endpoint, $args );

        if ( is_wp_error( $response ) ) {
            $this->error = $response->get_error_message();
        } else {
            $this->rawResponse = wp_remote_retrieve_body( $response );
        }
        return $this;
    }

    /**
     * Each module must implement its own response parser so that data is normalized.
     *
     * @return array Normalized data array
     */
    abstract public function parseResponse(): array;

    /**
     * Get the normalized data.
     *
     * @return array
     */
    public function getData(): array
    {
        return $this->parseResponse();
    }

    /**
     * Optionally, a helper to return errors (for debugging/logging).
     *
     * @return string|null
     */
    public function getError()
    {
        return $this->error;
    }
}
