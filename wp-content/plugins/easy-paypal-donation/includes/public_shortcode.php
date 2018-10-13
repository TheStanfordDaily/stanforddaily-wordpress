<?php


// shortcode
add_shortcode('wpedon', 'wpedon_options');

function wpedon_options($atts) {

	// get shortcode id
		$atts = shortcode_atts(array(
			'id'		=> '',
			'align' 	=> '',
			'widget' 	=> '',
			'name' 		=> ''
		), $atts);
			
		$post_id = $atts['id'];

	// get settings page values
	$options = get_option('wpedon_settingsoptions');
	foreach ($options as $k => $v ) { $value[$k] = esc_attr($v); }
	
	
	// get values for button
	$amount = 	esc_attr(get_post_meta($post_id,'wpedon_button_price',true));
	$sku = 		esc_attr(get_post_meta($post_id,'wpedon_button_id',true));
	
	// price dropdown
	$wpedon_button_scpriceprice = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceprice',true));
	$wpedon_button_scpriceaname = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceaname',true));
	$wpedon_button_scpricebname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricebname',true));
	$wpedon_button_scpricecname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricecname',true));
	$wpedon_button_scpricedname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricedname',true));
	$wpedon_button_scpriceename = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceename',true));
	$wpedon_button_scpricefname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricefname',true));
	$wpedon_button_scpricegname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricegname',true));
	$wpedon_button_scpricehname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricehname',true));
	$wpedon_button_scpriceiname = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceiname',true));
	$wpedon_button_scpricejname = esc_attr(get_post_meta($post_id,'wpedon_button_scpricejname',true));
	
	$wpedon_button_scpricea = esc_attr(get_post_meta($post_id,'wpedon_button_scpricea',true));
	$wpedon_button_scpriceb = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceb',true));
	$wpedon_button_scpricec = esc_attr(get_post_meta($post_id,'wpedon_button_scpricec',true));
	$wpedon_button_scpriced = esc_attr(get_post_meta($post_id,'wpedon_button_scpriced',true));
	$wpedon_button_scpricee = esc_attr(get_post_meta($post_id,'wpedon_button_scpricee',true));
	$wpedon_button_scpricef = esc_attr(get_post_meta($post_id,'wpedon_button_scpricef',true));
	$wpedon_button_scpriceg = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceg',true));
	$wpedon_button_scpriceh = esc_attr(get_post_meta($post_id,'wpedon_button_scpriceh',true));
	$wpedon_button_scpricei = esc_attr(get_post_meta($post_id,'wpedon_button_scpricei',true));
	$wpedon_button_scpricej = esc_attr(get_post_meta($post_id,'wpedon_button_scpricej',true));

	$post_data = 	get_post($post_id);
	$name = 		$post_data->post_title;
	
	$rand_string = md5(uniqid(rand(), true));
	
	// show name
	$wpedon_button_enable_name = 		esc_attr(get_post_meta($post_id,'wpedon_button_enable_name',true));
	
	// show price
	$wpedon_button_enable_price = 		esc_attr(get_post_meta($post_id,'wpedon_button_enable_price',true));
	
	// show currency
	$wpedon_button_enable_currency = 	esc_attr(get_post_meta($post_id,'wpedon_button_enable_currency',true));


	// live of test mode
	if ($value['mode'] == "1") {
		$account = $value['sandboxaccount'];
		$path = "sandbox.paypal";
	} elseif ($value['mode'] == "2")  {
		$account = $value['liveaccount'];
		$path = "paypal";
	}
	
	$account_a = esc_attr(get_post_meta($post_id,'wpedon_button_account',true));
	if (!empty($account_a)) { $account = $account_a; }

	// currency
	$currency_a = esc_attr(get_post_meta($post_id,'wpedon_button_currency',true));
	if (!empty($currency_a)) { $value['currency'] = $currency_a; }
		
	if ($value['currency'] == "1") { $currency = "AUD"; }
	if ($value['currency'] == "2") { $currency = "BRL"; }
	if ($value['currency'] == "3") { $currency = "CAD"; }
	if ($value['currency'] == "4") { $currency = "CZK"; }
	if ($value['currency'] == "5") { $currency = "DKK"; }
	if ($value['currency'] == "6") { $currency = "EUR"; }
	if ($value['currency'] == "7") { $currency = "HKD"; }
	if ($value['currency'] == "8") { $currency = "HUF"; }
	if ($value['currency'] == "9") { $currency = "ILS"; }
	if ($value['currency'] == "10") { $currency = "JPY"; }
	if ($value['currency'] == "11") { $currency = "MYR"; }
	if ($value['currency'] == "12") { $currency = "MXN"; }
	if ($value['currency'] == "13") { $currency = "NOK"; }
	if ($value['currency'] == "14") { $currency = "NZD"; }
	if ($value['currency'] == "15") { $currency = "PHP"; }
	if ($value['currency'] == "16") { $currency = "PLN"; }
	if ($value['currency'] == "17") { $currency = "GBP"; }
	if ($value['currency'] == "18") { $currency = "RUB"; }
	if ($value['currency'] == "19") { $currency = "SGD"; }
	if ($value['currency'] == "20") { $currency = "SEK"; }
	if ($value['currency'] == "21") { $currency = "CHF"; }
	if ($value['currency'] == "22") { $currency = "TWD"; }
	if ($value['currency'] == "23") { $currency = "THB"; }
	if ($value['currency'] == "24") { $currency = "TRY"; }
	if ($value['currency'] == "25") { $currency = "USD"; }
	
	// language
	$language_a = esc_attr(get_post_meta($post_id,'wpedon_button_language',true));
	if (!empty($language_a)) { $value['language'] = $language_a; }

	if ($value['language'] == "1") {
		$language = "da_DK";
		$imagea = "https://www.paypal.com/da_DK/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/da_DK/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/da_DK/DK/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Danish

	if ($value['language'] == "2") {
		$language = "nl_BE";
		$imagea = "https://www.paypal.com/nl_NL/NL/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/nl_NL/NL/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/nl_NL/NL/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Dutch

	if ($value['language'] == "3") {
		$language = "EN_US";
		$imagea = "https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //English

	if ($value['language'] == "20") {
		$language = "en_GB";
		$imagea = "https://www.paypalobjects.com/en_GB/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypalobjects.com/en_GB/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //English - UK

	if ($value['language'] == "4") {
		$language = "fr_CA";
		$imagea = "https://www.paypal.com/fr_CA/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/fr_CA/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/fr_CA/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //French

	if ($value['language'] == "5") {
		$language = "de_DE";
		$imagea = "https://www.paypal.com/de_DE/DE/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/de_DE/DE/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/de_DE/DE/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //German

	if ($value['language'] == "6") {
		$language = "he_IL";
		$imagea = "https://www.paypal.com/he_IL/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/he_IL/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/he_IL/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Hebrew

	if ($value['language'] == "7") {
		$language = "it_IT";
		$imagea = "https://www.paypal.com/it_IT/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/it_IT/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/it_IT/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Italian

	if ($value['language'] == "8") {
		$language = "ja_JP";
		$imagea = "https://www.paypal.com/ja_JP/JP/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/ja_JP/JP/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/ja_JP/JP/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Japanese

	if ($value['language'] == "9") {
		$language = "no_NO";
		$imagea = "https://www.paypal.com/no_NO/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/no_NO/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/no_NO/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Norwgian

	if ($value['language'] == "10") {
		$language = "pl_PL";
		$imagea = "https://www.paypal.com/pl_PL/PL/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/pl_PL/PL/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/pl_PL/PL/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Polish

	if ($value['language'] == "11") {
		$language = "pt_BR";
		$imagea = "https://www.paypal.com/pt_PT/PT/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/pt_PT/PT/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/pt_PT/PT/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Portuguese

	if ($value['language'] == "12") {
		$language = "ru_RU";
		$imagea = "https://www.paypal.com/ru_RU/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/ru_RU/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/ru_RU/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Russian

	if ($value['language'] == "13") {
		$language = "es_ES";
		$imagea = "https://www.paypal.com/es_ES/ES/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/es_ES/ES/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/es_ES/ES/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Spanish

	if ($value['language'] == "14") {
		$language = "sv_SE";
		$imagea = "https://www.paypal.com/sv_SE/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/sv_SE/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/sv_SE/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Swedish

	if ($value['language'] == "15") {
		$language = "zh_CN";
		$imagea = "https://www.paypal.com/zh_XC/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/zh_XC/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/zh_XC/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Simplified Chinese - China

	if ($value['language'] == "16") {
		$language = "zh_HK";
		$imagea = "https://www.paypal.com/zh_HK/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/zh_HK/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/zh_HK/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Traditional Chinese - Hong Kong

	if ($value['language'] == "17") {
		$language = "zh_TW";
		$imagea = "https://www.paypalobjects.com/en_US/TW/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypalobjects.com/en_US/TW/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypalobjects.com/en_US/TW/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Traditional Chinese - Taiwan

	if ($value['language'] == "18") {
		$language = "tr_TR";
		$imagea = "https://www.paypal.com/tr_TR/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/tr_TR/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/tr_TR/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Turkish

	if ($value['language'] == "19") {
		$language = "th_TH";
		$imagea = "https://www.paypal.com/en_US/i/btn/btn_donate_SM.gif";
		$imageb = "https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif";
		$imagec = "https://www.paypal.com/en_US/i/btn/btn_donateCC_LG.gif";
		$imaged = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_74x21.png";
		$imagee = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_92x26.png";
		$imagef = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_cc_147x47.png";
		$imageg = "https://www.paypalobjects.com/webstatic/en_US/btn/btn_donate_pp_142x27.png";
	} //Thai - Thai buttons not available for donation - using US is correct
	
	// custom button size
	$wpedon_button_buttonsize = esc_attr(get_post_meta($post_id,'wpedon_button_buttonsize',true));
	
	if ($wpedon_button_buttonsize != "0") {
		$value['size'] = $wpedon_button_buttonsize;
	}

	// button size
	if ($value['size'] == "1") { $img = $imagea; }
	if ($value['size'] == "2") { $img = $imageb; }
	if ($value['size'] == "3") { $img = $imagec; }
	if ($value['size'] == "4") { $img = $imaged; }
	if ($value['size'] == "5") { $img = $imagee; }
	if ($value['size'] == "6") { $img = $imagef; }
	if ($value['size'] == "7") { $img = $imageg; }
	if ($value['size'] == "8") { $img = $value['image_1']; }
	
	// widget
	if ($atts['widget'] == "true") {
		$width = "180px";
	} else {
		$width = "220px";
	}
	
	// return url
	$return = "";
	$return = $value['return'];
	$return_a = esc_attr(get_post_meta($post_id,'wpedon_button_return',true));
	if (!empty($return_a)) { $return = $return_a; }

	// window action
	if ($value['opens'] == "1") { $target = ""; }
	if ($value['opens'] == "2") { $target = "_blank"; }

	// alignment
	if ($atts['align'] == "left") { $alignment = "style='float: left;'"; }
	if ($atts['align'] == "right") { $alignment = "style='float: right;'"; }
	if ($atts['align'] == "center") { $alignment = "style='margin-left: auto;margin-right: auto;width:$width'"; }
	if (empty($atts['align'])) { $alignment = ""; }
	
	// notify url
	$notify_url = get_admin_url() . "admin-post.php?action=add_wpedon_button_ipn";

	$output = "";
	$output .= "<div $alignment>";
	
	// text description title
	if ($wpedon_button_enable_name == "1" || $wpedon_button_enable_price == "1") {
		$output .= "<label>";
	}
	
	if ($wpedon_button_enable_name == "1") {
		$output .= $name;
	}
	
	if ($wpedon_button_enable_name == "1" && $wpedon_button_enable_price == "1") {
		$output .= "<br /><span class='price'>";
	}
	
	if ($wpedon_button_enable_price == "1") {
		$output .= $amount ."</span>";
	}
	
	if ($wpedon_button_enable_price == "1") {
		if ($wpedon_button_enable_currency == "1") {
			$output .= $currency;
		}
	}
	
	if ($wpedon_button_enable_name == "1" || $wpedon_button_enable_price == "1") {
		$output .= "</label><br />";
	}
	
	// price dropdown menu
	if (!empty($wpedon_button_scpriceprice)) {
	
		// dd is active so set first value just in case no option is selected by user
		$amount =$wpedon_button_scpricea;
		
		$output .= "
		<script>
		jQuery(document).ready(function(){
			jQuery('#dd_$rand_string').on('change', function() {
			  jQuery('#amount_$rand_string').val(this.value);
			});
		});
		</script>
		";
		
		
		if (!empty($wpedon_button_scpriceprice)) { $output .= "<label style='font-size:11pt !important;'>$wpedon_button_scpriceprice</label><br /><select name='dd_$rand_string' id='dd_$rand_string' style='width:100% !important;min-width:$width !important;max-width:$width !important;border: 1px solid #ddd !important;'>"; }
		if (!empty($wpedon_button_scpriceaname)) { $output .= "<option value='$wpedon_button_scpricea'>". $wpedon_button_scpriceaname ."</option>"; }
		if (!empty($wpedon_button_scpricebname)) { $output .= "<option value='$wpedon_button_scpriceb'>". $wpedon_button_scpricebname ."</option>"; }
		if (!empty($wpedon_button_scpricecname)) { $output .= "<option value='$wpedon_button_scpricec'>". $wpedon_button_scpricecname ."</option>"; }
		if (!empty($wpedon_button_scpricedname)) { $output .= "<option value='$wpedon_button_scpriced'>". $wpedon_button_scpricedname ."</option>"; }
		if (!empty($wpedon_button_scpriceename)) { $output .= "<option value='$wpedon_button_scpricee'>". $wpedon_button_scpriceename ."</option>"; }
		if (!empty($wpedon_button_scpricefname)) { $output .= "<option value='$wpedon_button_scpricef'>". $wpedon_button_scpricefname ."</option>"; }
		if (!empty($wpedon_button_scpricegname)) { $output .= "<option value='$wpedon_button_scpriceg'>". $wpedon_button_scpricegname ."</option>"; }
		if (!empty($wpedon_button_scpricehname)) { $output .= "<option value='$wpedon_button_scpriceh'>". $wpedon_button_scpricehname ."</option>"; }
		if (!empty($wpedon_button_scpriceiname)) { $output .= "<option value='$wpedon_button_scpricei'>". $wpedon_button_scpriceiname ."</option>"; }
		if (!empty($wpedon_button_scpricejname)) { $output .= "<option value='$wpedon_button_scpricej'>". $wpedon_button_scpricejname ."</option>"; }
		if (!empty($wpedon_button_scpriceprice)) { $output .= "</select><br /><br />"; }
	}
	
	
	// override name field if passed as shortcode attribute
	if (!empty($atts['name'])) {
		$name = $atts['name'];
	}

	$output .= "<form target='$target' action='https://www.$path.com/cgi-bin/webscr' method='post'>";
	$output .= "<input type='hidden' name='cmd' value='_donations' />";
	$output .= "<input type='hidden' name='business' value='$account' />";
	$output .= "<input type='hidden' name='item_name' value='$name' />";
	$output .= "<input type='hidden' name='item_number' value='$sku' />";
	$output .= "<input type='hidden' name='currency_code' value='$currency' />";
	// optional - required for fixed amounts
	$output .= "<input type='hidden' name='amount' id='amount_$rand_string' value='$amount' />";
	$output .= "<input type='hidden' name='no_note' value='". $value['no_note'] ."'>";
	$output .= "<input type='hidden' name='no_shipping' value='". $value['no_shipping'] ."'>";
	$output .= "<input type='hidden' name='notify_url' value='$notify_url'>";
	$output .= "<input type='hidden' name='lc' value='$language'>";
	$output .= "<input type='hidden' name='bn' value='WPPlugin_SP'>";
	$output .= "<input type='hidden' name='return' value='$return' />";
	$output .= "<input type='hidden' name='cancel_return' value='". $value['cancel'] ."' />";
	$output .= "<input class='wpedon_paypalbuttonimage' type='image' src='$img' border='0' name='submit' alt='Make your payments with PayPal. It is free, secure, effective.' style='border: none;'>";
	$output .= "<img alt='' border='0' style='border:none;display:none;' src='https://www.paypal.com/$language/i/scr/pixel.gif' width='1' height='1'>";
	$output .= "</form></div>";

	return $output;
	
}