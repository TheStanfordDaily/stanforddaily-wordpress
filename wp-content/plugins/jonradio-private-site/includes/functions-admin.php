<?php

/**
 * Is the URL on the current WordPress web site?
 * 
 * Checks if URL begins with Site Home URL.
 * Strip http[s]://[www.] and leading and trailing blanks and convert to lower-case before comparing,
 * to allow http, etc. to be omitted on entry
 *
 * @param    string  $url		URL to be checked to be sure it is "on" the current WordPress web site
 * @return   bool				bool TRUE if URL is on current WordPress web site; FALSE otherwise
 */
function jr_ps_site_url( $url ) {
	$site_home = jr_ps_urlcompare_prep( get_home_url() );
	return ( substr( jr_ps_urlcompare_prep( $url ), 0, strlen( $site_home ) ) === $site_home );
}

/**
 * Prepare a URL for comparison with another URL
 * 
 * Strip [http[s]://][www.] and leading and trailing blanks, and convert to lower-case,
 * to:
 * (1) permit comparison of "synonym" URLs; and
 * (2) allow http to be omitted when inputting a URL
 *
 * @param    string	$url		URL to be prepped for comparison
 * @return   string	            URL prepped for comparison
 */
function jr_ps_urlcompare_prep( $url ) {
	$prep_url = strtolower( trim( $url ) );
	if ( 'http' === substr( $prep_url, 0, 4 ) ) {
		if ( 's' === substr( $prep_url, 4, 1 ) ) {
			$cursor = 5;	// Next character to look at in URL
		} else {
			$cursor = 4;
		}
		if ( '://' === substr( $prep_url, $cursor, 3 ) ) {
			$cursor = $cursor + 3;
		}
	} else {
		$cursor = 0;
	}
	if ( 'www.' === substr( $prep_url, $cursor, 4 ) ) {
		$cursor = $cursor + 4;
	}
	return substr( $prep_url, $cursor );
}

?>