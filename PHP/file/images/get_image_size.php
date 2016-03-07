<?php
/**
 * Get image size
 * Retrieve only the first few bytes of the file since the size of the image is located there.
 */
if ( ! function_exists( 'get_image_size' ) ) {
	function get_image_size( $image_url ) {
		$handle = fopen( $image_url, 'rb' );
		$contents = '';
		$count = 0;
		if ( $handle ) {
			do {
				$count += 1;
				$data = fread( $handle, 8192 );
				if ( strlen( $data ) == 0 ) {
					break;
				}   
				$contents .= $data;
			} while( true );
		}
		else {
			return false;
		}
		fclose ( $handle );

		$im = ImageCreateFromString( $contents );
		if ( ! $im ) {
			return false;
		}
		$gis[0] = ImageSX( $im );
		$gis[1] = ImageSY( $im );
		// array member 3 is used below to keep with current getimagesize standards
		$gis[3] = "width=\"{$gis[0]}\" height=\"{$gis[1]}\"";
		ImageDestroy( $im );
		return $gis;
	}
}
