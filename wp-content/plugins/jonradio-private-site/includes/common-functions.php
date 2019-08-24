<?php
/*	jonradio Common Functions,
	intended for use in more than one jonradio plugin,
	and others are encouraged to use for their own purposes.
	See details below license.
*/

/*  Copyright 2014  jonradio  (email : info@zatz.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/*	Concept and Usage
	Each function name is prefixed with jr_v followed by a Version Number (integer) then another underscore
	then the function name.
	Each function is preceded by a check for previous existence,
	so that multiple plugins can use the same function without generating duplicate function definition errors.
	By incorporating the Version Number into the function name, there is no danger of a plugin using the wrong version.
	Standard usage is to have all these functions stored in each plugin's folder as /includes/common-functions.php
	Each function has its own Version Number, which only increases when the function actually changes;
	which means that common-functions.php will normally include many different version numbers in its functions;
	i.e. - the version number applies independently to each function, not to the common-functions.php file as a whole.
*/

//	Exit if .php file accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/*	As well as dealing with the low probability that a single mb_ function has been disabled in a php.ini,
	this also supports older versions of PHP as mb_ functions were introduced one by one over a number of php versions.
*/
if ( function_exists( 'mb_substr' ) ) {
	function jr_v1_substr() {
		$args = func_get_args();
		if ( isset( $args[2] ) ) {
			return mb_substr( $args[0], $args[1], $args[2] );
		} else {
			return mb_substr( $args[0], $args[1] );
		}
	}
} else {
	function jr_v1_substr() {
		$args = func_get_args();
		if ( isset( $args[2] ) ) {
			return substr( $args[0], $args[1], $args[2] );
		} else {
			return substr( $args[0], $args[1] );
		}
	}
}
if ( function_exists( 'mb_strlen' ) ) {
	function jr_v1_strlen( $string ) {
		return mb_strlen( $string );
	}
} else {
	function jr_v1_strlen( $string ) {
		return strlen( $string );
	}
}
if ( function_exists( 'mb_strtolower' ) ) {
	function jr_v1_strtolower( $string ) {
		return mb_strtolower( $string );
	}
} else {
	function jr_v1_strtolower( $string ) {
		return strtolower( $string );
	}
}
if ( function_exists( 'mb_stripos' ) ) {
	function jr_v1_stripos( $string, $find, $offset = 0 ) {
		return mb_stripos( $string, $find, $offset );
	}
} else {
	function jr_v1_stripos( $string, $find, $offset = 0 ) {
		return stripos( $string, $find, $offset );
	}
}
if ( function_exists( 'mb_strpos' ) ) {
	function jr_v1_strpos( $string, $find, $offset = 0 ) {
		return mb_strpos( $string, $find, $offset );
	}
} else {
	function jr_v1_strpos( $string, $find, $offset = 0 ) {
		return strpos( $string, $find, $offset );
	}
}

/**
 * Do two URLs point at the same location on a web site?
 * 
 * Preps URL, if string
 *
 * @param    string/array  $url1	URL to compare, a string, or an array in special format created by companion function
 * @param    string/array  $url2	URL to compare, a string, or an array in special format created by companion function
 * @return   bool					bool TRUE if URL matches prefix; FALSE otherwise
 */
if ( !function_exists( 'jr_v1_same_url' ) ) {
	function jr_v1_same_url( $url1, $url2 ) {
		if ( is_string( $url1 ) ) {
			$url1 = jr_v1_prep_url( $url1 );
		}
		if ( is_string( $url2 ) ) {
			$url2 = jr_v1_prep_url( $url2 );
		}
		return ( $url1 == $url2 );
	}
}

/**
 * Does a specified Prefix URL match the given URL?
 * 
 * Preps URL, if string
 *
 * @param    string/array  $prefix	front part of a URL to compare, a string, or an array in special format created by companion function
 * @param    string/array  $url		full URL to compare, a string, or an array in special format created by companion function
 * @return   bool					bool TRUE if Prefix matches first part of URL; FALSE otherwise
 */
