<?php
/**
 * Try to convert a string to UTF-8.
 *
 * @author Thomas Scholz <http://toscho.de>
 * @param string $str String to encode
 * @param string $inputEnc Maybe the source encoding. 
 *               Set to NULL if you are not sure. iconv() will fail then.
 * @return string
 */
if ( ! function_exists( 'force_utf8' ) ) {
	function force_utf8( $str, $inputEnc = 'WINDOWS-1252', $triggerError = false ) {
		if ( is_utf8( $str ) ) // Nothing to do.
			return $str;

		if ( strtoupper( $inputEnc ) === 'ISO-8859-1' )
			return utf8_encode( $str );

		if ( function_exists( 'mb_convert_encoding' ) )
			return mb_convert_encoding( $str, 'UTF-8', $inputEnc );

		if ( function_exists( 'iconv' ) )
			return iconv( $inputEnc, 'UTF-8', $str );

		// You could also just return the original string.
		if ( $triggerError ) {
			trigger_error(
				'Cannot convert string to UTF-8 in file ' . __FILE__ . ', line ' . __LINE__ . '!', 
				E_USER_ERROR 
			);
		}
		else {
			return $str;
		}
	}
}
