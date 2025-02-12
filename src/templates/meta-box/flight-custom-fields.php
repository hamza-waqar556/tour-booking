<?php
// Get saved values
$status          = get_post_meta( $post->ID, '_status', true );
$refundable      = get_post_meta( $post->ID, '_refundable', true );
$flight_airlines      = get_post_meta( $post->ID, '_flight_airlines', true );
$from_airport      = get_post_meta( $post->ID, '_from_airport', true );
$to_airport      = get_post_meta( $post->ID, '_to_airport', true );
$departure_time  = get_post_meta( $post->ID, '_departure_time', true );
$arrival_time       = get_post_meta( $post->ID, '_arrival_time', true );
$user_email      = get_post_meta( $post->ID, '_user_email', true );
$adult_seat_price  = get_post_meta( $post->ID, '_adult_seat_price', true );
$child_seat_price  = get_post_meta( $post->ID, '_child_seat_price', true );
$infant_seat_price  = get_post_meta( $post->ID, '_infant_seat_price', true );
$duration  = get_post_meta( $post->ID, '_duration', true );
$baggage  = get_post_meta( $post->ID, '_baggage', true );
$cabin_baggage  = get_post_meta( $post->ID, '_cabin_baggage', true );
$flight_type  = get_post_meta( $post->ID, '_flight_type', true );
$flight_currency  = get_post_meta( $post->ID, '_flight_currency', true );

// Get all users
$users = get_users( [ 'fields' => [ 'ID', 'user_email' ] ] );

// Nonce for security
wp_nonce_field( 'flight_fields_nonce_action', 'flight_fields_nonce' );

$user_emails = [];

foreach ($users as $user) {
    $user_emails[] = $user->user_email;
}

$email_json = htmlspecialchars(json_encode($user_emails), ENT_QUOTES, 'UTF-8');

?>

<div class="aiob-input-group">
    
    <div class="heading">Status:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="flight-status" name="status" value="1" <?php checked( $status, 1 ); ?> />
            <label for="flight-status">
                <div></div>
            </label>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Refundable:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="flight-refundable" name="refundable" value="1" <?php checked( $refundable, 1 ); ?> />
            <label for="flight-refundable">
                <div></div>
            </label>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Airlines:</div>
    <div id="flight-airlines" data-options='["PK", "UK", "LHD"]'></div>
    <input type="hidden" name="flight_airlines" id="flight-airlines-input" value="<?php echo esc_attr( $flight_airlines ); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">from airport:</div>
    <div id="from-airport" data-options='["PK", "UK", "LHD"]'></div>
    <input type="hidden" name="from_airport" id="from-airport-input" value="<?php echo esc_attr( $from_airport ); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">to airport:</div>
    <div id="to-airport" data-options='["PK", "UK", "LHD"]'></div>
    <input type="hidden" name="to_airport" id="to-airport-input" value="<?php echo esc_attr( $to_airport ); ?>">
</div>


<div class="aiob-input-group">
    <div class="heading">adult seat price:</div>
    <div class="input-wrapper">
        <input type="number" name="adult_seat_price" value="<?php echo esc_attr( $adult_seat_price ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">child seat price:</div>
    <div class="input-wrapper">
        <input type="number" name="child_seat_price" value="<?php echo esc_attr( $child_seat_price ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">infant seat price:</div>
    <div class="input-wrapper">
        <input type="number" name="infant_seat_price" value="<?php echo esc_attr( $infant_seat_price ); ?>"  />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Duration:</div>
    <div class="input-wrapper">
        <input type="number" name="duration" value="<?php echo esc_attr( $duration ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Departure Time:</div>
    <div class="input-wrapper">
        <input type="datetime-local" name="departure_time" value="<?php echo esc_attr( $departure_time ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Arrival Time:</div>
    <div class="input-wrapper">
    <input type="datetime-local" name="arrival_time" value="<?php echo esc_attr( $arrival_time ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Baggage:</div>
    <div class="input-wrapper">
        <input type="text" name="baggage" value="<?php echo esc_attr( $baggage ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Cabin Baggage:</div>
    <div class="input-wrapper">
        <input type="text" name="cabin_baggage" value="<?php echo esc_attr( $cabin_baggage ); ?>" />
    </div>
</div>



<div class="aiob-input-group">
    <div class="heading">flight type:</div>
    <div id="flight-type" data-options='["Economy", "Economy Premium", "Business" ,"First"]'></div>
    <input type="hidden" name="flight_type" id="flight-type-input" value="<?php echo esc_attr( $flight_type ); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">currency:</div>
    <div id="flight-currency" data-options='["PKR", "USD", "EUR"]'></div>
    <input type="hidden" name="flight_currency" id="flight-currency-input" value="<?php echo esc_attr( $flight_currency ); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">User Email:</div>
    <div id="user-email" data-options="<?= $email_json; ?>"></div>
    <input type="hidden" name="user_email" id="user-email-input" value="<?php echo esc_attr( $user_email ); ?>">
</div>



