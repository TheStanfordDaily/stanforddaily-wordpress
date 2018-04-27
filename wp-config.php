<?php
# Database Configuration
define( 'DB_NAME', 'wp_stanforddaily2' );
define( 'DB_USER', 'stanforddaily2' );
define( 'DB_PASSWORD', 'Sot7SyGm5YaDoWsu7aNI' );
define( 'DB_HOST', '127.0.0.1' );
define( 'DB_HOST_SLAVE', '127.0.0.1' );
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', 'utf8_unicode_ci');
$table_prefix = 'wp_';

# Security Salts, Keys, Etc
define('AUTH_KEY',         'Qv]uBlKt(Bw$-#?Bj4+EFI Gw<Sx`KqUPp?hT@5Seh0|u!|x^`30^!s5K]r+@rsV');
define('SECURE_AUTH_KEY',  'lZ9fc [et{JL.g{y0.+#8;_=kv4L7a6N~_-oy 6NG$m~pWn/k/z+O>:t6L1p]@@g');
define('LOGGED_IN_KEY',    'aDyTK4F4.`>hJb3[Vp@IK2$,)snRi=.wAyzzets.O2p}^n*GO=DV/gd;VJUW48Q|');
define('NONCE_KEY',        '||aiw-+4/+75(8R =9(0izj &N$F[+q)Us2{N<h9Ic#L4!V-D5S2?_<z<W6<bB&~');
define('AUTH_SALT',        'lrSB?GQnxMOhYj<Sh14!t%XWVwmu|/`Z%DQl8kp~ky?jZtd=uT{PD4*5&+7zkw:)');
define('SECURE_AUTH_SALT', '8OaR3!@^^{9)jFEX?LdSy{HfLrZL^?(DR`^#{/JTA-w>*zT0=1*vYZh6)J`$LZVQ');
define('LOGGED_IN_SALT',   '~nT>g};(A(5YTt8!w5c#/L,-qt.nf*G(D-DgP!1I*jo9hXEHy)9_{RC~sdG sh4o');
define('NONCE_SALT',       '}Z^!q}=3VnBjQyLa(/wLM*86$;hiwQiFYW79H}.9>o<8@OT+T 3=O3==eOHN1I<E');


# Localized Language Stuff

define( 'WP_CACHE', TRUE );

define( 'WP_AUTO_UPDATE_CORE', false );

define( 'PWP_NAME', 'stanforddaily2' );

define( 'FS_METHOD', 'direct' );

define( 'FS_CHMOD_DIR', 0775 );

define( 'FS_CHMOD_FILE', 0664 );

define( 'PWP_ROOT_DIR', '/nas/wp' );

define( 'WPE_APIKEY', '5b60e28e2a3c4a8403e1ea2d92731958771f7991' );

define( 'WPE_CLUSTER_ID', '120233' );

define( 'WPE_CLUSTER_TYPE', 'pod' );

define( 'WPE_ISP', true );

define( 'WPE_BPOD', false );

define( 'WPE_RO_FILESYSTEM', false );

define( 'WPE_LARGEFS_BUCKET', 'largefs.wpengine' );

define( 'WPE_SFTP_PORT', 2222 );

define( 'WPE_LBMASTER_IP', '' );

define( 'WPE_CDN_DISABLE_ALLOWED', true );

define( 'DISALLOW_FILE_MODS', FALSE );

define( 'DISALLOW_FILE_EDIT', FALSE );

define( 'DISABLE_WP_CRON', false );

define( 'WPE_FORCE_SSL_LOGIN', false );

define( 'FORCE_SSL_LOGIN', false );

/*SSLSTART*/ if ( isset($_SERVER['HTTP_X_WPE_SSL']) && $_SERVER['HTTP_X_WPE_SSL'] ) $_SERVER['HTTPS'] = 'on'; /*SSLEND*/

define( 'WPE_EXTERNAL_URL', false );

define( 'WP_POST_REVISIONS', FALSE );

define( 'WPE_WHITELABEL', 'wpengine' );

define( 'WP_TURN_OFF_ADMIN_BAR', false );

define( 'WPE_BETA_TESTER', false );

umask(0002);

$wpe_cdn_uris=array ( );

$wpe_no_cdn_uris=array ( );

$wpe_content_regexs=array ( );

$wpe_all_domains=array ( 0 => 'stanforddaily2.wpengine.com', );

$wpe_varnish_servers=array ( 0 => 'pod-120233', );

$wpe_special_ips=array ( 0 => '35.197.103.138', );

$wpe_ec_servers=array ( );

$wpe_netdna_domains=array ( );

$wpe_netdna_domains_secure=array ( );

$wpe_netdna_push_domains=array ( );

$wpe_domain_mappings=array ( );

$memcached_servers=array ( );
define('WPLANG','');

# WP Engine ID


# WP Engine Settings






# That's It. Pencils down
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
require_once(ABSPATH . 'wp-settings.php');

$_wpe_preamble_path = null; if(false){}
