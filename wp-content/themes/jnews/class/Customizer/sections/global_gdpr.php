<?php

$options = array();


$options[] = array(
	'id'            => 'jnews_gdpr_cookie_header',
	'type'          => 'jnews-header',
	'label'         => esc_html__('Cookie Law Policy Settings','jnews' ),
);

$options[] = array(
	'id'            => 'jnews_gdpr_cookie_enable',
	'transport'     => 'postMessage',
	'default'       => false,
	'type'          => 'jnews-toggle',
	'label'         => esc_html__('Enable Cookie Law Policy', 'jnews'),
	'description'   => esc_html__('Enable cookie law policy agreement (GDPR) on the footer.', 'jnews')
);

$options[] = array(
	'id'            => 'jnews_gdpr_cookie_text',
	'transport'     => 'postMessage',
	'default'       => esc_html__('This website uses cookies. By continuing to use this website you are giving consent to cookies being used. Visit our <a href="#">Privacy and Cookie Policy</a>.', 'jnews'),
	'type'          => 'jnews-textarea',
	'label'         => esc_html__('Cookie Law Policy Text', 'jnews'),
	'description'   => esc_html__('Insert text for cookie law policy text.', 'jnews'),
	'active_callback' => array(
		array(
			'setting'  => 'jnews_gdpr_cookie_enable',
			'operator' => '==',
			'value'    => true,
		)
	),
);

$options[] = array(
	'id'            => 'jnews_gdpr_cookie_button',
	'transport'     => 'postMessage',
	'default'       => esc_html__('I Agree', 'jnews'),
	'type'          => 'jnews-text',
	'label'         => esc_html__('Cookie Law Policy Button', 'jnews'),
	'description'   => esc_html__('Insert text for cookie law policy button text.', 'jnews'),
	'active_callback' => array(
		array(
			'setting'  => 'jnews_gdpr_cookie_enable',
			'operator' => '==',
			'value'    => true,
		)
	),
);

$options[] = array(
	'id'            => 'jnews_gdpr_cookie_expire',
	'transport'     => 'postMessage',
	'default'       => 7,
	'type'          => 'jnews-slider',
	'label'         => esc_html__('Cookie Law Policy Expire','jnews'),
	'description'   => esc_html__('Set the expired days of cookie law policy agreement.','jnews'),
	'choices'       => array(
		'min'  => '1',
		'max'  => '100',
		'step' => '1',
	),
	'active_callback'  => array(
		array(
			'setting'  => 'jnews_gdpr_cookie_enable',
			'operator' => '==',
			'value'    => true,
		),
	)
);

$options[] = array(
	'id'            => 'jnews_gdpr_comment_header',
	'type'          => 'jnews-header',
	'label'         => esc_html__('Comment Form Settings','jnews' ),
);

$options[] = array(
	'id'            => 'jnews_gdpr_comment_enable',
	'transport'     => 'postMessage',
	'default'       => false,
	'type'          => 'jnews-toggle',
	'label'         => esc_html__('Enable Privacy Policy', 'jnews'),
	'description'   => esc_html__('Enable privacy policy (GDPR) checkbox on WordPress comment form.', 'jnews')
);

$options[] = array(
	'id'            => 'jnews_gdpr_comment_label',
	'transport'     => 'postMessage',
	'default'       => esc_html__('Privacy Policy Agreement', 'jnews'),
	'type'          => 'jnews-text',
	'label'         => esc_html__('Privacy Policy Label', 'jnews'),
	'description'   => esc_html__('Insert text for privacy policy label.', 'jnews'),
	'postvar'       => array(
		array(
			'redirect'  => 'single_post_tag',
			'refresh'   => true
		)
	),
	'active_callback' => array(
		array(
			'setting'  => 'jnews_gdpr_comment_enable',
			'operator' => '==',
			'value'    => true,
		)
	),
);

$options[] = array(
	'id'            => 'jnews_gdpr_comment_text',
	'transport'     => 'postMessage',
	'default'       => esc_html__('I agree to the Terms &amp; Conditions and <a href="#">Privacy Policy</a>.', 'jnews'),
	'type'          => 'jnews-textarea',
	'label'         => esc_html__('Privacy Policy Text', 'jnews'),
	'description'   => esc_html__('Insert text for privacy policy text.', 'jnews'),
	'postvar'       => array(
		array(
			'redirect'  => 'single_post_tag',
			'refresh'   => true
		)
	),
	'active_callback' => array(
		array(
			'setting'  => 'jnews_gdpr_comment_enable',
			'operator' => '==',
			'value'    => true,
		)
	),
);

$options[] = array(
	'id'            => 'jnews_gdpr_register_header',
	'type'          => 'jnews-header',
	'label'         => esc_html__('Register Form Settings','jnews' ),
);

$options[] = array(
	'id'            => 'jnews_gdpr_register_enable',
	'transport'     => 'postMessage',
	'default'       => false,
	'type'          => 'jnews-toggle',
	'label'         => esc_html__('Enable Privacy Policy', 'jnews'),
	'description'   => esc_html__('Enable privacy policy (GDPR) text on register form.', 'jnews')
);

$options[] = array(
	'id'            => 'jnews_gdpr_register_text',
	'transport'     => 'postMessage',
	'default'       => esc_html__('<span class="required">*</span>By registering into our website, you agree to the Terms &amp; Conditions and <a href="#">Privacy Policy</a>.', 'jnews'),
	'type'          => 'jnews-textarea',
	'label'         => esc_html__('Privacy Policy Text', 'jnews'),
	'description'   => esc_html__('Insert text for privacy policy text.', 'jnews'),
	'active_callback' => array(
		array(
			'setting'  => 'jnews_gdpr_register_enable',
			'operator' => '==',
			'value'    => true,
		)
	),
);

$options[] = array(
	'id'            => 'jnews_gdpr_google_font_header',
	'type'          => 'jnews-header',
	'label'         => esc_html__('Google Fonts Settings','jnews' ),
);

$options[] = array(
	'id'            => 'jnews_gdpr_google_font_disable',
	'transport'     => 'refresh',
	'default'       => false,
	'type'          => 'jnews-toggle',
	'label'         => esc_html__('Disable Google Fonts', 'jnews'),
	'description'   => esc_html__('Disable all Google fonts (GDPR) and you can use Custom Font option (self-hosted) or default system fonts instead.', 'jnews')
);

return $options;