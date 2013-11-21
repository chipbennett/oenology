<?php
/**
 * Oenology Theme post custom metadata functions
 *
 * Contains all of the Theme's post custom metadata
 * functions.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.3
 */

/**
 * Add Layout Meta Box
 * 
 * @link	http://codex.wordpress.org/Function_Reference/_2			__()
 * @link	http://codex.wordpress.org/Function_Reference/add_meta_box	add_meta_box()
 */
function oenology_add_meta_boxes( $post ) {
    global $wp_meta_boxes;
	
	$layout_context = apply_filters( 'oenology_layout_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$layout_priority = apply_filters( 'oenology_layout_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

    add_meta_box( 
		'oenology_layout', 
		__( 'Single Post Layout', 'oenology' ), 
		'oenology_layout_meta_box', 
		'post', 
		$layout_context, 
		$layout_priority 
	);
    add_meta_box( 
		'oenology_layout', 
		__( 'Static Page Layout', 'oenology' ), 
		'oenology_layout_meta_box', 
		'page', 
		$layout_context, 
		$layout_priority 
	);
	
	$featured_content_context = apply_filters( 'oenology_featured_content_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$featured_content_priority = apply_filters( 'oenology_featured_content_meta_box_priority', 'high' ); // 'high', 'core', 'low', 'default'

    add_meta_box( 
		'oenology_featured_content', 
		__( 'Featured Content', 'oenology' ), 
		'oenology_featured_content_meta_box', 
		'post', 
		$featured_content_context, 
		$featured_content_priority 
	);
    add_meta_box( 
		'oenology_featured_content', 
		__( 'Featured Content', 'oenology' ), 
		'oenology_featured_content_meta_box', 
		'page', 
		$featured_content_context, 
		$featured_content_priority 
	);
	
}
// Hook meta boxes into 'add_meta_boxes'
add_action( 'add_meta_boxes', 'oenology_add_meta_boxes' );

/**
 * Define Layout Meta Box
 * 
 * Define the markup for the meta box
 * for the "layout" post custom meta
 * data. The metabox will consist of
 * radio selection options for "default"
 * and each defined, valid layout
 * option for single blog posts or
 * static pages, depending on the 
 * context.
 * 
 * @uses	oenology_get_option_parameters()	Defined in \functions\options.php
 * @uses	checked()
 * @uses	get_post_custom()
 */
function oenology_layout_meta_box() {
	global $post;
	$option_parameters = oenology_get_option_parameters();
	$custom = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$layout = ( isset( $custom['_oenology_layout'][0] ) ? $custom['_oenology_layout'][0] : 'default' );
	$valid_layouts = array();
	if ( 'post' == $post->post_type ) {
	$valid_layouts = $option_parameters['default_single_post_layout']['valid_options'];
	} else if ( 'page' == $post->post_type ) {
	$valid_layouts = $option_parameters['default_static_page_layout']['valid_options'];
	}
	?>
	<p>
	<input type="radio" name="_oenology_layout" <?php checked( 'default' == $layout ); ?> value="default" /> 
	<label><?php _e( 'Default', 'oenology' ); ?></label><br />
	<?php foreach ( $valid_layouts as $valid_layout ) { ?>
		<input type="radio" name="_oenology_layout" <?php checked( $valid_layout['name'] == $layout ); ?> value="<?php echo $valid_layout['name']; ?>" /> 
		<label><?php echo $valid_layout['title']; ?> <span style="padding-left:5px;"><em><?php echo $valid_layout['description']; ?></em></span></label><br />
	<?php } ?>
	</p>
	<?php
}

/**
 * Define Featured Content Meta Box
 * 
 * Define the markup for the meta box
 * for the "featured content" post custom meta
 * data. The metabox will consist of
 * a checkbox to include the post or page 
 * as "featured content" for the featured
 * content page template, as well as a
 * featured content order text field.
 * 
 * @uses	oenology_get_option_parameters()	Defined in \functions\options.php
 * @uses	checked()
 * @uses	get_post_custom()
 */
function oenology_featured_content_meta_box() {
	global $post;
	$option_parameters = oenology_get_option_parameters();
	$custom = ( get_post_custom( $post->ID ) ? get_post_custom( $post->ID ) : false );
	$featured_content = ( isset( $custom['_oenology_featured_content'][0] ) ? 'true' : 'false' );
	$featured_content_order = ( isset( $custom['_oenology_featured_content_order'][0] ) ? $custom['_oenology_featured_content_order'][0] : '0' );
	?>
	<p>
	<label><?php _e( 'Include in featured content slider', 'oenology' ); ?>:</label><br />
	<input type="checkbox" name="_oenology_featured_content" value="true" <?php checked( 'true' == $featured_content ); ?> />
	</p>
	<p>
	<label><?php _e( 'Featured Content Order', 'oenology' ); ?>:</label><br />
	<input type="text" name="_oenology_featured_content" value="<?php echo $featured_content_order; ?>" />
	</p>
	<?php
}

/**
 * Validate, sanitize, and save post metadata.
 * 
 * Validates the user-submitted post custom 
 * meta data, ensuring that the selected layout 
 * option is in the array of valid layout 
 * options; otherwise, it returns 'default'.
 * 
 * @link	http://codex.wordpress.org/Function_Reference/update_post_meta	update_post_meta()
 * 
 * @link	http://php.net/manual/en/function.array-key-exists.php			array_key_exists()
 * 
 * @uses	oenology_get_option_parameters()	Defined in \functions\options.php
 */
function oenology_save_custom_post_metadata(){
	// Don't break on quick edit
	global $post;
	if ( ! isset( $post ) || ! is_object( $post ) ) {
		return;
	}
	
	// Layout - Sanitize
	$option_parameters = oenology_get_option_parameters();
	$valid_layouts = array();
	if ( 'post' == $post->post_type ) {
		$valid_layouts = $option_parameters['default_single_post_layout']['valid_options'];
	} else if ( 'page' == $post->post_type ) {
		$valid_layouts = $option_parameters['default_static_page_layout']['valid_options'];
	}
	$layout = ( isset( $_POST['_oenology_layout'] ) && array_key_exists( $_POST['_oenology_layout'], $valid_layouts ) ? $_POST['_oenology_layout'] : 'default' );

	// Layout - Update
	update_post_meta( $post->ID, '_oenology_layout', $layout );
	
	// Featured Content - Sanitize
	$featured_content = ( isset( $_POST['_oenology_featured_content'] ) ? 'true' : 'false' );
	$featured_content_order = ( isset( $_POST['_oenology_featured_content'] ) && is_int( (int) $_POST['_oenology_featured_content'] ) ? $_POST['_oenology_featured_content'] : '0' );
	
	// Featured Content - Sanitize
	update_post_meta( $post->ID, '_oenology_featured_content', $featured_content );
	update_post_meta( $post->ID, '_oenology_featured_content_order', $featured_content_order );
}
// Hook the save post custom meta data into
// publish_{post-type}, draft_{post-type}, and future_{post-type}
add_action( 'publish_post', 'oenology_save_custom_post_metadata' );
add_action( 'publish_page', 'oenology_save_custom_post_metadata' );
add_action( 'draft_post', 'oenology_save_custom_post_metadata' );
add_action( 'draft_page', 'oenology_save_custom_post_metadata' );
add_action( 'future_post', 'oenology_save_custom_post_metadata' );
add_action( 'future_page', 'oenology_save_custom_post_metadata' );