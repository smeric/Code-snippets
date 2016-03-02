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
 * Template Name: Redirect To First Child
 */

if ( have_posts() ) : while ( have_posts() ) : the_post();
	$page_kids = get_pages( 'child_of=' . $post->ID . '&sort_column=menu_order' );
	if ( isset( $page_kids ) && is_array( $page_kids ) && ! empty( $page_kids ) ) :
		// Redirect to the first child page if the current page have children pages
		$first_child = $page_kids[0];
		wp_redirect( get_permalink( $first_child->ID ), 301 );
		exit;
	else :
		die( __( 'The "Redirect To First Child" page template must be associated with the parent page of a pages hierarchical tree.', 'sitename' ) );
	endif;
endwhile; endif;
?>
