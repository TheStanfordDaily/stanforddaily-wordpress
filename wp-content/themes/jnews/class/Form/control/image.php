<?php
$addbutton    = esc_html__('Add Image', 'jnews');
$removebutton = esc_html__('Remove Image', 'jnews');

$button = $addbutton;
$css    = 'hide_image';

if ( ! empty( $value ) ) 
{
    $button = $removebutton;
    $css    = '';
}

$image_url  = wp_get_attachment_image_src($value, 'full');
$image_url  = $image_url[0];

?>

<div class="widget-wrapper image-control type-image" data-field="<?php echo esc_attr($fieldkey) ?>" <?php echo !empty( $dependency ) ? 'data-dependency="' . esc_attr( json_encode( $dependency ) ) . '"' : ''; ?>>
    <label for="<?php echo esc_attr( $fieldid ); ?>"><?php echo esc_html( $title )  ?></label>

    <div class="image-content">
        <div class="image-wrapper <?php echo esc_attr($css); ?>">
            <img src="<?php echo esc_attr( $image_url ); ?>">
        </div>
        <input type="button" class="button-image-text button" data-toggle="<?php echo empty($value) ? 0 : 1; ?>" value="<?php echo esc_attr($button); ?>" data-add="<?php echo esc_attr($addbutton); ?>" data-remove="<?php echo esc_attr($removebutton); ?>">
        <input type="hidden" class="image-input" id="<?php echo esc_attr( $fieldid ) ?>" name="<?php echo esc_attr( $fieldname ) ?>" value="<?php echo esc_attr( $value ) ?>" />
    </div>

    <i><?php echo wp_kses( $desc, wp_kses_allowed_html() ) ?></i>
</div>