<?php
class YOP_Poll_Public {
	public function __construct() {
		add_action( 'yop_poll_hourly_event', array( $this, 'cron' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_dependencies' ) );
		add_action( 'init', array( $this, 'load_translation' ) );
		add_action( 'init', array( $this, 'create_shortcodes' ) );
	}
	public function load_dependencies() {
		$this->load_styles();
		$this->load_scripts();
	}
	public function load_styles() {
		wp_enqueue_style( 'yop-public', YOP_POLL_URL . 'public/assets/css/yop-poll-public.css' );
	}
	public function load_scripts() {
		$plugin_settings = get_option( 'yop_poll_settings' );
		if ( false !== $plugin_settings ) {
			$plugin_settings_decoded = unserialize( $plugin_settings);
		}
		wp_enqueue_script( 'yop-public', YOP_POLL_URL . 'public/assets/js/yop-poll-public.min.js', array( 'jquery' ) );
		wp_enqueue_script( 'google-api', 'https://apis.google.com/js/platform.js', array( 'yop-public' ), null );
		wp_localize_script( 'yop-public', 'objectL10n', array(
			'yopPollParams' => array(
				'urlParams' => array(
					'ajax' => admin_url( 'admin-ajax.php' ),
					'wpLogin' => wp_login_url( admin_url( 'admin-ajax.php?action=yop_poll_record_wordpress_vote' ) )
				),
				'apiParams' => array(
					'facebook' => array(
						'appId' => isset( $plugin_settings_decoded['integrations']['facebook']['app_id'] )? $plugin_settings_decoded['integrations']['facebook']['app_id'] : ''
					),
					'google' => array(
						'apiKey' => isset( $plugin_settings_decoded['integrations']['google']['api_key'] )? $plugin_settings_decoded['integrations']['google']['api_key'] : '' ,
						'clientId' => isset( $plugin_settings_decoded['integrations']['google']['app_secret'] ) ? $plugin_settings_decoded['integrations']['google']['app_secret'] : ''
					)
				),
				'captchaParams' => array(
					'imgPath' => YOP_POLL_URL . 'public/assets/img/',
					'url' => YOP_POLL_URL . 'app.php',
					'accessibilityAlt' => esc_html__( 'Sound icon', 'yop-poll' ),
					'accessibilityTitle' => esc_html__( 'Accessibility option: listen to a question and answer it!', 'yop-poll' ),
					'accessibilityDescription' => __( 'Type below the <strong>answer</strong> to what you hear. Numbers or words:', 'yop-poll' ),
					'explanation' => __( "Click or touch the <strong>ANSWER</strong>", 'yop-poll' ),
					'refreshAlt' => esc_html__( 'Refresh/reload icon', 'yop-poll' ),
					'refreshTitle' => esc_html__( 'Refresh/reload: get new images and accessibility option!', 'yop-poll' )
				),
				'voteParams' => array(
					'invalidPoll' => esc_html__( 'Invalid Poll', 'yop-poll' ),
					'noAnswersSelected' => esc_html__( 'No answer selected', 'yop-poll' ),
					'minAnswersRequired' => esc_html__( 'At least {min_answers_allowed} answer(s) required', 'yop-poll' ),
					'maxAnswersRequired' => esc_html__( 'A max of {max_answers_allowed} answer(s) accepted', 'yop-poll' ),
					'noAnswerForOther' => esc_html__( 'No other answer entered', 'yop-poll' ),
					'noValueForCustomField' => esc_html__( '{custom_field_name} is required', 'yop-poll' ),
					'consentNotChecked' => esc_html__( 'You must agree to our terms and conditions', 'yop-poll' ),
					'noCaptchaSelected' => esc_html__( 'Captcha is required', 'yop-poll' ),
					'thankYou' => esc_html__( 'Thank you for your vote', 'yop-poll' )
				),
				'resultsParams'=> array(
					'singleVote' => esc_html__( 'vote', 'yop-poll' ),
					'multipleVotes' => esc_html__( 'votes', 'yop-poll' )
				)
			)
		));
	}
	public function load_translation() {
		load_plugin_textdomain( 'yop-poll', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
	public function create_shortcodes()  {
		add_shortcode( 'yop_poll', array( $this, 'parse_regular_shortcode' ) );
	}
	public function parse_regular_shortcode( $atts ) {
		$params = shortcode_atts(
			array(
                'id'      => - 1,
                'results' => 0,
                'tid'   => '',
                'show_results' => ''
            ),
			$atts, 'yop_poll' );
		return $this->generate_poll( $params );
	}
	public function generate_poll( $params ){
		if ( isset( $params['id'] ) && ( '' !== $params['id'] ) ) {
			$poll = '';
			$poll_ready_for_output = '';
			switch ( $params['id'] ) {
				case '-1': {
					$poll_id = YOP_Poll_Polls::get_current_active();
					break;
				}
				case '-2': {
					$poll_id = YOP_Poll_Polls::get_latest();
					break;
				}
				case '-3': {
					$poll_id = YOP_Poll_Polls::get_random();
					break;
				}
				default: {
					$poll_id = $params['id'];
					break;
				}
			}
			if ( isset( $poll_id ) ) {
				$poll = YOP_Poll_Polls::get_poll( $poll_id );
			}
			if ( false !== $poll ) {
				switch ( $poll->template_base ) {
					case 'basic': {
						$poll_ready_for_output = YOP_Poll_Basic::create_poll_view( $poll, $params );
						break;
					}
					case 'basic-pretty': {
						$poll_ready_for_output = YOP_Poll_Basic::create_poll_view( $poll, $params );
						break;
					}
				}
				$content_for_output = "<div class='bootstrap-yop'>
							{$poll_ready_for_output}
						</div>";
			} else {
				$content_for_output = '';
			}
			return $content_for_output;
		}
	}
	public function cron() {
		$polls = YOP_Poll_Polls::get_polls_for_cron();
		foreach ( $polls as $poll ) {
			if ( 'yes' === $poll['resetPollStatsAutomatically'] ) {
				if ( strtotime( $poll['resetPollStatsOn'] ) <= time() ) {
					YOP_Poll_Polls::reset_stats_for_poll( $poll['id'] );
					switch ( $poll['resetPollStatsEveryPeriod'] ) {
						case 'hours': {
							$unit_multiplier = 60 *60;
							break;
						}
						case 'days': {
							$unit_multiplier = 60 * 60 * 24;
							break;
						}
					}
					$next_reset_date = strtotime( $poll['resetPollStatsOn'] ) + intval( $poll['resetPollStatsEvery'] ) * $unit_multiplier;
					YOP_Poll_Polls::update_meta_data( $poll['id'], 'poll', 'resetPollStatsOn', date( 'Y-m-d H:i', $next_reset_date ) );
				}
			}
		}
	}
}
