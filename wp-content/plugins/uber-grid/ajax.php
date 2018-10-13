<?php class UberGrid_Ajax {
	function __construct(){
		add_action('wp_ajax_uber_grid_ping', array($this, '_ping'));
		add_action('wp_ajax_nopriv_uber_grid_ping', array($this, '_ping'));

		add_action('wp_ajax_uber_grid_render_grid', array($this, '_render_grid'));
		add_action('wp_ajax_nopriv_uber_grid_render_grid', array($this, '_render_grid'));
		add_action('wp_ajax_uber_grid_render_grid_iframe',
			array($this, '_render_grid_iframe'));
		add_action('wp_ajax_nopriv_uber_grid_render_grid_iframe',
			array($this, '_render_grid_iframe'));
	}

	function _ping(){
		echo 'working';
		exit;
	}

	function _render_grid(){
		$id = (int)$_REQUEST['id'];
		?>
		<div class="ubergrid-ajax-wrapper">
			<?php echo ubergrid($id, array('buttons' => false, 'lightbox' => true)) ?>
		</div>
		<?php
		exit;
	}

	function _render_grid_iframe(){
		$id = (int)$_REQUEST['id'];
		$style = UBERGRID_URL . "assets/css/uber-grid.css?ver=" . UBERGRID_VERSION;
		?>
		<!DOCTYPE html>
		<html>
			<head>
				<title></title>
				<link rel="stylesheet" href="<?php echo esc_attr($style) ?>"></link>
			</head>
			<body>
				<div class="ubergrid-ajax-wrapper">
					<?php echo ubergrid($id, array('buttons' => false, 'lightbox' => true)) ?>
				</div>
			</body>
		</html>
		<?php
		exit;
	}
}
new UberGrid_Ajax;
