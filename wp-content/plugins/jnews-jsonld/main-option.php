<?php

$options = array();

$options[] = array(
    'id'            => 'jnews_option[main_schema_type]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'organization',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Home Page Schema Type','jnews-jsonld'),
    'description'   => esc_html__('Choose which schema you want to use for your home page.','jnews-jsonld'),
    'choices'       => array(
        'person'        => esc_attr__( 'Person', 'jnews-jsonld' ),
        'organization'  => esc_attr__( 'Organization', 'jnews-jsonld' ),
    ),
);

$options[] = array(
    'id'            => 'jnews_option[main_schema_type_header_person]',
    'option_type'   => 'option',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Person Schema','jnews-jsonld' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'person',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_schema_person_name]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Name','jnews-jsonld'),
    'description'   => esc_html__('Insert person name.','jnews-jsonld'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'person',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_scheme_person_address]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Address','jnews-jsonld'),
    'description'   => esc_html__('Insert country address.','jnews-jsonld'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'person',
        )
    )
);



$options[] = array(
    'id'            => 'jnews_option[main_schema_type_header_organization]',
    'type'          => 'jnews-header',
    'label'         => esc_html__('Organization Schema','jnews-jsonld' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'organization',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_schema_organization_name]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Organization Name','jnews-jsonld'),
    'description'   => esc_html__('Insert organization or company name.','jnews-jsonld'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'organization',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_schema_logo]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-image',
    'label'         => esc_html__('Logo','jnews-jsonld' ),
    'description'   => esc_html__('Upload organization or company logo.','jnews-jsonld' ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'organization',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_scheme_telp]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Telephone','jnews-jsonld'),
    'description'   => esc_html__('e.g. : +1-880-555-1212','jnews-jsonld'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'organization',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_scheme_contact_type]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => 'customer_service',
    'type'          => 'jnews-select',
    'label'         => esc_html__('Contact Type','jnews-jsonld'),
    'description'   => esc_html__('Choose company contact type.','jnews-jsonld'),
    'choices'       => array(
        'customer service' => esc_attr__( 'Customer service', 'jnews-jsonld' ),
        'technical support' => esc_attr__( 'Technical support', 'jnews-jsonld' ),
        'billing support' => esc_attr__( 'Billing support', 'jnews-jsonld' ),
        'bill payment' => esc_attr__( 'Bill payment', 'jnews-jsonld' ),
        'sales' => esc_attr__( 'Sales', 'jnews-jsonld' ),
        'reservations' => esc_attr__( 'Reservations', 'jnews-jsonld' ),
        'credit card_support' => esc_attr__( 'Credit card support', 'jnews-jsonld' ),
        'emergency' => esc_attr__( 'Emergency', 'jnews-jsonld' ),
        'baggage tracking' => esc_attr__( 'Baggage tracking', 'jnews-jsonld' ),
        'roadside assistance' => esc_attr__( 'Roadside assistance', 'jnews-jsonld' ),
        'package tracking' => esc_attr__( 'Package tracking', 'jnews-jsonld' ),
    ),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'organization',
        )
    )
);

$options[] = array(
    'id'            => 'jnews_option[main_scheme_area]',
    'option_type'   => 'option',
    'transport'     => 'postMessage',
    'default'       => '',
    'type'          => 'jnews-text',
    'label'         => esc_html__('Area Served','jnews-jsonld'),
    'description'   => esc_html__('eg : US , or US,CA','jnews-jsonld'),
    'active_callback' => array(
        array(
            'setting'  => 'jnews_option[main_schema_type]',
            'operator' => '==',
            'value'    => 'organization',
        )
    )
);

return $options;