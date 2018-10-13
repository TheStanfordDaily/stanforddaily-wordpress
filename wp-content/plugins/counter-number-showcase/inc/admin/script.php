	<?php
			wp_enqueue_script('jquery');
			wp_enqueue_media();
			//color-picker css n js
			wp_enqueue_style('wp-color-picker');
			wp_enqueue_script('wpsm_Counter_Number_color-pic',wpshopmart_cns_directory_url.'assets/js/color-picker.js', array('wp-color-picker'), false ,true);
			wp_enqueue_style('wpsm_counter_box-panel-style', wpshopmart_cns_directory_url.'assets/css/panel-style.css');
			wp_enqueue_script('wpsm_Counter_Number-media-uploads',wpshopmart_cns_directory_url.'assets/js/media-upload-script.js',array('media-upload','thickbox','jquery'));
			wp_enqueue_style('wpsm_counter-sidebar', wpshopmart_cns_directory_url.'assets/css/sidebar.css');

			//font awesome css
			wp_enqueue_style('wpsm_counter-font-awesome', wpshopmart_cns_directory_url.'assets/css/font-awesome/css/font-awesome.min.css');
			wp_enqueue_style('wpsm_counter_jquery-ui', wpshopmart_cns_directory_url .'assets/css/cn_jquery-ui.css');
			wp_enqueue_style('wpsm_counter_box-bootstrap', wpshopmart_cns_directory_url.'assets/css/bootstrap.css');
			wp_enqueue_style('wpsm_counter-box-awesome-picker', wpshopmart_cns_directory_url.'assets/css/fontawesome-iconpicker.css');
			
			wp_enqueue_script( 'wpsm_counter_box-bootstrap-js', wpshopmart_cns_directory_url.'assets/js/bootstrap.js');

			// settings
			
			wp_enqueue_style('wpsm_counter_settings-css', wpshopmart_cns_directory_url.'assets/css/settings.css');
			
			//icon picker	
			wp_enqueue_script('wpsm_counter_box_call-icon-picker-js', wpshopmart_cns_directory_url.'assets/js/call-icon-picker.js',array('jquery'), false, true);
			wp_enqueue_script('wpsm_counter_box_font-icon-picker-js', wpshopmart_cns_directory_url.'assets/js/fontawesome-iconpicker.js',array('jquery'));
			
			//tooltip
			wp_enqueue_style('wpsm_cn_tooltip', wpshopmart_cns_directory_url.'assets/tooltip/darktooltip.css');
			wp_enqueue_script( 'wpsm_cn-tooltip-js', wpshopmart_cns_directory_url.'assets/tooltip/jquery.darktooltip.js');
			//css editor 
			wp_enqueue_style('wpsm_counterbox_codemirror-css', wpshopmart_cns_directory_url.'assets/codex/codemirror.css');
			wp_enqueue_style('wpsm_colorbox_ambiance', wpshopmart_cns_directory_url.'assets/codex/ambiance.css');
			wp_enqueue_style('wpsm_colorbox_show-hint-css', wpshopmart_cns_directory_url.'assets/codex/show-hint.css');
			
			wp_enqueue_script('wpsm_tabs_r_codemirror-js',wpshopmart_cns_directory_url.'assets/codex/codemirror.js',array('jquery'));
			wp_enqueue_script('wpsm_tabs_r_css-js',wpshopmart_cns_directory_url.'assets/codex/css.js',array('jquery'));
			wp_enqueue_script('wpsm_tabs_r_css-hint-js',wpshopmart_cns_directory_url.'assets/codex/css-hint.js',array('jquery'));
	
			//preview
			wp_enqueue_style('wpsm_counterbox_bootstrap-front-admin', wpshopmart_cns_directory_url.'assets/css/bootstrap-front.css');
			?>