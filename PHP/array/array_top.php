<?php
/**
 * Return an array with a choosen element in first position
 */
if ( ! function_exists( 'array_top' ) ) {
	function array_top( $array, $index ) {
		$value = $array[$index];
		unset( $array[$index] );
		$array = array_merge( array( $index => $value ), $array ); // you can also simply add the arrays here instead; array($i => $val) + $array
		return $array;
	}
}
