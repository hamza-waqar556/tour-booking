<?php
// Get saved values
$status          = get_post_meta( $post->ID, '_status', true );
$featured        = get_post_meta( $post->ID, '_featured', true );
$departure_time  = get_post_meta( $post->ID, '_departure_time', true );
$arrival_time       = get_post_meta( $post->ID, '_arrival_time', true );
$currency        = get_post_meta( $post->ID, '_currency', true );
$user_email      = get_post_meta( $post->ID, '_user_email', true );
$refundable      = get_post_meta( $post->ID, '_refundable', true );
$adult_seat_price  = get_post_meta( $post->ID, '_adult_seat_price', true );
$child_seat_price  = get_post_meta( $post->ID, '_child_seat_price', true );
$infant_seat_price  = get_post_meta( $post->ID, '_infant_seat_price', true );
$baggage  = get_post_meta( $post->ID, '_baggage', true );
$cabin_baggage  = get_post_meta( $post->ID, '_cabin_baggage', true );

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
    <div class="heading">airlines:</div>
    <div id="flight-airlines" data-options=""></div>
</div>

<div class="aiob-input-group">
    <div class="heading">from airport:</div>
    <div id="from-airport" data-options=""></div>
</div>

<div class="aiob-input-group">
    <div class="heading">to airport:</div>
    <div id="to-airport" data-options=""></div>
</div>

<div class="aiob-input-group">
    <div class="heading">adult seat price:</div>
    <div class="input-wrapper">
        <input type="number" name="adult_seat_price" value="1" <?php echo esc_attr( $adult_seat_price ); ?>/>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">child seat price:</div>
    <div class="input-wrapper">
        <input type="number" name="child_seat_price" value="1" <?php echo esc_attr( $child_seat_price ); ?>/>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">infant seat price:</div>
    <div class="input-wrapper">
        <input type="number" name="infant_seat_price" value="1" <?php echo esc_attr( $infant_seat_price ); ?> />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">Duration:</div>
    <div class="input-wrapper">
        <input type="number" />
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
    <div class="heading">Type:</div>

    <div id="flight-type" data-options=""></div>

    <!-- <select name="currency">
        <option value="USD" <?php selected( $currency, 'USD' ); ?>>USD</option>
        <option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR</option>
        <option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP</option>
    </select> -->
</div>

<div class="aiob-input-group">
    <div class="heading">Currency:</div>

    <div id="flight-currency" data-options="USD,EUR,PK"></div>

    <!-- <select name="currency">
        <option value="USD" <?php selected( $currency, 'USD' ); ?>>USD</option>
        <option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR</option>
        <option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP</option>
    </select> -->
</div>

<div class="aiob-input-group">
    <div class="heading">User Email:</div>
    <div  data-options="<?= $email_json; ?>"></div>
</div>



