<?php
/**
 * @package     WordPress
 * @link        https://github.com/Code-snippets/
 * @copyright   Copyright (c) 2016, Sébastien Méric
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @author      Sébastien Méric <sebastien.meric@gmail.com>
 *
 * @usage       Put this file inside child theme folder and not inside a page-templates subfolder
 *              if you want to use it with maintenance mode plugins and still get the oportunity
 *              to use it as a page template.
 *
 * @wordpress
 * Template Name: Maintenance mode...
 */
header( 'header-type: text/html; charset=UTF-8' );

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

// if the "maintenance mode" plugin is active
if ( is_plugin_active( 'maintenance-mode/maintenance-mode.php' ) && $options = get_option( 'plugin_maintenance-mode' ) ) {
	global $myMaMo;
	if ( isset( $options['mamo_pagetitle'] ) ) {
		//$title = $options['mamo_pagetitle'];
		$title = $myMaMo->g_opt['mamo_pagetitle'];
	}
	if ( isset( $options['mamo_pagemsg'] ) ) {
		//$content = do_shortcode( $options['mamo_pagemsg'] );
		$content = $myMaMo->mamo_template_tag_message();
	}
	if ( isset( $options['mamo_backtime'] ) ) {
		// the "maintenance mode" plugin backtime value is in minutes
		$backtime_secs  = intval( $options['mamo_backtime'] ) * 60;
		$backtime_hours = intval( $backtime_secs / 3600 );
	}
	elseif ( isset( $options['mamo_backtime_days'] ) && isset( $options['mamo_backtime_hours'] ) && isset( $options['mamo_backtime_mins'] ) ) {
		// the "maintenance mode" plugin backtime value has been cuted in 3 values !
		$backtime_secs = ( intval( $options['mamo_backtime_days'] ) * 24 * 60 * 60 ) + ( intval( $options['mamo_backtime_hours'] ) * 60 * 60 ) + ( intval( $options['mamo_backtime_mins'] ) * 60 );
		$backtime_hours = ( intval( $options['mamo_backtime_days'] ) * 24 ) + intval( $options['mamo_backtime_hours'] );
	}
}
elseif ( is_plugin_active( 'woodojo/woodojo.php' ) && $options = get_option( 'woodojo-maintenance-mode' ) ) {
	if ( isset( $options['title'] ) ) {
		$title = $options['title'];
	}
	if ( isset( $options['note'] ) ) {
		$content = html_entity_decode( $options['note'] );
	}
	$backtime_secs  = 0;
	$backtime_hours = 0;
}
else {
	// Add WordPress fonctions
	require( $_SERVER['DOCUMENT_ROOT'] . $_SERVER['REQUEST_URI'] . 'wp-load.php' );

	global $post;
	if ( isset( $post) ) {
		$title = get_the_title( $post->ID );
		if ( $post->post_content ) {
			$content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $post->post_content ) );
		}
		else {
			$content = __( '<p>Site en cours de construction...</p>', 'sitename' );
		}
	}
	else {
		$title   = __( 'Maintenance Mode', 'sitename' );
		$content = __( '<p>Maintenance mode...</p>', 'sitename' );
	}
	$backtime_secs  = 0;
	$backtime_hours = 0;
}

if ( !$backtime_hours && !$backtime_secs ) {
	$backtime_hours = 72; // 1 hour = 3600 seconds
	$backtime_secs  = 259200;
}
elseif ( !$backtime_hours ) 
	$backtime_hours = 1;
elseif ( !$backtime_secs ) 
	$backtime_secs = 3600; // 1 hour = 3600 seconds

header( 'HTTP/1.1 503 Service Temporarily Unavailable' );
header( 'Status: 503 Service Temporarily Unavailable' );
header( 'Retry-After: ' . $backtime_secs );

?><!DOCTYPE html> 
<html <?php language_attributes() ?>>
	<head>
		<title><?php bloginfo('name'); ?> &raquo; <?php echo $title ?></title>
		<meta charset="<?php bloginfo('charset') ?>" />
		<meta name="robots" content="noindex,nofollow" />
		<meta name="revisit-after" content="<?php echo $backtime_hours ?> hours" />
	</head>
	<body id="maintenance-mode">
		<div id="wrapper">
			<div id="content">
				<?php echo $content ?>
			</div>
		</div>
	</body>
</html>

