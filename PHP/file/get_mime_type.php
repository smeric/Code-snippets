<?php
/**
 * Get a file mime type
 */
if ( ! function_exists( 'get_mime_type' ) ) {
	function get_mime_type( $file_path = '' ) {
		if ( ! $file_path )
			return $mime_type;
		
		$mime_type = '';
		
		if ( function_exists( 'mime_content_type' ) ) {
			$mime_type = mime_content_type( $file_path );
		}
		elseif ( function_exists( 'finfo_file' ) ) {
			$finfo = finfo_open( FILEINFO_MIME );
			$mime_type = finfo_file( $finfo, $file_path );
			finfo_close( $finfo );  
		}
		
		if ( !$mime_type ) {
			$headers = array();
			$headers = @get_headers( $file_path, 1 );
			$mime_type = $headers['Content-Type'];
		}

		return $mime_type;
	}
}
