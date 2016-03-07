<?php
/**
 * This simple little function comes in quite handy when you need to change the format of a date.
 * Simply enter nearly any date format and this function can convert it to your new format.
 *
 * string reformat_date(string date, string format)
 *
 * Function written by Marcus L. Griswold (vujsa)
 * Do not remove this header!
 * Source: http://www.handyphp.com/index.php/PHP-Resources/Handy-PHP-Functions/reformat_date.html
 */
if ( ! function_exists( 'reformat_date' ) ) {
	function reformat_date( $format, $date ){
		return date( $format, strtotime( $date ) );
	}
}
