<?php
// Get saved values
$status          = get_post_meta( $post->ID, '_status', true );
$api_name      = get_post_meta( $post->ID, '_api_name', true );
$api_type      = get_post_meta( $post->ID, '_api_type', true );
$api_key      = get_post_meta( $post->ID, '_api_key', true );
$secret_key      = get_post_meta( $post->ID, '_secret_key', true );



// Nonce for security
wp_nonce_field( 'api_fields_nonce_action', 'api_fields_nonce' );

?>

<div class="aiob-input-group">
    
    <div class="heading">Status:</div>
    <div class="ui-toggle">
        <input type="checkbox" id="api-status" name="status" value="1" <?php checked( $status, 1 ); ?> />
            <label for="api-status">
                <div></div>
            </label>
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">api name:</div>
    <div id="api-name" data-options='["amendus", "duffel", "vitour"]'></div>
    <input type="hidden" name="api_name" id="api-name-input" value="<?php echo esc_attr( $api_name); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">api type:</div>
    <div id="api-type" data-options='["flight", "car", "tour", "hotel"]'></div>
    <input type="hidden" name="api_type" id="api-type-input" value="<?php echo esc_attr( $api_type); ?>">
</div>

<div class="aiob-input-group">
    <div class="heading">api key:</div>
    <div class="input-wrapper">
        <input type="text" name="api_key" value="<?php echo esc_attr( $api_key ); ?>" />
    </div>
</div>


<div class="aiob-input-group">
    <div class="heading">secret key:</div>
    <div class="input-wrapper">
        <input type="text" name="secret_key" value="<?php echo esc_attr( $secret_key ); ?>" />
    </div>
</div>
