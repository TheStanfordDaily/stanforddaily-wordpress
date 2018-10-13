<?php

$options = array();

$user_role = array(
    'subscriber'  => esc_html__('Subscriber', 'jnews-social-login'),
    'contributor' => esc_html__('Contributor', 'jnews-social-login'),
);

if ( jeg_social_login_bbpress_plugin_check() )
{
    $user_role['participant'] = esc_html__('Participant', 'jnews-social-login');
}

$options[] = array(
    'id'              => 'jnews_option[social_login_alert]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => 'info',
    'type'            => 'jnews-alert',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Social Login Info','jnews-social-login'),
    'description'     => jeg_show_social_login_info(),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_show]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => 'hide',
    'type'            => 'jnews-select',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Show Social Login','jnews-social-login'),
    'description'     => esc_html__('Choose the location to display the social login & registration.','jnews-social-login'),
    'choices'         => array(
        'login'    => esc_html__('Login Only', 'jnews-social-login'),
        'register' => esc_html__('Registration Only', 'jnews-social-login'),
        'both'     => esc_html__('Show on Both', 'jnews-social-login'),
        'hide'     => esc_html__('Hide', 'jnews-social-login'),
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_user_role]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => 'subscriber',
    'type'            => 'jnews-select',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('User Role','jnews-social-login'),
    'description'     => esc_html__('Choose new user default role.','jnews-social-login'),
    'choices'         => $user_role,
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_style]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => 'normal',
    'type'            => 'jnews-select',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Social Login Style','jnews-social-login'),
    'description'     => esc_html__('Choose social login button style.','jnews-social-login'),
    'choices'         => array(
        'normal' => esc_html__('Normal', 'jnews-social-login'),
        'light'  => esc_html__('Light', 'jnews-social-login'),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_enable_facebook]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-toggle',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Facebook Integration','jnews-social-login'),
    'description'     => esc_html__('Enable Facebook login and registration.','jnews-social-login'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_facebook_id]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Facebook App ID','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Facebook App ID <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://developers.facebook.com/docs/apps/register'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_facebook]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_facebook_secret]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Facebook App Secret','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Facebook App Secret <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://developers.facebook.com/docs/apps/register'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_facebook]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_enable_google]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-toggle',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Google Integration','jnews-social-login'),
    'description'     => esc_html__('Enable Google login and registration.','jnews-social-login'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_google_app_name]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Google Apps Name','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Google Apps <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://developers.google.com/+/web/api/rest/oauth'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_google]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_google_id]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Google Client ID','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Google Client ID <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://developers.google.com/+/web/api/rest/oauth'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_google]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_google_secret]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Google Client Secret','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Google Client Secret <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://developers.google.com/+/web/api/rest/oauth'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_google]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_enable_linkedin]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-toggle',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Linked In Integration','jnews-social-login'),
    'description'     => esc_html__('Enable Linked In login and registration.','jnews-social-login'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_linkedin_id]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Linked In Client ID','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Linked In Client ID <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://www.linkedin.com/secure/developer'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_linkedin]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

$options[] = array(
    'id'              => 'jnews_option[social_login_linkedin_secret]',
    'option_type'     => 'option',
    'transport'       => 'postMessage',
    'default'         => '',
    'type'            => 'jnews-text',
    'section'         => 'jnews_social_login_section',
    'label'           => esc_html__('Linked In Client Secret','jnews-social-login'),
    'description'     => sprintf(__('You can create an application and get Linked In Client Secret <a href="%s" target="_blank">here</a>.', 'jnews-social-login'), 'https://www.linkedin.com/secure/developer'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[social_login_show]',
            'operator' => '!=',
            'value'    => 'hide',
        ),
        array(
            'setting'  => 'jnews_option[social_login_enable_linkedin]',
            'operator' => '==',
            'value'    => true,
        )
    ),
);

return $options;