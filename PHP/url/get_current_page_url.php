<?php
/**
 * Get the current page URL
 * from : http://www.webcheatsheet.com/PHP/get_current_page_url.php
 */
if ( ! function_exists( 'get_current_page_url' ) ) {
	function get_current_page_url() {
		$pageURL = 'http';
		if ( $_SERVER['HTTPS'] == 'on' )
			$pageURL .= 's';
		$pageURL .= '://';
		if ( $_SERVER['SERVER_PORT'] != '80' )
			$pageURL .= $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . $_SERVER['REQUEST_URI'];
		else
			$pageURL .= $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
		return $pageURL;
	}
}
