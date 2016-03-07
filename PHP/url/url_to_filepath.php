<?php
/**
 * Convert a URL to the local file path
 */
if ( ! function_exists( 'url_to_filepath' ) ) {
	function url_to_filepath( $url ) {
		$durl = urldecode( $url );
		$url_infos = parse_url( $url );
		return $_SERVER['DOCUMENT_ROOT'] . $url_infos['path'];
	}
}
