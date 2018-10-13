<?php
class Yop_Poll_DbSchema {
	private $charset;
	public function __construct() {
		$this->charset = $GLOBALS['wpdb']->get_charset_collate();
		$this->initialize_tables_names();
	}
	public function create_tables() {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		$this->create_table_templates();
		$this->install_templates();
		$this->create_table_polls();
		$this->create_table_elements();
		$this->create_table_subelements();
		$this->create_table_bans();
		$this->create_table_votes();
		$this->create_table_logs();
	}
	public static function initialize_tables_names() {
		$GLOBALS['wpdb']->yop_poll_polls = $GLOBALS['wpdb']->prefix . 'yoppoll_polls';
		$GLOBALS['wpdb']->yop_poll_elements = $GLOBALS['wpdb']->prefix . 'yoppoll_elements';
		$GLOBALS['wpdb']->yop_poll_subelements = $GLOBALS['wpdb']->prefix . 'yoppoll_subelements';
		$GLOBALS['wpdb']->yop_poll_bans = $GLOBALS['wpdb']->prefix . 'yoppoll_bans';
		$GLOBALS['wpdb']->yop_poll_votes = $GLOBALS['wpdb']->prefix . 'yoppoll_votes';
		$GLOBALS['wpdb']->yop_poll_logs = $GLOBALS['wpdb']->prefix . 'yoppoll_logs';
        $GLOBALS['wpdb']->yop_poll_templates = $GLOBALS['wpdb']->prefix . 'yoppoll_templates';
	}
	public function create_table_polls() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_polls}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			name varchar(255) NOT NULL,
			template int(11) NOT NULL,
			template_base varchar(255) NOT NULL,
			author bigint(20) NOT NULL,
			stype varchar(20) NOT NULL,
			status varchar(20) NOT NULL,
			meta_data longtext NOT NULL,
			total_submits int(11) NOT NULL,
			total_submited_answers int(11) NOT NULL,
			added_date datetime NOT NULL,
			modified_date datetime NOT NULL,
			PRIMARY KEY (id)
		) {$this->charset};";
		dbDelta( $create_table_sql );
	}
	public function create_table_elements() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_elements}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			poll_id int(11) NOT NULL,
			etext text NOT NULL,
			author bigint(20) NOT NULL,
			etype varchar(20) NOT NULL,
			status varchar(20) NOT NULL,
			sorder int(11) NOT NULL,
			meta_data longtext NOT NULL,
			added_date datetime NOT NULL,
			modified_date DATETIME NOT NULL,
			PRIMARY KEY (id)
		) {$this->charset};";
		dbDelta( $create_table_sql );
	}
	public function create_table_subelements() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_subelements}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			poll_id int(11) NOT NULL,
			element_id int(11) NOT NULL,
			stext text not null,
			author bigint(20) NOT NULL,
			stype varchar(20) NOT NULL,
			status varchar(20) NOT NULL,
			sorder int(11) NOT NULL,
			meta_data longtext NOT NULL,
			total_submits int(11) NOT NULL,
			added_date datetime NOT NULL,
			modified_date datetime NOT NULL,
			PRIMARY KEY (id)
		) {$this->charset};";
		dbDelta( $create_table_sql );
	}
	public function create_table_bans() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_bans}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			author bigint(20) NOT NULL,
			poll_id int(11) NOT NULL,
			b_by varchar(255) NOT NULL,
			b_value varchar(255) NOT NULL,
			added_date datetime NOT NULL,
			modified_date datetime NOT NULL,
			PRIMARY KEY (id)
		) {$this->charset};";
		dbDelta( $create_table_sql);
	}
	public function create_table_votes() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_votes}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			poll_id int(11) NOT NULL,
			user_id bigint(20) NOT NULL,
			user_email varchar(255) NULL,
			user_type varchar(100) NOT NULL,
			ipaddress varchar(100) NOT NULL,
			tracking_id varchar(255) NOT NULL,
			voter_id varchar(255) NOT NULL,
			voter_fingerprint varchar(255) NOT NULL,
			vote_data longtext NOT NULL,
			status varchar(10) NOT NULL,
			added_date datetime NOT NULL,
			PRIMARY KEY ( id )
		) {$this->charset};";
		dbDelta( $create_table_sql );
	}
	public function create_table_logs() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_logs}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			poll_id int(11) NOT NULL,
			poll_author bigint(20) NOT NULL,
			user_id bigint(20) NOT NULL,
			user_email varchar(255) NULL,
			user_type varchar(100) NOT NULL,
			ipaddress varchar(100) NOT NULL,
			tracking_id varchar(255) NOT NULL,
			voter_id varchar(255) NOT NULL,
			voter_fingerprint varchar(255) NOT NULL,
			vote_data longtext NOT NULL,
			vote_message longtext NOT NULL,
			added_date datetime NOT NULL,
			PRIMARY KEY ( id )
		) {$this->charset};";
		dbDelta( $create_table_sql );
	}
	public function create_table_templates() {
		$create_table_sql = "CREATE TABLE `{$GLOBALS['wpdb']->yop_poll_templates}` (
			id int(11) NOT NULL AUTO_INCREMENT,
			name varchar(255) NOT NULL,
			base varchar(255) NOT NULL,
			description text NOT NULL,
			image_preview varchar(255) NOT NULL,
			html_preview text NOT NULL,
			html_vertical text NOT NULL,
			html_horizontal text NOT NULL,
			html_columns text NOT NULL,
			added_date datetime NOT NULL,
			PRIMARY KEY (id)
		) {$this->charset};";
		dbDelta( $create_table_sql );
	}
	public function install_templates() {
		$plugin_version = get_option( 'yop_poll_version' );
		$available_templates = YOP_Poll_Templates::get_templates();
		$table = $GLOBALS['wpdb']->yop_poll_templates;
		$templates = array(
			0 => array(
				'name' => 'Basic Template',
				'base' => 'basic',
				'description' => '',
				'image_preview' => 'basic.png',
				'html_preview' => '<div class="basic-preview-container">
									<div class="basic-preview-question">Question</div>
									<div class="basic-preview-answer">
										<div class="basic-preview-radio"></div>
										<div class="basic-preview-content">Answer 1</div>
									</div>
									<div class="basic-preview-answer">
										<div class="basic-preview-radio"></div>
										<div class="basic-preview-content">Answer 2</div>
									</div>
                                    <div class="basic-preview-captcha">captcha</div>
                                    <div class="basic-preview-vote">Vote</div>
								</div>',
				'html_vertical' => '<div class="basic-yop-poll-container">
				    <div class="basic-canvas"></div>
				    <div class="basic-inner">
				        <div class="basic-message">
				            <p>
				            </p>
				        </div>
				        <form class="basic-form">
				            <div class="basic-questions">
				                <div class="basic-element basic-question">
				                    <div class="basic-question-title">
									</div>
									<ul class="basic-answers">
									</ul>
								</div>
							</div>
							<div class="basic-element basic-vote-button">
				                <a href="#" class="button basic-vote">Vote</a>
				                <button class="basic-results">See Results</button>
				            </div>
						</form>
					</div>
				</div>
				',
				'html_horizontal' => '<div class="basic-yop-poll-container">
				    <div class="basic-canvas"></div>
				    <div class="basic-inner">
				        <div class="basic-message">
				            <p>
				            </p>
				        </div>
				        <form class="basic-form">
				            <div class="basic-questions">
				                <div class="basic-element basic-question">
				                    <div class="basic-question-title">
				                    </div>
									<div class="basic-answers">
										<div class="row">
										</div>
									</div>
								</div>
							</div>
							<div class="basic-element basic-vote-button">
				                <a href="#" class="button basic-vote">Vote</a>
				                <button class="basic-results">See Results</button>
				            </div>
				        </form>
				    </div>
				 </div>',
				 'html_columns' => '<div class="basic-yop-poll-container">
                    <div class="basic-canvas"></div>
                    <div class="basic-inner">
                        <div class="basic-message">
                            <p>
                            </p>
                        </div>
                        <form class="basic-form">
                            <div class="basic-questions">
                                <div class="basic-element question">
                                    <div class="basic-question-title">
                                    </div>
                                    <div class="basic-answers">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="basic-element basic-vote-button">
                                <a href="#" class="button basic-vote">Vote</a>
                                <button class="basic-results">See Results</button>
                            </div>
                        </form>
                    </div>
                 </div>',
				 'added_date' => current_time( 'mysql' )
			),
			1 => array(
				'name' => 'Basic Template With Pretty Controls ',
				'base' => 'basic-pretty',
				'description' => '',
				'image_preview' => 'basic-pretty.png',
				'html_preview' => '<div class="basic-preview-container">
									<div class="basic-preview-question">Question</div>
									<div class="basic-preview-answer">
										<div class="basic-preview-radio"></div>
										<div class="basic-preview-content">Answer 1</div>
									</div>
									<div class="basic-preview-answer">
										<div class="basic-preview-radio"></div>
										<div class="basic-preview-content">Answer 2</div>
									</div>
                                    <div class="basic-preview-captcha">captcha</div>
                                    <div class="basic-preview-vote">Vote</div>
								</div>',
				'html_vertical' => '<div class="basic-yop-poll-container">
				    <div class="basic-canvas"></div>
				    <div class="basic-inner">
				        <div class="basic-message">
				            <p>
				            </p>
				        </div>
				        <form class="basic-form">
				            <div class="basic-questions">
				                <div class="basic-element basic-question">
				                    <div class="basic-question-title">
									</div>
									<ul class="basic-answers">
									</ul>
								</div>
							</div>
							<div class="basic-element basic-vote-button">
				                <a href="#" class="button basic-vote">Vote</a>
				                <button class="basic-results">See Results</button>
				            </div>
						</form>
					</div>
				</div>
				',
				'html_horizontal' => '<div class="basic-yop-poll-container">
				    <div class="basic-canvas"></div>
				    <div class="basic-inner">
				        <div class="basic-message">
				            <p>
				            </p>
				        </div>
				        <form class="basic-form">
				            <div class="basic-questions">
				                <div class="basic-element basic-question">
				                    <div class="basic-question-title">
				                    </div>
									<div class="basic-answers">
										<div class="row">
										</div>
									</div>
								</div>
							</div>
							<div class="basic-element basic-vote-button">
				                <a href="#" class="button basic-vote">Vote</a>
				                <button class="basic-results">See Results</button>
				            </div>
				        </form>
				    </div>
				 </div>',
				'html_columns' => '<div class="basic-yop-poll-container">
                    <div class="basic-canvas"></div>
                    <div class="basic-inner">
                        <div class="basic-message">
                            <p>
                            </p>
                        </div>
                        <form class="basic-form">
                            <div class="basic-questions">
                                <div class="basic-element question">
                                    <div class="basic-question-title">
                                    </div>
                                    <div class="basic-answers">
                                        <div class="row">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="basic-element basic-vote-button">
                                <a href="#" class="button basic-vote">Vote</a>
                                <button class="basic-results">See Results</button>
                            </div>
                        </form>
                    </div>
                 </div>',
				'added_date' => current_time( 'mysql' )
			)
		);
		foreach ( $templates as $template ) {
			if ( false === YOP_Poll_Templates::template_already_exists( $template['base'], $available_templates ) ) {
				$GLOBALS['wpdb']->insert( $table, $template );
			}
		}
	}
	public function delete_tables() {
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_polls;
		$GLOBALS['wpdb']->query( $query );
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_elements;
		$GLOBALS['wpdb']->query( $query );
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_subelements;
		$GLOBALS['wpdb']->query( $query );
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_bans;
		$GLOBALS['wpdb']->query( $query );
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_votes;
		$GLOBALS['wpdb']->query( $query );
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_logs;
		$GLOBALS['wpdb']->query( $query );
		$query = 'DROP TABLE IF EXISTS ' . $GLOBALS['wpdb']->yop_poll_templates;
		$GLOBALS['wpdb']->query( $query );
	}
}
