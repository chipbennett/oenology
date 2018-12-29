<?php
/**
 * Theme bbPress Functions File
 * 
 * Contains all of the Theme's bbPress setup and integration functions,
 * functions and hooks for bbPress integration, bbPress hooks, and bbPress settings.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 * 
 * @uses		add_filter() * * @since 		Oenology 1.0
 */

/**
 * Use Lead Topic
 */
add_filter( 'bbp_show_lead_topic', '__return_true' );

/**
 * Remove post footer avatar on bbPress forums
 * 
 * @param	obj $post_footer_avatar	Post footer avatar.
 */
function oenology_bbpress_post_footer_avatar( $post_footer_avatar ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		__return_false();
	} else {
		return $post_footer_avatar;
	}
}
add_filter( 'oenology_hook_post_footer_avatar', 'oenology_bbpress_post_footer_avatar' );

/**
 * Remove post footer metadata on bbPress forums
 * 
 * @param	obj $post_footer_metadata	Post footer metadata.
 */
function oenology_bbpress_post_footer_metadata( $post_footer_metadata ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		return array();
	} else {		return $post_footer_metadata;
	}
}
add_filter( 'oenology_hook_post_footer_metadata', 'oenology_bbpress_post_footer_metadata' );

/**
 * Add bbPress admin links to metadata
 * 
 * @param	obj $post_header_metadata	Post header metadata.
 */
function oenology_metadata_bbpress_admin_links( $post_header_metadata ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		$post_header_metadata['editlink'] = bbp_get_topic_admin_links();
	}
	return $post_header_metadata;
}
add_filter( 'oenology_hook_post_header_metadata', 'oenology_metadata_bbpress_admin_links' );

/** 
 * Add bbPress tags to post header taxonomies
 * 
 * @param	obj $post_header_taxonomies	Post header taxonomies.
 */
function oenology_post_header_bbpress_taxonomy( $post_header_taxonomies ) {
	if ( function_exists( 'is_bbpress' ) && is_bbpress() ) {
		// bbPress Tags.
		$post_header_taxonomies['bbpresstags'] = '<span class="post-title-tags">' . bbp_get_topic_tag_list() . '</span>';
	}
	return $post_header_taxonomies;
}
add_filter( 'oenology_hook_post_header_taxonomies', 'oenology_post_header_bbpress_taxonomy' );

/** 
 * Add bbPress user actions to post header title
 * 
 * @param	array $post_header_title	Post header title.
 */
function oenology_post_header_bbpress_user_actions( $post_header_title ) {
	$post_header_title_actions = '';
	if ( function_exists( 'is_bbpress' ) && bbp_is_single_topic() ) {
		// bbPress User Actions.
		$post_header_title_actions = bbp_get_user_favorites_link( 
			array( 'pre' => '', 'mid' => '<span class="genericon genericon-star favorite-add" title="Add to Favorites"></span>', 'post' => '' ),
			array( 'pre' => '', 'mid' => '<span class="genericon genericon-star favorite-remove" title="Remove from Favorites"></span>', 'post' => '' )
		);
		$post_header_title_actions .= bbp_get_user_subscribe_link( array( 
			'subscribe' => '<span class="genericon genericon-show subscribe" title="Subscribe"></span>', 
			'unsubscribe' => '<span class="genericon genericon-show unsubscribe" title="Unsubscribe"></span>',
			'before' => ''
		) );
	}
	return $post_header_title_actions . $post_header_title;
}
add_filter( 'oenology_hook_post_header_title', 'oenology_post_header_bbpress_user_actions' );

/**
 * Filter breadcrumb for bbPress Topics
 * 
 * @param	obj    $breadcrumb			breadcrumb.
 * @param	string $containerBefore		HTML before container.
 * @param	string $containerAfter		HTML after container.
 * @param	string $containerCrumb		HTML crumb container.
 * @param	string $containerCrumbEnd	HTML crumb container end.
 * @param	string $delimiter			crumb delimiter.
 * @param	string $name				home text.
 * @param	string $blogname			blog name.
 * @param	string $currentBefore		HTML before current location.
 * @param	string $currentAfter		HTML after current location.
 */
function oenology_bbpress_breadcrumb( $breadcrumb, $containerBefore, $containerAfter, $containerCrumb, $containerCrumbEnd, $delimiter, $name, $blogname, $currentBefore, $currentAfter ) {
	if ( is_bbpress() ) {
		$breadcrumb = bbp_get_breadcrumb( array(
			'before' => $containerBefore . $containerCrumb,
			'after' => $containerCrumbEnd . $containerAfter,
			'sep' => $delimiter,
			'home_text' => $name,
			'current_before' => $currentBefore,
			'current_after' => $currentAfter
		));
	}
	return $breadcrumb;
}
add_filter( 'oenology_breadcrumb', 'oenology_bbpress_breadcrumb', 10, 10 );

/**
 * Filter page layout for bbPress
 * 
 * @param	string $layout				layout type.
 */
function oenology_bbpress_page_layout( $layout ) {
	if ( ( function_exists( 'is_bbpress' ) && is_bbpress() ) ) {
		return 'full';
	} else {
		return $layout;
	}
}
add_filter( 'oenology_get_current_page_layout', 'oenology_bbpress_page_layout' );