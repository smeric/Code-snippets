<?php
/**
 * Here is a function like strip_tags, only it removes only the tags (with attributes) specified
 * with support for stripping content inside those tags
 * Source: http://php.net/manual/fr/function.strip-tags.php
 */
if ( ! function_exists( 'strip_only' ) ) {
	function strip_only( $str, $tags, $stripContent = false ) {
		$content = '';
		if ( ! is_array( $tags ) ) {
			$tags = ( strpos( $str, '>' ) !== false ? explode( '>', str_replace( '<', '', $tags ) ) : array( $tags ) );
			if ( end( $tags ) == '' ) array_pop( $tags );
		}
		foreach ( $tags as $tag ) {
			if ( $stripContent )
				 $content = '(.+</' . $tag . '[^>]*>|)';
			 $str = preg_replace( '#</?' . $tag . '[^>]*>' . $content . '#is', '', $str );
		}
		return $str;
	} 
} 
