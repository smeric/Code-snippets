<?php
/**
 * Return domain hostname
 *
 * Source: http://corpocrat.com/2009/02/28/php-how-to-get-domain-hostname-from-url/
 */
if ( ! function_exists( 'get_domain_name' ) ) {
	function get_domain_name() {
		$sitename = strtolower( $_SERVER['SERVER_NAME'] );
		if ( substr( $sitename, 0, 4 ) == 'www.' ) {
			$sitename = substr( $sitename, 4 );
		}
		return $sitename;
	}
}