if ( !function_exists( 'jr_v1_same_prefix_url' ) ) {
	function jr_v1_same_prefix_url( $prefix, $url ) {
		if ( is_string( $prefix ) ) {
			$prefix = jr_v1_prep_url( $prefix );
		}
		if ( is_string( $url ) ) {
			$url = jr_v1_prep_url( $url );
		}
		if ( $url['host'] === $prefix['host'] ) {
			if ( $url['path'] === $prefix['path'] ) {
				/*	Host and Path both exactly match for URL and Prefix specified.
				*/
				if ( array() === $prefix['query'] ) {
					$match = TRUE;
				} else {
					/*	Now the hard part:  determining a legitimate prefix match for Query
					*/
					foreach ( $prefix['query'] as $prefix_keyword => $prefix_value ) {
						$one_match = FALSE;
						foreach ( $url['query'] as $url_keyword => $url_value ) {
							if ( $prefix_keyword === jr_v1_substr( $url_keyword, 0, jr_v1_strlen( $prefix_keyword ) ) ) {
								if ( $prefix_value === jr_v1_substr( $url_value, 0, jr_v1_strlen( $prefix_value ) ) ) {
									$one_match = TRUE;
								}
							}
						}
						/*	All Prefix Queries must match.
						*/
						if ( FALSE === $one_match ) {
							return FALSE;
						}
					}
					$match = TRUE;
				}
			} else {
				/*	Paths must exactly match if Prefix specifies Query
				*/
				if ( array() === $prefix['query'] ) {
					/*	No Query in Prefix, so check Path for Prefix match
					*/
					$match = ( $prefix['path'] === jr_v1_substr( $url['path'], 0, jr_v1_strlen( $prefix['path'] ) ) );				
				} else {
					$match = FALSE;
				}
			}
		} else {
			if ( ( '' === $prefix['path'] ) && ( array() === $prefix['query'] ) ) {
				/*	No Path or Query in Prefix, so check Host for Prefix match
				*/
				$match = ( $prefix['host'] === jr_v1_substr( $url['host'], 0, jr_v1_strlen( $prefix['host'] ) ) );
			} else {
				/*	Hosts must exactly match if Prefix specifies Path or Query
				*/
				$match = FALSE;
			}
		}
		return $match;
	}
}

/**
 * Standardize a URL into an array of values that can be accurately compared with another
 * 
 * Preps URL, by removing any UTF Left-to-right Mark (LRM), usually found as a suffix, 
 * translating the URL to lower-case, removing prefix http[s]//:[www.], 
 * any embedded index.php and any trailing slash or #bookmark,
 * and breaks up ?keyword=value queries into array elements.
 *
 * Structure/Elements of Array returned:
 *	[host] - domain.com - www. is removed, but all other subdomains are included
 *	[path] - /dir/file.ext
 *	[query] - any Queries (e.g. - "?kw=val&kw2=val2") broken up as follows:
 *		[$keyword] => $value with preceding equals sign, only if equals sign was present
 * To simplify processing of this Array, zero length strings and empty arrays are used,
 * rather than NULL entries or missing array elements.
 *
 * @param    string  $url	URL to create an array from, in special format for accurate comparison
 * @return   array			array of standardized attributes of the URL (see structure above)
 */
