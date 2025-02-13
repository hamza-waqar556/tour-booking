<?php

// Get saved values
$refundable     = get_post_meta( $post->ID, '_refundable', true );
$car_currency        = get_post_meta( $post->ID, '_car_currency', true );
$star          = get_post_meta( $post->ID, '_star', true );
$rating          = get_post_meta( $post->ID, '_rating', true );
$city_code          = get_post_meta( $post->ID, '_city_code', true );
$car_price          = get_post_meta( $post->ID, '_car_price', true );

// Nonce for security
wp_nonce_field( 'car_booking_fields_nonce_action', 'car_booking_fields_nonce' );

?>



<div class="aiob-input-group">
    <div class="heading">refundable:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="car-refundable" name="refundable" value="1" <?php checked( $refundable, 1 ); ?> />
            <label for="car-refundable">
                <div></div>
            </label>
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">currency:</div>
    <div id="car-currency" data-options='["PKR", "USD", "EUR"]'></div>
    <input type="hidden" name="car_currency" id="car-currency-input" value="<?php echo esc_attr( $car_currency ); ?>">
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
    <div class="heading">city code:</div>
    <div id="city-code" data-options='["FSD", "LYP", "LSL"]'></div>
    <input type="hidden" name="city_code" id="city-code-input" value="<?php echo esc_attr( $city_code ); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">price:</div>
    <div class="input-wrapper">
      <input type="number" name="car_price" value="<?php echo esc_attr( $car_price ); ?>" />
    </div>
</div>
