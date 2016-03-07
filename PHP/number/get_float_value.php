<?php
/**
 * Remplace coma by dot in floats
 */
if ( ! function_exists( 'get_float_value' ) ) {
	function get_float_value( $strValue ) {
		// ereg_replace is deprecated
		/* $floatValue = ereg_replace( '(^[0-9]*)(\\.|,)([0-9]*)(.*)', '\\1.\\3', $strValue );
		if ( ! is_numeric( $floatValue ) ) $floatValue = ereg_replace( '(^[0-9]*)(.*)', '\\1', $strValue ); */
		$floatValue = preg_replace( '/(^[0-9]*)(\\.|,)([0-9]*)(.*)/', '\\1.\\3', $strValue );
		if ( ! is_numeric( $floatValue ) )
			$floatValue = preg_replace( '/(^[0-9]*)(.*)/', '\\1', $strValue );
		if ( ! is_numeric( $floatValue ) )
			$floatValue = 0;
		return $floatValue;
	}
}
