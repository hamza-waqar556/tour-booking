<?php

// Get saved values
$tour_currency        = get_post_meta( $post->ID, '_tour_currency', true );
$refundable     = get_post_meta( $post->ID, '_refundable', true );
$star          = get_post_meta( $post->ID, '_star', true );
$rating          = get_post_meta( $post->ID, '_rating', true );
$tour_inclusions          = get_post_meta( $post->ID, '_tour_inclusions', true );
$tour_exclusions          = get_post_meta( $post->ID, '_tour_exclusions', true );
$adult_tour_price     = get_post_meta( $post->ID, '_adult_tour_price', true );
$child_tour_price     = get_post_meta( $post->ID, '_child_tour_price', true );
$tour_location     = get_post_meta( $post->ID, '_tour_location', true );


// Nonce for security
wp_nonce_field( 'tour_fields_nonce_action', 'tour_fields_nonce' );

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
    <div class="heading">currency:</div>
    <div id="tour-currency" data-options='["PKR", "USD", "EUR"]'></div>
    <input type="hidden" name="tour_currency" id="tour-currency-input" value="<?php echo esc_attr( $tour_currency ); ?>">
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
    <div id="tour-inclusions" data-options='["breakfast", "lunch", "room"]'></div>
    <input type="hidden" name="tour_inclusions" id="tour-inclusions-input" value="<?php echo esc_attr( $tour_inclusions ); ?>">
</div>


<div class="aiob-input-group">
    <div class="heading">tour exclusions:</div>
    <div id="tour-exclusions" data-options='["breakfast", "lunch", "room"]'></div>
    <input type="hidden" name="tour_exclusions" id="tour-exclusions-input" value="<?php echo esc_attr( $tour_exclusions ); ?>">
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
    <div id="tour-location" data-options='["Faisalabad", "lahore", "Islamabad"]'></div>
    <input type="hidden" name="tour_location" id="tour-location-input" value="<?php echo esc_attr( $tour_location ); ?>">
</div>

