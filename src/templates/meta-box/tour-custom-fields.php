<?php

// Get saved values
$currency        = get_post_meta( $post->ID, '_currency', true );
$refundable     = get_post_meta( $post->ID, '_refundable', true );
$user_email      = get_post_meta( $post->ID, '_user_email', true );
$star          = get_post_meta( $post->ID, '_star', true );
$rating          = get_post_meta( $post->ID, '_rating', true );
$adult_tour_price     = get_post_meta( $post->ID, '_adult_tour_price', true );
$child_tour_price     = get_post_meta( $post->ID, '_achild_tour_price', true );

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
    <div class="heading">refundable:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="tour-refundable" name="refundable" value="1" <?php checked( $refundable, 1 ); ?> />
            <label for="tour-refundable">
                <div></div>
            </label>
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">Currency:</div>

    <div id="tour-currency" data-options="USD,EUR,PK"></div>

    <!-- <select name="currency">
        <option value="USD" <?php selected( $currency, 'USD' ); ?>>USD</option>
        <option value="EUR" <?php selected( $currency, 'EUR' ); ?>>EUR</option>
        <option value="GBP" <?php selected( $currency, 'GBP' ); ?>>GBP</option>
    </select> -->
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
    <div class="heading">rating:</div>
    <div class="custon-select-wrapper">
        <select name="rating">
            <?php for ( $i = 0; $i <= 5; $i++ ): ?>
                <option value="<?php echo $i; ?>" <?php selected( $rating, $i ); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">tour inclusions:</div>
    <div  data-options="<?= $email_json; ?>"></div>
</div>

<div class="aiob-input-group">
    <div class="heading">tour exclusions:</div>
    <div  data-options="<?= $email_json; ?>"></div>
</div>

<div class="aiob-input-group">
    <div class="heading">adult tour price:</div>
    <div class="input-wrapper">
      <input type="number" name="adult_tour_price" value="<?php echo esc_attr( $adult_tour_price ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">child tour price:</div>
    <div class="input-wrapper">
      <input type="number" name="child_tour_price" value="<?php echo esc_attr( $child_tour_price ); ?>" />
    </div>
</div>

<div class="aiob-input-group">
    <div class="heading">location:</div>
    <div  data-options="<?= $email_json; ?>"></div>
</div>