<?php
/**
 * @package     WordPress
 * @link        https://github.com/Code-snippets/
 * @copyright   Copyright (c) 2016, Sébastien Méric
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       1.0
 * @author      Sébastien Méric <sebastien.meric@gmail.com>
 *
 * @see         http://yoast.com/custom-rss-feeds-wordpress/
 * @see         http://digwp.com/2011/08/custom-feeds/
 *
 * @wordpress
 * Template Name: Custom Feed
 */

if ( have_posts() ) : while( have_posts() ) : the_post();
	// Use page custom fields for posts per page and displayed categories
	$posts_per_page = get_post_meta( $post->ID, 'rss_posts_per_feed', true )
		? get_post_meta( $post->ID, 'rss_posts_per_feed', true )
		: get_option( 'posts_per_rss' )
			? get_option( 'posts_per_rss' )
			: 10;
	$cat = get_post_meta( $post->ID, 'rss_rubriques_list', true )
		? get_post_meta( $post->ID, 'rss_rubriques_list', true )
		: 1;
endwhile; endif;

query_posts( 'posts_per_page=' . $posts_per_page . '&cat=' . $cat );

header( 'Content-Type: ' . feed_content_type( 'rss-http' ) . '; charset=' . get_option( 'blog_charset' ), true );
echo '<?xml version="1.0" encoding="' . get_option( 'blog_charset' ) . '"?' . '>' . PHP_EOL;
?>
<rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
<?php do_action( 'rss2_ns' ) ?>
>
	<channel>
		<title><?php bloginfo_rss( 'name' ); wp_title_rss() ?> - Article Feed</title>
		<atom:link href="<?php self_link() ?>" rel="self" type="application/rss+xml" />
		<link><?php bloginfo_rss( 'url' ) ?></link>
		<description><?php bloginfo_rss( 'description' ) ?></description>
		<pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ) ?></pubDate>
		<lastBuildDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_lastpostmodified( 'GMT' ), false ) ?></lastBuildDate>
		<?php the_generator( 'rss2' ) ?>
		<language><?php echo ( get_option( 'rss_language' ) ? get_option( 'rss_language' ) : WPLANG ) ?></language>
		<sy:updatePeriod><?php echo apply_filters( 'rss_update_period', 'hourly' ) ?></sy:updatePeriod>
		<sy:updateFrequency><?php echo apply_filters( 'rss_update_frequency', '1' ) ?></sy:updateFrequency>
		<managingEditor><?php bloginfo( 'admin_email' ) ?></managingEditor>
		<?php do_action( 'rss2_head' ) ?>
<?php if(have_posts()) : while(have_posts()) : the_post() ?>

		<item>
			<title><?php the_title_rss() ?></title>
			<link><?php the_permalink_rss() ?></link>
			<dc:creator><?php the_author() ?></dc:creator>
			<pubDate><?php echo mysql2date( 'D, d M Y H:i:s +0000', get_post_time( 'Y-m-d H:i:s', true ), false ) ?></pubDate>
			<guid isPermaLink="false"><?php the_guid() ?></guid>
			<description><![CDATA[<?php the_excerpt_rss() ?>]]></description>
<?php	if ( !get_option( 'rss_use_excerpt' ) ) : ?>
			<content:encoded><![CDATA[<?php strlen( $post->post_content ) > 0 ? the_content() : the_excerpt_rss() ?>]]></content:encoded>
<?php	endif ?>
			<comments><?php comments_link() ?></comments>
			<wfw:commentRss><?php echo get_post_comments_feed_link() ?></wfw:commentRss>
			<slash:comments><?php echo get_comments_number() ?></slash:comments>
			<?php rss_enclosure() ?>
			<?php do_action('rss2_item') ?>
		</item>
<?php endwhile; endif; wp_reset_query() ?>

	</channel>
</rss>
