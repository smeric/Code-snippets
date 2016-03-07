<?php
/**
 * Retrieve a remote file size
 */
if ( ! function_exists( 'get_remote_file_size' ) ) {
	function get_remote_file_size( $url, $unite = '' ) {
		//return 0;
		$http = ( parse_url( $url, PHP_URL_SCHEME ) == 'http' );
		if ( $http ) {
			$headers = @get_headers( $url, 1 );
			if ( isset( $headers ) && is_array( $headers ) && ! empty( $headers ) ) {
				if ( ( ! array_key_exists( 'Content-Length', $headers ) ) ) {
					return false;
				}
				else {
					$value = $headers['Content-Length'];
					switch ( $unite ) {
						case 'ko':
							return ceil( $value/1000 );
							break;
						case 'Ko':
							return ceil( $value/1024 );
							break;
						default :
							return $value;
							break;
					}
				}
			}
			else {
				$ch = @curl_init( $url );
				if ( $ch ) {
					curl_setopt( $ch, CURLOPT_NOBODY, true );
					curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
					curl_setopt( $ch, CURLOPT_HEADER, true );
					//curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true ); //not necessary unless the file redirects (like the PHP example we're using here)
					$data = curl_exec( $ch );
					curl_close( $ch );
					if ( $data === false ) {
						return false;
					}
					else {
						$contentLength = false;
						if ( preg_match( '/Content-Length: (\d+)/', $data, $matches ) ) {
						  $contentLength = ( int )$matches[1];
						}
						switch ( $unite ) {
							case 'ko':
								return ceil( $contentLength/1000 );
								break;
							case 'Ko':
								return ceil( $contentLength/1024 );
								break;
							default :
								return $contentLength;
								break;
						}
					}
				}
			}
		}
		else {
			return false;
		}
	}
}
