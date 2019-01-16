<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_head', $head_info); ?>

<div class="vp-ajax-button">
    <input type="button" data-ajax-call="<?php echo esc_attr($ajax_call); ?>" class="vp-button button button-primary" value="<?php echo esc_html($head_info['label']); ?>" />
</div>
<div class="vp-ajax-button-response">
    <div class="vp-js-bind-loader vp-field-loader vp-hide"><img src="<?php VP_Util_Res::img_out('ajax-loader.gif', ''); ?>" /></div>
    <div class="vp-ajax-response"></div>
</div>

<?php if(!$is_compact) echo VP_View::instance()->load('control/template_control_foot', $head_info); ?>