if ( !function_exists( 'jr_v1_prep_url' ) ) {
	function jr_v1_prep_url( $url ) {
		/*	Handle troublesome %E2%80%8E UTF Left-to-right Mark (LRM) suffix first.
		*/
		if ( FALSE === jr_v1_stripos( $url, '%E2%80%8E' ) ) {
			if ( FALSE === jr_v1_stripos( rawurlencode( $url ), '%E2%80%8E' ) ) {
				$url_clean = $url;
			} else {
				$url_clean = rawurldecode( str_ireplace( '%E2%80%8E', '', rawurlencode( $url ) ) );
				/*	mb_str_ireplace() does not exist because str_ireplace() is binary-safe.
				*/
			}
		} else {
			$url_clean = str_ireplace( '%E2%80%8E', '', $url );
		}
		$url_clean = trim( $url_clean );
		
		/*	parse_url(), especially before php Version 5.4.7,
			has a history of problems when Scheme is not present,
			especially for LocalHost as a Host,
			so add a prefix of http:// if :// is not found
		*/
		if ( FALSE === jr_v1_strpos( $url_clean, '://' ) ) {
			$url_clean = "http://$url_clean";
		}
		
		$parse_array = parse_url( jr_v1_strtolower( $url_clean ) );
		/*	Get rid of URL components that do not matter to us in our comparison of URLs
		*/
		foreach ( array( 'scheme', 'port', 'user', 'pass', 'fragment' ) as $component ) {
			unset ( $parse_array[$component] );
		}
		/*	Remove www. from host
		*/
		if ( 'www.' === jr_v1_substr( $parse_array['host'], 0, 4 ) ) {
			$parse_array['host'] = jr_v1_substr( $parse_array['host'], 4 );
		}
		if ( isset( $parse_array['path'] ) ) {
			/*	Remove any index.php occurences in path, since these can be spurious in IIS
				and perhaps other environments.
			*/
			$parse_array['path'] = str_replace( 'index.php', '', $parse_array['path'] );
			/*	Remove leading and trailing slashes from path
			*/
			$parse_array['path'] = trim( $parse_array['path'], "/\\" );
		} else {
			$parse_array['path'] = '';
		}
		/*	Take /?keyword=value&keyword=value URL query parameters
			and break them up into array( keyword => value, keyword => value )
		*/
		if ( isset( $parse_array['query'] ) ) {
			$parms = explode( '&', $parse_array['query'] );
			$parse_array['query'] = array();
			foreach( $parms as $parm ) {
				if ( FALSE === ( $cursor = jr_v1_strpos( $parm, '=' ) ) ) {
					$parse_array['query'][$parm] = '';
				} else {
					/*	Include the Equals Sign ("=") as the first character of the Query Value
						to differentiate between a URL Prefix with a Query Keyword followed by 
						an Equals Sign, and one without.  For example, "address" would match
						address2=abc, while "address=" would not.
					*/
					$parse_array['query'][jr_v1_substr( $parm, 0, $cursor + 1 )] = jr_v1_substr( $parm, $cursor + 1 );
				}
			}
		} else {
			$parse_array['query'] = array();
		}
		return $parse_array;
	}
}

/**
 * Sanitize a URL
 * 
 * Preps URL, by removing any UTF Left-to-right Mark (LRM), usually found as a suffix, 
 * and then checks if URL is blank.
 *
 * @param    string  $url	URL
 * @return   string/bool	Sanitized URL; bool FALSE if invalid URL;
 *							zero length string if URL not specified
 */
if ( !function_exists( 'jr_v1_sanitize_url' ) ) {
	function jr_v1_sanitize_url( $url ) {
		/*	Handle troublesome %E2%80%8E UTF Left-to-right Mark (LRM) suffix first.
		*/
		if ( FALSE === stripos( $url, '%E2%80%8E' ) ) {
			if ( FALSE === stripos( rawurlencode( $url ), '%E2%80%8E' ) ) {
				$url_clean = $url;
			} else {
				$url_clean = rawurldecode( str_ireplace( '%E2%80%8E', '', rawurlencode( $url ) ) );
			}
		} else {
			$url_clean = str_ireplace( '%E2%80%8E', '', $url );
		}
		$url_clean = trim( $url_clean );
		if ( empty( $url_clean ) ) {
			return '';
		}
		/*	Add a prefix of http:// if :// is not found
			and be sure scheme is http: or https:
		*/
		if ( FALSE === strpos( $url_clean, '://' ) ) {
			if ( is_ssl()
				|| ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) 
					&& $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' ) ) {
				$s = 's';
			} else {
				$s = '';
			}
			$url_clean = "http$s://$url_clean";
		} else {
			if ( !in_array( strtolower( parse_url( $url_clean, PHP_URL_SCHEME ) ), array( 'http', 'https' ) ) ) {
				return FALSE;
			}
		}
		return $url_clean;
	}
}

?>