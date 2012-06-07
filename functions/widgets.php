<?php
/**
 * Oenology Theme Widgets
 *
 * This file defines the Widget functionality and 
 * custom widgets for the Oenology Theme.
 * 
 * Widget Functions
 * 
 *  - Register Widget Areas (Sidebars)
 *  - Define Widgets
 *  - Register Widgets
 *
 * For more information on hooks, actions, and filters, 
 * see {@link http://codex.wordpress.org/Plugin_API Plugin API}.
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2011, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */

/**
 * Define default Widget arguments
 */

function oenology_get_widget_args() {
	$widget_args = array(	
		// Widget container opening tag, with classes
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		// Widget container closing tag
		'after_widget' => '</div>' . oenology_showhide_widget_content_close(),
		// Widget Title container opening tag, with classes
		'before_title' => '<div class="title widgettitle">',
		// Widget Title container closing tag
		'after_title' => '</div>' . oenology_showhide_widget_content_open()
	);
	return $widget_args;
}

add_action( 'after_setup_theme', 'oenology_setup_widgets', 11 );

/**
 * Register all widget areas (sidebars)
 * 
 * @since	WordPress 2.8
 */
function oenology_setup_widgets() {

register_sidebar( array_merge( array( // Top full-width widget area
	'name'=>'Sidebar Column Top',
	'id'=>'sidebar-column-top',
	'description' => 'Top, full-width sidebar in two-column layout' ),
	oenology_get_widget_args()
) );
register_sidebar( array_merge( array( // Left Column widget area
	'name'=>'Sidebar Left',
	'id'=>'sidebar-left',
	'description' => 'Left-column, half-width sidebar in three-column layout' ),
	oenology_get_widget_args()
) );
register_sidebar( array_merge( array( // Right Column widget area
	'name'=>'Sidebar Right',
	'id'=>'sidebar-right',
	'description' => 'Right-column, half-width sidebar in three-column layout' ),
	oenology_get_widget_args()
) );
register_sidebar( array_merge( array( // Bottom full-width widget area
	'name'=>'Sidebar Column Bottom',
	'id'=>'sidebar-column-bottom',
	'description' => 'Bottom, full-width sidebar in two-column layout' ),
	oenology_get_widget_args()
) );
register_sidebar( array_merge( array( // Widget area beneath each Post content
	'name'=>'Post Entry Below',
	'id'=>'post-entry-below',
	'description' => 'Beneath Post content, before Post footer' ),
	oenology_get_widget_args()
) );
register_sidebar( array_merge( array( // Widget area below each Post
	'name'=>'Post Below',
	'id'=>'post-below',
	'description' => 'Beneath Post' ),
	oenology_get_widget_args()
) );

} // function oenology_widget_setup()

function oenology_showhide_widget_content_open() {
	$showhide_id = 'widget-' . mt_rand();
	
	$showhide = '<span class="showhide">';
	$showhide .= 'Click to <span style="color:#5588aa;" onclick="document.getElementById(\'' . $showhide_id . '\').style.display=\'inline\';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById(\'' . $showhide_id . '\').style.display=\'none\';">hide</span>';
	$showhide .= '</span>';
	$showhide .= '<br /><br />';
	$showhide .= '<div id="' . $showhide_id . '" style="display:none;">';
	
	return $showhide;
}

function oenology_showhide_widget_content_close() {
	return '</div>';
}


/**
 * Define Categories Custom Widget  
 * 
 * @uses	oenology_get_custom_category_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_categories extends WP_Widget {

    function oenology_widget_categories() {
        $widget_ops = array('classname' => 'oenology-widget-categories', 'description' => 'oenology theme widget to display the category list in the left column' );
        $this->WP_Widget('oenology_categories', 'oenology Categories', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Categories' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Categories -->
<ul class="leftcolcatlist">
	<?php echo oenology_get_custom_category_list(); ?>
</ul>
<!-- End Categories -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/**
 * Define Tags Custom Widget  
 * 
 * @uses	oenology_get_custom_tag_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_tags extends WP_Widget {

    function oenology_widget_tags() {
        $widget_ops = array('classname' => 'oenology-widget-tags', 'description' => 'oenology theme widget to display the tag list in the left column' );
        $this->WP_Widget('oenology_tags', 'oenology Tags', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Tags' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Tags -->
<ul class="leftcolcatlist">
	<?php echo oenology_get_custom_tag_list(); ?>
</ul>
<!-- End Tags -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 


/**
 * Define Post Formats Custom Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_post_formats extends WP_Widget {

    function oenology_widget_post_formats() {
        $widget_ops = array('classname' => 'oenology-widget-post-formats', 'description' => 'oenology theme widget to display the Post Format list in the left column' );
        $this->WP_Widget('oenology_post_formats', 'oenology Post Formats', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Post Formats' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Post Formats -->
<ul class="leftcolcatlist">
	<?php echo oenology_get_custom_post_format_list(); ?>
</ul>
<!-- End Post Formats -->

<?php
        echo $after_widget;
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 


/* Add our function to the widgets_init hook. */
add_action( 'widgets_init', 'oenology_load_widgets' );

/**
 * Register all Custom Widgets
 * 
 * @since	WordPress 2.8
 */
function oenology_load_widgets() {
	register_widget( 'oenology_widget_categories' );
	register_widget( 'oenology_widget_tags' );
	register_widget( 'oenology_widget_post_formats' );
}
?>