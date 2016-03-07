<?php
/**
 * Gheck if a file is an image
 *
 * @reference http://www.binarytides.com/php-check-if-file-is-an-image/
 *
 * @param   string    $url  file url
 * @return  boolean
 */
if ( ! function_exists( 'is_image' ) ) {
	function is_image( $url ) {

		$a = @getimagesize( $url );

		if ( !isset( $a ) || !is_array( $a ) || empty( $a ) ) {
			return false;
		}

		$image_type = $a[2];

		if ( in_array( $image_type , array( IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG ) ) ) {
			return true;
		}

		return false;
	}
}
