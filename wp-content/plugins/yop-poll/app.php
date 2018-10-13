<?php
include( 'public/inc/Captcha.php' );
include( 'public/inc/Session.php' );
// Initialize Session
session_cache_limiter( false );
if ( '' === session_id() ) {
    session_start();
}
header( 'Access-Control-Allow-Origin', '*' );
if ( isset( $_GET['namespace'] ) && ( '' !== $_GET['namespace'] ) ) {
    $session = new \visualCaptcha\Session('visualcaptcha_' . $_GET['namespace'] );
} else {
    $session = new \visualCaptcha\Session();
}
if ( false === isset( $_GET['_a'] ) ) {
	$_GET['_a'] = '';
}
switch( $_GET['_a'] ) {
	case 'start': {
		$captcha = new \visualCaptcha\Captcha( $session, __DIR__ . '/public/assets/captcha' );
		$captcha->generate( $_GET['_img'] );
		header( 'Content-Type: application/json' );
		echo json_encode( $captcha->getFrontEndData() );
		break;
	}
	case 'image': {
		$captcha = new \visualCaptcha\Captcha( $session, __DIR__ . '/public/assets/captcha' );
		if(!$captcha->streamImage(
	            getallheaders(),
	            $_GET['_id'],
	            0
	    )) {
			if ( 0 !== ob_get_level() ) {
	            ob_clean();
	        }
		}
        break;
	}
    case 'audio': {
		$captcha = new \visualCaptcha\Captcha( $session, __DIR__ . '/public/assets/captcha' );
		if(!$captcha->streamAudio( getallheaders(), 'mp3' )) {
			if ( 0 !== ob_get_level() ) {
	            ob_clean();
	        }
		}
        break;
	}
    default: {
        print( 'default' );
    }
}
