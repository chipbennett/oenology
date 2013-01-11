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
function oenology_add_layout_meta_box( $post ) {
    global $wp_meta_boxes;
	
	$context = apply_filters( 'oenology_layout_meta_box_context', 'side' ); // 'normal', 'side', 'advanced'
	$priority = apply_filters( 'oenology_layout_meta_box_priority', 'default' ); // 'high', 'core', 'low', 'default'

    add_meta_box( 
		'oenology_layout', 
		__( 'Single Post Layout', 'oenology' ), 
		'oenology_layout_meta_box', 
		'post', 
		$context, 
		$priority 
	);
    add_meta_box( 
		'oenology_layout', 
		__( 'Static Page Layout', 'oenology' ), 
		'oenology_layout_meta_box', 
		'page', 
		$context, 
		$priority 
	);
	
}
// Hook meta boxes into 'add_meta_boxes'
add_action( 'add_meta_boxes', 'oenology_add_layout_meta_box' );

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
function oenology_save_layout_post_metadata(){
	global $post;
	if ( ! isset( $post ) || ! is_object( $post ) ) {
		return;
	}
	$option_parameters = oenology_get_option_parameters();
	$valid_layouts = array();
	if ( 'post' == $post->post_type ) {
		$valid_layouts = $option_parameters['default_single_post_layout']['valid_options'];
	} else if ( 'page' == $post->post_type ) {
		$valid_layouts = $option_parameters['default_static_page_layout']['valid_options'];
	}
	$layout = ( isset( $_POST['_oenology_layout'] ) && array_key_exists( $_POST['_oenology_layout'], $valid_layouts ) ? $_POST['_oenology_layout'] : 'default' );

	update_post_meta( $post->ID, '_oenology_layout', $layout );
}
// Hook the save layout post custom meta data into
// publish_{post-type}, draft_{post-type}, and future_{post-type}
add_action( 'publish_post', 'oenology_save_layout_post_metadata' );
add_action( 'publish_page', 'oenology_save_layout_post_metadata' );
add_action( 'draft_post', 'oenology_save_layout_post_metadata' );
add_action( 'draft_page', 'oenology_save_layout_post_metadata' );
add_action( 'future_post', 'oenology_save_layout_post_metadata' );
add_action( 'future_page', 'oenology_save_layout_post_metadata' );