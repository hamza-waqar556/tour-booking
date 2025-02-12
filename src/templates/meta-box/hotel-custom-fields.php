<?php

// Get saved values
$status        = get_post_meta( $post->ID, '_status', true );
$featured        = get_post_meta( $post->ID, '_featured', true );
$check_in        = get_post_meta( $post->ID, '_check_in', true );
$check_out       = get_post_meta( $post->ID, '_check_out', true );
$hotel_currency        = get_post_meta( $post->ID, '_hotel_currency', true );
$user_email      = get_post_meta( $post->ID, '_user_email', true );
$refundable      = get_post_meta( $post->ID, '_refundable', true );
$star          = get_post_meta( $post->ID, '_star', true );
$rating          = get_post_meta( $post->ID, '_rating', true );
$hotel_amenities = get_post_meta( $post->ID, '_hotel_amenities', true );
$booking_age     = get_post_meta( $post->ID, '_booking_age', true );
$hotel_location     = get_post_meta( $post->ID, '_hotel_location', true );
$hotel_address     = get_post_meta( $post->ID, '_hotel_address', true );
$hotel_location_code     = get_post_meta( $post->ID, '_hotel_location_code', true );
$hotel_email     = get_post_meta( $post->ID, '_hotel_email', true );
$hotel_website     = get_post_meta( $post->ID, '_hotel_website', true );
$hotel_phone     = get_post_meta( $post->ID, '_hotel_phone', true );

// Get all users
$users = get_users( [ 'fields' => [ 'ID', 'user_email' ] ] );

// Nonce for security
wp_nonce_field( 'hotel_fields_nonce_action', 'hotel_fields_nonce' );


$user_emails = [];

foreach ($users as $user) {
    $user_emails[] = $user->user_email;
}

$email_json = htmlspecialchars(json_encode($user_emails), ENT_QUOTES, 'UTF-8');

?>

<div class="aiob-input-group">
    <div class="heading">status:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="hotel-status" name="status" value="1" <?php checked( $status, 1 ); ?> />
            <label for="hotel-status">
                <div></div>
            </label>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">refundable:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="hotel-refundable" name="refundable" value="1" <?php checked( $refundable, 1 ); ?> />
            <label for="hotel-refundable">
                <div></div>
            </label>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">featured:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="hotel-featured" name="featured" value="1" <?php checked( $featured, 1 ); ?> />
            <label for="hotel-featured">
                <div></div>
            </label>
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">check in:</div>
    <div class="input-wrapper">
       <input type="date" name="check_in" value="<?php echo esc_attr( $check_in ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">check out:</div>
    <div class="input-wrapper">
    <input type="date" name="check_out" value="<?php echo esc_attr( $check_out ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">currency:</div>
    <div id="hotel-currency" data-options='["PKR", "USD", "EUR"]'></div>
    <input type="hidden" name="hotel_currency" id="hotel-currency-input" value="<?php echo esc_attr( $hotel_currency ); ?>">
</div>


<div class="aiob-input-group">
    <div class="heading">User Email:</div>
    <div id="user-email" data-options="<?= $email_json; ?>"></div>
    <input type="hidden" name="user_email" id="user-email-input" value="<?php echo esc_attr( $user_email ); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">stars:</div>
    <div class="custon-select-wrapper">
        <select name="star">
            <?php for ( $i = 0; $i <= 7; $i++ ): ?>
                <option value="<?php echo $i; ?>" <?php selected( $star, $i ); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">ratings:</div>
    <div class="custon-select-wrapper">
        <select name="rating">
            <?php for ( $i = 0; $i <= 5; $i++ ): ?>
                <option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">Hotel Amenities:</div>
    <div class="aiob-multi-select" data-multi-options='["PKR", "USD", "EUR"]'>
        <div class="aiob-selected-options">Select options</div>
        <div class="multi-select-dropdown"></div>
        <input type="hidden" name="hotel_amenities" id="hotel-amenities-input" value="<?php echo esc_attr( implode(',', (array) $hotel_amenities) ); ?>">
    </div>
</div>





<div class="aiob-input-group">
    <div class="heading">Booking Age Requirement:</div>
    <div class="input-wrapper">
      <input type="number" name="booking_age" value="<?php echo esc_attr( $booking_age ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">location:</div>
    <div id="hotel-location" data-options='["Faisalabad", "lahore", "Islamabad"]'></div>
    <input type="hidden" name="hotel_location" id="hotel-location-input" value="<?php echo esc_attr( $hotel_location ); ?>">
</div>


<div class="aiob-input-group">
    <div class="heading">address:</div>
    <div class="input-wrapper">
      <input type="text" name="hotel_address" value="<?php echo esc_attr( $hotel_address ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">location code:</div>
    <div class="input-wrapper">
      <input type="text" name="hotel_location_code" value="<?php echo esc_attr( $hotel_location_code ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">hotel email:</div>
    <div class="input-wrapper">
      <input type="email" name="hotel_email" value="<?php echo esc_attr( $hotel_email ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">hotel website:</div>
    <div class="input-wrapper">
      <input type="text" name="hotel_website" value="<?php echo esc_attr( $hotel_website ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">hotel phone number:</div>
    <div class="input-wrapper">
      <input type="tel" name="hotel_phone" value="<?php echo esc_attr( $hotel_phone ); ?>" />
    </div>
</div>