<?php
namespace FileBird\Controller;

use FileBird\Model\Folder as FolderModel;

defined('ABSPATH') || exit;

class CompatibleWpml extends Controller {
  protected static $instance = null;

  protected $post_translations;
  private $sitepress;

  public function __construct() {
    global $sitepress;
    if ( $sitepress === null || get_class($sitepress) !== "SitePress" ) {
      return;
    }
    $this->sitepress = $sitepress;
    $this->post_translations = $sitepress->post_translations();

    add_action('fbv_after_set_folder', array($this, 'fbvAfterSetFolder'), 10, 2);
    add_filter('fbv_in_not_in', array($this, 'filterInNotIn'));
    add_filter('wpml_pre_parse_query', array($this, 'preParseQuery'));
    add_filter('wpml_post_parse_query', array($this, 'postParseQuery'));
  }

  public static function getInstance() {
    if (null == self::$instance) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  public function fbvAfterSetFolder($id, $folder) {
    global $wpdb;
    $cpt_sync_options = $this->sitepress->get_setting( 'custom_posts_sync_option', array() );
    if(isset($cpt_sync_options['attachment']) && $cpt_sync_options['attachment'] == '0') {
      return;
    }
    $post                     = get_post( $id );
		$post_type                = $post->post_type;
		$post_trid                = $this->sitepress->get_element_trid( $id, 'post_' . $post_type );
    $post_translations        = $this->sitepress->get_element_translations( $post_trid, 'post_' . $post_type );

    foreach ( $post_translations as $post_language => $translated_post ) {
      $translated_post_id         = $translated_post->element_id;
			if ( ! $translated_post_id ) {
				continue;
      }
      FolderModel::setFoldersForPosts($translated_post_id, (int)$folder, false);
    }
  }
  public function filterInNotIn($query) {
    $query = $this->adjust_q_var_pids($query, 'post__not_in');
    $query = $this->adjust_q_var_pids($query, 'post__in');
    return $query;
  }
  public function preParseQuery($q) {
    if ( ! empty( $q->query_vars['post_type'] ) && $q->query_vars['post_type'] == 'attachment' ) {
      $cpt_sync_options = $this->sitepress->get_setting( 'custom_posts_sync_option', array() );
      if(isset($cpt_sync_options['attachment']) && $cpt_sync_options['attachment'] == '0') {
        $q->query_vars['fbv_backup_post__in'] = $q->query_vars['post__in'];
        $q->query_vars['fbv_backup_post__not_in'] = $q->query_vars['post__not_in'];
        $q->query_vars['post__in'] = array();
        $q->query_vars['post__not_in'] = array();
      }
    }
    return $q;
  }
  public function postParseQuery($q) {
    if ( ! empty( $q->query_vars['post_type'] ) && $q->query_vars['post_type'] == 'attachment' ) {
      $cpt_sync_options = $this->sitepress->get_setting( 'custom_posts_sync_option', array() );
      if(isset($cpt_sync_options['attachment']) && $cpt_sync_options['attachment'] == '0') {
        $q->query_vars['post__in'] = $q->query_vars['fbv_backup_post__in'];
        $q->query_vars['post__not_in'] = $q->query_vars['fbv_backup_post__not_in'];
        unset($q->query_vars['fbv_backup_post__in']);
        unset($q->query_vars['fbv_backup_post__not_in']);
      }
		}
    return $q;
  }
  private function adjust_q_var_pids( $q, $index ) {
		if ( ! empty( $q[ $index ] ) ) {

			$untranslated = $q[ $index ];
			$this->post_translations->prefetch_ids( $untranslated );
			$current_lang = $this->sitepress->get_current_language();
			$pid          = array();
			foreach ( $q[ $index ] as $p ) {
				$pid[] = $this->post_translations->element_id_in( $p, $current_lang, true );
			}
			$q[ $index ] = $pid;
		}

		return $q;
	}
}