<?php
/**
 * Function to turn a mysql datetime (YYYY-MM-DD HH:MM:SS) into a unix timestamp
 * @param str
 *     The string to be formatted
 */
if ( ! function_exists( 'mysql_datetime_to_timestamp' ) ) {
	function mysql_datetime_to_timestamp( $str ) {
		list( $date, $time ) = explode( ' ', $str );
		list( $year, $month, $day ) = explode( '-', $date );
		list( $hour, $minute, $second ) = explode( ':', $time );

		$timestamp = mktime( $hour, $minute, $second, $month, $day, $year );

		return $timestamp;
	}
}
