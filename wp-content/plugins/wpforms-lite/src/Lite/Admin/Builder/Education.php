<?php

namespace WPForms\Lite\Admin\Builder;

/**
 * Form Builder changes and enhancements to educate Lite users on what is
 * available in WPForms Pro.
 *
 * @package    WPForms\Admin\Builder
 * @author     WPForms
 * @since      1.5.1
 * @license    GPL-2.0+
 * @copyright  Copyright (c) 2018, WPForms LLC
 */
class Education {

	/**
	 * Constructor.
	 *
	 * @since 1.5.1
	 */
	public function __construct() {

		$this->hooks();
	}

	/**
	 * Hooks.
	 *
	 * @since 1.5.1
	 */
	public function hooks() {

		// Only proceed for the form builder.
		if ( ! \wpforms_is_admin_page( 'builder' ) ) {
			return;
		}

		\add_filter( 'wpforms_lite_builder_strings', array( $this, 'js_strings' ) );

		\add_action( 'wpforms_builder_enqueues_before', array( $this, 'enqueues' ) );

		\add_action( 'wpforms_setup_panel_after', array( $this, 'templates' ) );

		\add_filter( 'wpforms_builder_fields_buttons', array( $this, 'fields' ), 50 );

		\add_action( 'wpforms_providers_panel_sidebar', array( $this, 'providers' ), 50 );

		\add_action( 'wpforms_payments_panel_sidebar', array( $this, 'payments' ), 50 );
	}

	/**
	 * Localize needed strings.
	 *
	 * @since 1.5.1
	 *
	 * @param array $strings JS strings.
	 *
	 * @return array
	 */
	public function js_strings( $strings ) {

		$strings['upgrade_title']   = \esc_html__( 'is a PRO Feature', 'wpforms-lite' );
		$strings['upgrade_message'] = '<p>' . \esc_html__( 'We\'re sorry, the %name% is not available on your plan. Please upgrade to the PRO plan to unlock all these awesome features.', 'wpforms-lite' ) . '</p>';
		$strings['upgrade_bonus']   = '<p>' .
			\wp_kses(
				__( '<strong>Bonus:</strong> WPForms Lite users get <span>50% off</span> regular price, automatically applied at checkout.', 'wpforms-lite' ),
				array(
					'strong' => array(),
					'span'   => array(),
				)
			) .
		'</p>';
		$strings['upgrade_doc']     = '<a href="https://wpforms.com/docs/upgrade-wpforms-lite-paid-license/?utm_source=WordPress&amp;utm_medium=link&amp;utm_campaign=liteplugin" target="_blank" rel="noopener noreferrer" class="already-purchased">' . \esc_html__( 'Already purchased?' ) . '</a>';
		$strings['upgrade_button']  = \esc_html__( 'Upgrade to PRO', 'wpforms-lite' );
		$strings['upgrade_url']     = \esc_url( \wpforms_admin_upgrade_link( 'builder-modal' ) );
		$strings['upgrade_modal']   = \wpforms_get_upgrade_modal_text();

		return $strings;
	}

	/**
	 * Load enqueues.
	 *
	 * @since 1.5.1
	 */
	public function enqueues() {

		$min = \wpforms_get_min_suffix();

		\wp_enqueue_script(
			'wpforms-builder-education',
			\WPFORMS_PLUGIN_URL . "lite/assets/js/admin/builder-education{$min}.js",
			array( 'jquery', 'jquery-confirm' ),
			\WPFORMS_VERSION,
			false
		);
	}

