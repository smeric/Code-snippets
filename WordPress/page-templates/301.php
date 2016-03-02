<?php
/**
 * @package     WordPress
 * @link        https://github.com/Code-snippets/
 * @copyright   Copyright (c) 2016, Sébastien Méric
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @author      Sébastien Méric <sebastien.meric@gmail.com>
 *
 * @wordpress
 * Template Name: 301 redirect to url
 */

global $post;

if ( $post && $post->post_content ) {
	wp_redirect( esc_url_raw( $post->post_content ), 301 );
	exit;
}
?>