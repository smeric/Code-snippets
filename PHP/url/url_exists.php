<?php
/**
 * Test to see if there is something responding :)
 * dan at sudonames dot com : http://php.net/manual/fr/function.file-exists.php#84918
 */
if ( ! function_exists( 'url_exists' ) ) {
	function url_exists( $url ) {
		$hdrs = @get_headers( $url );
		return is_array( $hdrs ) ? preg_match( '/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/', $hdrs[0] ) : false;
	} 
} 
