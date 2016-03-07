<?php
/**
 * Check if a string is a valid email address
 */
if ( ! function_exists( 'is_email' ) ) {
    function is_email( $str ) {
        $str = trim( $str );
        return strlen($str) < 5
            ? false
            : ( preg_match( '/^(\w|-|_|\.)+@((\w|-)+\.)+[a-z]{2,6}$/i', $str ) === 1
                ? true
                : false );
    }
}