	/**
	 * Display templates.
	 *
	 * @since 1.5.1
	 */
	public function templates() {

		$templates = array(
			array(
				'name'        => \esc_html__( 'Request A Quote Form', 'wpforms-lite' ),
				'slug'        => 'request-quote',
				'description' => \esc_html__( 'Start collecting leads with this pre-made Request a quote form. You can add and remove fields as needed.', 'wpforms-lite' ),
			),
			array(
				'name'        => \esc_html__( 'Donation Form', 'wpforms-lite' ),
				'slug'        => 'donation',
				'description' => \esc_html__( 'Start collecting donation payments on your website with this ready-made Donation form. You can add and remove fields as needed.', 'wpforms-lite' ),
			),
			array(
				'name'        => \esc_html__( 'Billing / Order Form', 'wpforms-lite' ),
				'slug'        => 'order',
				'description' => \esc_html__( 'Collect payments for product and service orders with this ready-made form template. You can add and remove fields as needed.', 'wpforms-lite' ),
			),
		);
		?>

		<div class="wpforms-setup-title">
			<?php \esc_html_e( 'Unlock Pre-Made Form Templates', 'wpforms-lite' ); ?>
			<a href="<?php echo \esc_url( \wpforms_admin_upgrade_link( 'builder-templates' ) ); ?>" target="_blank" rel="noopener noreferrer"
				class="btn-green wpforms-upgrade-link wpforms-upgrade-modal"
				style="text-transform: uppercase;font-size: 13px;font-weight: 700;padding: 5px 10px;vertical-align: text-bottom;">
				<?php \esc_html_e( 'Upgrade', 'wpforms-lite' ); ?>
			</a>
		</div>
		<p class="wpforms-setup-desc">
			<?php \esc_html_e( 'While WPForms Lite allows you to create any type of form, you can speed up the process by unlocking our other pre-built form templates among other features, so you never have to start from scratch again...', 'wpforms-lite' ); ?>
		</p>
		<div class="wpforms-setup-templates wpforms-clear" style="opacity:0.5;">
			<?php
			$x = 0;
			foreach ( $templates as $template ) {
				$class = 0 === $x % 3 ? 'first ' : '';
				?>
				<div class="wpforms-template upgrade-modal <?php echo \sanitize_html_class( $class ); ?>" id="wpforms-template-<?php echo \sanitize_html_class( $template['slug'] ); ?>">
					<div class="wpforms-template-name wpforms-clear">
						<?php echo \esc_html( $template['name'] ); ?>
					</div>
					<div class="wpforms-template-details">
						<p class="desc"><?php echo \esc_html( $template['description'] ); ?></p>
					</div>
				</div>
				<?php
				$x ++;
			}
			?>
		</div>
		<?php
	}

	/**
	 * Display fields.
	 *
	 * @since 1.5.1
	 *
	 * @param array $fields Form fields.
	 *
	 * @return array
	 */
	public function fields( $fields ) {

		$fields['fancy']['fields'] = array(
			array(
				'icon'  => 'fa-phone',
				'name'  => \esc_html__( 'Phone', 'wpforms-lite' ),
				'type'  => 'phone',
				'order' => '1',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-map-marker',
				'name'  => \esc_html__( 'Address', 'wpforms-lite' ),
				'type'  => 'address',
				'order' => '2',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-calendar-o',
				'name'  => \esc_html__( 'Date / Time', 'wpforms-lite' ),
				'type'  => 'date-time',
				'order' => '3',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-link',
				'name'  => \esc_html__( 'Website / URL', 'wpforms-lite' ),
				'type'  => 'url',
				'order' => '4',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-upload',
				'name'  => \esc_html__( 'File Upload', 'wpforms-lite' ),
				'type'  => 'file-upload',
				'order' => '5',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-lock',
				'name'  => \esc_html__( 'Password', 'wpforms-lite' ),
				'type'  => 'password',
				'order' => '6',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-files-o',
				'name'  => \esc_html__( 'Page Break', 'wpforms-lite' ),
				'type'  => 'pagebreak',
				'order' => '7',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-arrows-h',
				'name'  => \esc_html__( 'Section Divider', 'wpforms-lite' ),
				'type'  => 'divider',
				'order' => '8',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-eye-slash',
				'name'  => \esc_html__( 'Hidden Field', 'wpforms-lite' ),
				'type'  => 'hidden',
				'order' => '9',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-code',
				'name'  => \esc_html__( 'HTML', 'wpforms-lite' ),
				'type'  => 'html',
				'order' => '10',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-star',
				'name'  => \esc_html__( 'Rating', 'wpforms-lite' ),
				'type'  => 'rating',
				'order' => '11',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-question-circle',
				'name'  => \esc_html__( 'Captcha', 'wpforms-lite' ),
				'type'  => 'captcha',
				'order' => '12',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-pencil',
				'name'  => \esc_html__( 'Signature', 'wpforms-lite' ),
				'type'  => 'signature',
				'order' => '13',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-ellipsis-h',
				'name'  => \esc_html__( 'Likert Scale', 'wpforms-lite' ),
				'type'  => 'likert_scale',
				'order' => '14',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-tachometer',
				'name'  => \esc_html__( 'Net Promoter Score', 'wpforms-lite' ),
				'type'  => 'net_promoter_score',
				'order' => '15',
				'class' => 'upgrade-modal',
			),
		);

		$fields['payment']['fields'] = array(
			array(
				'icon'  => 'fa-file-o',
				'name'  => \esc_html__( 'Single Item', 'wpforms-lite' ),
				'type'  => 'payment-single',
				'order' => '1',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-list-ul',
				'name'  => \esc_html__( 'Multiple Items', 'wpforms-lite' ),
				'type'  => 'payment-multiple',
				'order' => '2',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-check-square-o',
				'name'  => \esc_html__( 'Checkbox Items', 'wpforms-lite' ),
				'type'  => 'payment-checkbox',
				'order' => '3',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-caret-square-o-down',
				'name'  => \esc_html__( 'Dropdown Items', 'wpforms-lite' ),
				'type'  => 'payment-select',
				'order' => '4',
				'class' => 'upgrade-modal',
			),
			array(
				'icon'  => 'fa-money',
				'name'  => \esc_html__( 'Total', 'wpforms-lite' ),
				'type'  => 'payment-total',
				'order' => '5',
				'class' => 'upgrade-modal',
			),
		);

		return $fields;
	}

