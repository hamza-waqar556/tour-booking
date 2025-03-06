<?php

/**
 * @package TourBooking
 */

namespace Inc\Data;
// ! Pending
use \Inc\Api\CptQueryHandler;

class GetCptFlights
{
    public $response = [];
    public $queryHandler;

    public function register()
    {
        $this->queryHandler = new CptQueryHandler();

        $this->flightsResponse();
        return $this;
    }

    public function flightsResponse()
    {
        $results = $this->queryHandler
            ->setPostType('hotel')
            ->whereMeta('_from_airport', 'JFK')
            ->whereMeta('_to_airport', 'LAX')
            ->whereMeta('_duration', 15)
            ->getResults();

        return $this;
    }
}
