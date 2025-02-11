<?php

// Get saved values
$status          = get_post_meta( $post->ID, '_status', true );
$featured        = get_post_meta( $post->ID, '_featured', true );
$check_in        = get_post_meta( $post->ID, '_check_in', true );
$check_out       = get_post_meta( $post->ID, '_check_out', true );
$currency        = get_post_meta( $post->ID, '_currency', true );
$user_email      = get_post_meta( $post->ID, '_user_email', true );
$refundable      = get_post_meta( $post->ID, '_refundable', true );
$rating          = get_post_meta( $post->ID, '_rating', true );
$hotel_amenities = get_post_meta( $post->ID, '_hotel_amenities', true );
$booking_age     = get_post_meta( $post->ID, '_booking_age', true );

// Get all users
$users = get_users( [ 'fields' => [ 'ID', 'user_email' ] ] );

// Nonce for security
wp_nonce_field( 'hotel_fields_nonce_action', 'hotel_fields_nonce' );
?>

<p>
    <label>Status:</label>
    <input type="checkbox" name="status" value="1" <?php checked( $status, 1 ); ?> />
</p>

<p>
    <label>Featured:</label>
    <input type="checkbox" name="featured" value="1" <?php checked( $featured, 1 ); ?> />
</p>

<p>
    <label>Check In:</label>
    <input type="date" name="check_in" value="<?php echo esc_attr( $check_in ); ?>" />
</p>

<p>
    <label>Check Out:</label>
    <input type="date" name="check_out" value="<?php echo esc_attr( $check_out ); ?>" />
</p>

<p>
    <label>Currency:</label>
    <select name="currency">
        <option value="USD" <?php selected( $currency, 'USD' ); ?>>USD</option>
        <option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR</option>
        <option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP</option>
    </select>
</p>

<p>
    <label>User Email:</label>
    <select name="user_email">
        <?php foreach ( $users as $user ): ?>
            <option value="<?php echo esc_attr( $user->user_email ); ?>" <?php selected( $user_email, $user->user_email ); ?>>
                <?php echo esc_html( $user->user_email ); ?>
            </option>
        <?php endforeach; ?>
    </select>
</p>

<p>
    <label>Refundable:</label>
    <input type="checkbox" name="refundable" value="1" <?php checked( $refundable, 1 ); ?> />
</p>

<p>
    <label>Rating:</label>
    <select name="rating">
        <?php for ( $i = 0; $i <= 5; $i++ ): ?>
            <option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?></option>
        <?php endfor; ?>
    </select>
</p>

<p>
    <label>Hotel Amenities:</label>
    <select name="hotel_amenities[]" multiple>
        <option value="wifi" <?php echo in_array( 'wifi', (array) $hotel_amenities ) ? 'selected' : ''; ?>>WiFi</option>
        <option value="pool" <?php echo in_array( 'pool', (array) $hotel_amenities ) ? 'selected' : ''; ?>>Pool</option>
        <option value="parking" <?php echo in_array( 'parking', (array) $hotel_amenities ) ? 'selected' : ''; ?>>Parking</option>
    </select>
</p>

<p>
    <label>Booking Age Requirement:</label>
    <input type="number" name="booking_age" value="<?php echo esc_attr( $booking_age ); ?>" />
</p>