	/**
	 * Display providers.
	 *
	 * @since 1.5.1
	 */
	public function providers() {

		$providers = array(
			array(
				'name' => 'AWeber',
				'slug' => 'aweber',
				'img'  => 'addon-icon-aweber.png',
			),
			array(
				'name' => 'Campaign Monitor',
				'slug' => 'campaign-monitor',
				'img'  => 'addon-icon-campaign-monitor.png',
			),
			array(
				'name' => 'Drip',
				'slug' => 'drip',
				'img'  => 'addon-icon-drip.png',
			),
			array(
				'name' => 'GetResponse',
				'slug' => 'getresponse',
				'img'  => 'addon-icon-getresponse.png',
			),
			array(
				'name' => 'MailChimp',
				'slug' => 'mailchimp',
				'img'  => 'addon-icon-mailchimp.png',
			),
			array(
				'name' => 'Zapier',
				'slug' => 'zapier',
				'img'  => 'addon-icon-zapier.png',
			),
		);

		foreach ( $providers as $provider ) {

			/* translators: %s - addon name*/
			$modal_name = sprintf( \esc_html__( '%s addon', 'wpforms-lite' ), $provider['name'] );
			echo '<a href="#" class="wpforms-panel-sidebar-section icon wpforms-panel-sidebar-section-' . \esc_attr( $provider['slug'] ) . ' upgrade-modal" data-name="' . \esc_attr( $modal_name ) . '">';
				echo '<img src="' . \esc_attr( WPFORMS_PLUGIN_URL ) . 'assets/images/' . \esc_attr( $provider['img'] ) . '">';
				echo \esc_html( $provider['name'] );
				echo '<i class="fa fa-angle-right wpforms-toggle-arrow"></i>';
			echo '</a>';
		}
	}

	/**
	 * Display payments.
	 *
	 * @since 1.5.1
	 */
	public function payments() {

		$payments = array(
			array(
				'name' => 'PayPal Standard',
				'slug' => 'paypal_standard',
				'img'  => 'addon-icon-paypal.png',
			),
			array(
				'name' => 'Stripe',
				'slug' => 'stripe',
				'img'  => 'addon-icon-stripe.png',
			),
		);

		foreach ( $payments as $payment ) {

			/* translators: %s - addon name*/
			$modal_name = sprintf( \esc_html__( '%s addon', 'wpforms-lite' ), $payment['name'] );
			echo '<a href="#" class="wpforms-panel-sidebar-section icon wpforms-panel-sidebar-section-' . \esc_attr( $payment['slug'] ) . ' upgrade-modal" data-name="' . \esc_attr( $modal_name ) . '">';
				echo '<img src="' . \esc_attr( WPFORMS_PLUGIN_URL ) . 'assets/images/' . \esc_attr( $payment['img'] ) . '">';
				echo \esc_html( $payment['name'] );
				echo '<i class="fa fa-angle-right wpforms-toggle-arrow"></i>';
			echo '</a>';
		}
	}
}
