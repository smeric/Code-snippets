<?php
/**
 * Validate a url
 * Source: http://w4dev.com/wp/validate-url/
 */
if ( ! function_exists( 'is_url' ) ) {
	function is_url( $url ) {
		// First make sure the url is cleaned and checked
		$url = esc_url( $url );
		$url = @parse_url( $url );
		if ( ! $url ) {
			return false;
		}
		$url = array_map( 'trim', $url );
		$url['port'] = ( !isset( $url['port'] ) ) ? 80 : ( int ) $url['port'];
		$path = ( isset( $url['path'] ) ) ? $url['path'] : '';
		if ( $path == '' ) {
			$path = '/';
		}
		$path .= ( isset( $url['query'] ) ) ? "?$url[query]" : '';
		if ( isset( $url['host'] ) AND $url['host'] != gethostbyname( $url['host'] ) ){
			if ( PHP_VERSION >= 5 ) {
				$headers = get_headers( "$url[scheme]://$url[host]:$url[port]$path" );
			}
			else {
				$fp = fsockopen( $url['host'], $url['port'], $errno, $errstr, 30 );
				if ( !$fp ) {
					return false;
				}
				fputs( $fp, "HEAD $path HTTP/1.1\r\nHost: $url[host]\r\n\r\n" );
				$headers = fread( $fp, 4096 );
				fclose( $fp );
			}
			$headers = ( is_array( $headers ) ) ? implode( "\r\n", $headers ) : $headers;
			return ( bool ) preg_match( '#^HTTP/.*\s+[(200|301|302)]+\s#i', $headers );
		}
		return false;
	}
}
