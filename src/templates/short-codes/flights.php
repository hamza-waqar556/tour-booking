<?php

/**
 * ShortCode Flights
 */

use Inc\Data\GetAmendusFlights;

if ( 'POST' === $_SERVER[ 'REQUEST_METHOD' ] && isset( $_POST[ 'search_flight' ] ) ) {

    $params = [
        'originLocationCode'      => sanitize_text_field( $_POST[ 'origin' ] ),
        'destinationLocationCode' => sanitize_text_field( $_POST[ 'destination' ] ),
        'departureDate'           => sanitize_text_field( $_POST[ 'departure_date' ] ),
        'returnDate'              => sanitize_text_field( $_POST[ 'return_date' ] ),
        'adults'                  => intval( $_POST[ 'adults' ] ),
        'max'                     => intval( $_POST[ 'max_results' ] ),
     ];

    $params = array_filter( $params ); // Remove empty values

    try {
        $flights_instance = new GetAmendusFlights();
        $flights_instance->register()->getFlights( $params );
        $flights = $flights_instance->response;
    } catch ( Exception $e ) {
        $flights = [ 'error' => $e->getMessage() ];
    }
}

?>


<form method="post">
    <label>From: <input type="text" name="origin" value="PAR" required></label> <br> <br>
    <label>To: <input type="text" name="destination" value="ICN" required></label> <br> <br>
    <label>Departure Date: <input type="date" name="departure_date" value="2025-03-10" required></label> <br> <br>
    <label>Return Date: <input type="date" name="return_date"></label> <br> <br>
    <label>Adults: <input type="number" name="adults" value="1" min="1" required></label> <br> <br>
    <label>Max Results: <input type="number" name="max_results" value="5" min="1"></label> <br> <br>
    <button type="submit" name="search_flight">Search Flights</button>
</form>

<?php if ( ! empty( $flights ) ): ?>
    <h3>Flight Results:</h3>
    <pre><?php print_r( $flights ); ?></pre>
<?php endif; ?>


<?php 

foreach ($variable as $key => $value) {
    
}
