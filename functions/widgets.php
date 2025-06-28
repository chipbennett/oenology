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

add_action( 'after_setup_theme', 'oenology_setup_widgets', 11 );

/**
 * Register all widget areas (sidebars)
 * 
 * @uses	oenology_get_widget_args()	Defined in functions/custom.php
 * 
 * @since	WordPress 2.8
 */
function oenology_setup_widgets() {

	register_sidebar( array_merge( 
		// Top full-width widget area.
		array(
			'name'			=> __( 'Sidebar Column Top', 'oenology' ),
			'id'			=> 'sidebar-column-top',
			'description'	=> __( 'Top, full-width sidebar in two-column layout', 'oenology' ) 
		),
		oenology_get_widget_args()
	) );
	register_sidebar( array_merge( 
		// Left Column widget area.
		array(
			'name'			=> __( 'Sidebar Left', 'oenology' ),
			'id'			=> 'sidebar-left',
			'description'	=> __( 'Left-column, half-width sidebar in three-column layout' , 'oenology' )
		),
		oenology_get_widget_args()
	) );
	register_sidebar( array_merge( 
		// Right Column widget area.
		array(
			'name'			=> __( 'Sidebar Right', 'oenology' ),
			'id'			=> 'sidebar-right',
			'description'	=> __( 'Right-column, half-width sidebar in three-column layout', 'oenology' )
		),
		oenology_get_widget_args()
	) );
	register_sidebar( array_merge( 
		// Bottom full-width widget area.
		array(
			'name'			=> __( 'Sidebar Column Bottom', 'oenology' ),
			'id'			=> 'sidebar-column-bottom',
			'description'	=> __( 'Bottom, full-width sidebar in two-column layout', 'oenology' ) 
		),
		oenology_get_widget_args()
	) );
	register_sidebar( array_merge( 
		// Widget area beneath each Post content.
		array(
			'name'			=> __( 'Post Entry Below', 'oenology' ),
			'id'			=> 'post-entry-below',
			'description'	=> __( 'Beneath Post content, before Post footer', 'oenology' ) 
		),
		oenology_get_widget_args()
	) );
	register_sidebar( array_merge( 
		// Widget area below each Post.
		array(
			'name'			=> __( 'Post Below', 'oenology' ),
			'id'			=> 'post-below',
			'description'	=> __( 'Beneath Post', 'oenology' ) 
		),
		oenology_get_widget_args()
	) );
	register_sidebar( array( 
		// Featured Content template.
		'name'			=> __( 'Featured Content', 'oenology' ),
		'id'			=> 'featured-content',
		'description'	=> __( 'Featured content template Widgets', 'oenology' ),
		// Widget container opening tag, with classes.
		'before_widget' => '<div class="featured-content-widget"><div id="%1$s" class="widget %2$s">',
		// Widget container closing tag.
		'after_widget' => '</div></div>',
		// Widget Title container opening tag, with classes.
		'before_title' => '<div class="title widgettitle">',
		// Widget Title container closing tag.
		'after_title' => '</div>'
	) );

}


/**
 * Define Categories Custom Widget  
 * 
 * @uses	oenology_get_custom_category_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_categories extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-categories', 'description' => __( 'Oenology theme widget to display the category list in the left column', 'oenology' ) );
        parent::__construct('oenology_categories', __( 'Oenology Categories', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __( 'Oenology Categories', 'oenology' ) : $instance['title']);

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

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
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

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-tags', 'description' => __( 'Oenology theme widget to display the tag list in the left column', 'oenology' ) );
        parent::__construct('oenology_tags', __( 'Oenology Tags', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __( 'Oenology Tags', 'oenology' ) : $instance['title']);

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

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
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

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-post-formats', 'description' => __( 'Oenology theme widget to display the Post Format list in the left column', 'oenology' ) );
        parent::__construct('oenology_post_formats', __( 'Oenology Post Formats', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __( 'Oenology Post Formats', 'oenology' ) : $instance['title']);

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

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/**
 * Define Social Icons Custom Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_social_icons extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-social-icons', 'description' => __( 'Oenology theme widget to display social network icons', 'oenology' ) );
        parent::__construct('oenology_social_icons', __( 'Oenology Social Icons', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? __( 'Social Networks', 'oenology' ) : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Social Icons -->
<ul class="leftcolcatlist">
	<?php echo oenology_social_icons(); ?>
</ul>
<!-- End Social Icons -->

<?php
        echo $after_widget;
    }

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
        $title = strip_tags($instance['title']);
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
<?php
    }
} 

/**
 * Featured Post Formats Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_featured_post_formats extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-featured-post-formats', 'description' => __( 'Oenology theme widget to display a list of featured posts from any post format', 'oenology' ) );
        parent::__construct('oenology_featured_post_formats', __( 'Oenology Post Formats Feature', 'oenology' ), $widget_ops);
    }
	
	/**
	 * Pre-defined post formats
	 */
	function get_post_formats() {
		$formats = array( 'status', 'quote', 'image' );
		return $formats;
	}

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
		$formats = $this->get_post_formats();
        $title = ( ! $instance['title'] ? false : apply_filters( 'widget_title', $instance['title'] ) );
		$format = ( in_array( $instance['format'], $formats ) ? $instance['format'] : 'status' );
		$number_posts = ( is_int( (int) $instance['number_posts'] ) && 0 < $instance['number_posts'] && 6 > $instance['number_posts'] ? $instance['number_posts'] : '3' );
		$columns = ( is_int( (int) $instance['columns'] ) && 0 < $instance['columns'] && 4 > $instance['columns'] ? $instance['columns'] : '1' );
		$orderby = ( in_array( $instance['orderby'], array( 'date', 'rand' ) ) ? $instance['orderby'] : 'date' );
		$rows = ( is_int( (int) $instance['rows'] ) && 0 < $instance['rows'] && 6 > $instance['rows'] ? $instance['rows'] : '1' );

        echo '<div class="featured-content-columns-' . $columns . ' featured-content-rows-' . $rows . ' featured-content-' . $format . '">' . $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Post Formats -->
<?php
$format_posts_query_args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_posts,
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-' . $format,
		)
	)
);
if ( 'rand' == $orderby ) {
	$format_posts_query_args['orderby'] = 'rand';
}
$format_posts = new WP_Query( $format_posts_query_args );

/* Main loop - displays posts */
if ( $format_posts->have_posts() ) :

	switch ( $format ) {
				
		// Status post format.
		case ( 'status' ) :
			?>
			<ul class="status-list">
			
				<?php
				while ( $format_posts->have_posts() ) : $format_posts->the_post(); 
					?>

					<li <?php post_class(); ?>>			
						
						<?php the_content(); ?>

						<div>
							<p>
								<a href="<?php the_permalink(); ?>">
								<?php echo human_time_diff( get_the_time('U'), current_time('timestamp') ); ?> ago
								</a>
							</p>
						</div>
					</li>
					<?php
				endwhile;	
				?>
			
			</ul>
			<?php
			break;
			
		// Quote post format.
		case ( 'quote' ) :
			?>
			<ul class="quote-list">
			
				<?php
				while ( $format_posts->have_posts() ) : $format_posts->the_post(); 
					?>

					<li <?php post_class(); ?>>
					
						<?php 
						if ( function_exists( 'the_post_format_quote' ) ) {
							the_post_format_quote(); 
						} else {
							the_content();
						}
						?>
						
					</li>
					<?php
				endwhile;	
				?>
			
			</ul>
			<?php
			break;
			
		// Image post format.
		case( 'image' ) :
			?>
			<div class="cycle-slideshow">
				<div class="cycle-prev"><div class="genericon genericon-leftarrow"></div></div>
				<div class="cycle-next"><div class="genericon genericon-rightarrow"></div></div>
				<?php
				while ( $format_posts->have_posts() ) : $format_posts->the_post();
				
					if ( has_post_thumbnail() ) {
						the_post_thumbnail( 'featured-content-slider' );
					} else if ( function_exists( 'the_post_format_image' ) ) {
						the_post_format_image( 'featured-content-slider' ); 
					}
					
				endwhile;
				?>
			</div>
			<?php
			wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/js/cycle2/jquery.cycle2.min.js', array( 'jquery' ) );
			break;
		
	} // Switch.

endif; 
wp_reset_postdata();
?>
<!-- End Post Formats -->

<?php
        echo $after_widget . '</div>';
    }

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
		$formats = $this->get_post_formats();
        $instance['title'] = '' != $new_instance['title'] ? strip_tags( $new_instance['title'] ) : false;
		$instance['format'] = ( in_array( $new_instance['format'], $formats ) ? $new_instance['format'] : 'status' );
		$instance['number_posts'] = ( is_int( (int) $new_instance['number_posts'] ) && 0 < $new_instance['number_posts'] && 6 > $new_instance['number_posts'] ? $new_instance['number_posts'] : $instance['number_posts'] );
		$instance['orderby'] = ( in_array( $new_instance['orderby'], array( 'date', 'rand' ) ) ? $new_instance['orderby'] : 'date' );
		$instance['columns'] = ( is_int( (int) $new_instance['columns'] ) && 0 < $new_instance['columns'] && 4 > $new_instance['columns'] ? $new_instance['columns'] : $instance['columns'] );
		$instance['rows'] = ( is_int( (int) $new_instance['rows'] ) && 0 < $new_instance['rows'] && 6 > $new_instance['rows'] ? $new_instance['rows'] : $instance['rows'] );

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Post Formats Feature', 'oenology' ), 'format' => 'status', 'number_posts' => '3', 'orderby' => 'date', 'columns' => '1', 'rows' => '1' ) );
		$formats = $this->get_post_formats();
        $title = strip_tags( $instance['title'] );
        $format = strip_tags( $instance['format'] );
		$number_posts = strip_tags( $instance['number_posts'] );
		$orderby = strip_tags( $instance['orderby'] );
        $columns = strip_tags( $instance['columns'] );
        $rows = strip_tags( $instance['rows'] );
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p>
				<label for="<?php echo $this->get_field_id('format'); ?>"><?php _e( 'Post Format to Display', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('format'); ?>" name="<?php echo $this->get_field_name('format'); ?>">
					<?php
					foreach ( $formats as $post_format ) {
						?>
						<option value="<?php echo $post_format; ?>" <?php selected( $post_format == $format ); ?>><?php echo $post_format; ?></option>
						<?php
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('number_posts'); ?>"><?php _e( '# Posts to Display', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('number_posts'); ?>" name="<?php echo $this->get_field_name('number_posts'); ?>">
					<?php
					$i = 1;
					while ( $i <= 5 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $number_posts ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e( 'Post Order', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
					<option value="date" <?php selected( 'date' == $orderby ); ?>>Latest Posts</option>
					<option value="rand" <?php selected( 'rand' == $orderby ); ?>>Random</option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e( '# Columns', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php
					$i = 1;
					while ( $i <= 3 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $columns ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e( '# Rows', 'oenology' ); ?>:</label> 		
				<select id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>">
					<?php
					$i = 1;
					while ( $i <= 5 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $rows ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>
<?php
    }
} 

/**
 * Featured Content Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_featured_content extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-featured-content', 'description' => __( 'Oenology theme widget to display a featured content slider', 'oenology' ) );
        parent::__construct('oenology_featured_content', __( 'Oenology Featured Content Slider', 'oenology' ), $widget_ops);
    }

	/**
	 * Pre-defined valid slider transitions
	 */
	function get_valid_slider_transitions() {
	
		return apply_filters( 'oenology_valid_slider_transitions', array(
			'fade' => __( 'Fade', 'oenology' ),
			'fadeout' => __( 'Fade Out', 'oenology' ),
			'scroll' => __( 'Scroll', 'oenology' ),
			'tileSlide' => __( 'Tile Slide', 'oenology' ),
			'tileBlind' => __( 'Tile Blinds', 'oenology' ),
			'none' => __( 'None', 'oenology' ),
		) );
	}

	/**
	 * Pre-defined valid slider directions
	 */
	function get_valid_slider_directions() {
		return apply_filters( 'oenology_valid_slider_directions', array(
			'horizontal' => __( 'Horizontal', 'oenology' ),
			'vertical' => __( 'Vertical', 'oenology' ),
		) );
	}

	/**
	 * Pre-defined valid slider timeouts
	 */
	function get_valid_slider_timeouts() {
	
		return apply_filters( 'oenology_valid_slider_timeouts', array(
			'500' => __( '0.5 Seconds', 'oenology' ),
			'1000' => __( '1.0 Second', 'oenology' ),
			'1500' => __( '1.5 secondsl', 'oenology' ),
			'2000' => __( '2.0 seconds', 'oenology' ),
			'2500' => __( '2.5 secondsl', 'oenology' ),
			'3000' => __( '3.0 seconds', 'oenology' ),
			'3500' => __( '3.5 secondsl', 'oenology' ),
			'4000' => __( '4.0 seconds', 'oenology' ),
			'4500' => __( '4.5 secondsl', 'oenology' ),
			'5000' => __( '5.0 seconds', 'oenology' ),
		) );
	}

	/**
	 * Pre-defined valud slider speeds
	 */
	function get_valid_slider_speeds() {
	
		return apply_filters( 'oenology_valid_slider_speeds', array(
			'500' => __( '0.5 Seconds', 'oenology' ),
			'1000' => __( '1.0 Second', 'oenology' ),
			'1500' => __( '1.5 secondsl', 'oenology' ),
			'2000' => __( '2.0 seconds', 'oenology' ),
		) );
	}

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
		// title.
        $title = ( ! $instance['title'] ? false : apply_filters( 'widget_title', $instance['title'] ) );

		// Slider Options.
		$valid_transitions = $this->get_valid_slider_transitions();
		$fx = ( isset( $instance['fx'] ) && array_key_exists( $instance['fx'], $valid_transitions ) ? $instance['fx'] : 'fade' );
		$valid_directions = $this->get_valid_slider_directions();
		$direction = ( isset( $instance['direction'] ) && array_key_exists( $instance['direction'], $valid_directions ) ? $instance['direction'] : 'horizontal' );
		// Scroll direction.
		if ( 'scroll' == $fx ) { $fx .= ( 'horizontal' == $direction ? 'Horz' : 'Vert' ); }
		$valid_timeouts = $this->get_valid_slider_timeouts();
		$timeout = ( isset( $instance['timeout'] ) && array_key_exists( $instance['timeout'], $valid_timeouts ) ? $instance['timeout'] : '4000' );
		$valid_speeds = $this->get_valid_slider_speeds();
		$speed = ( isset( $instance['speed'] ) && array_key_exists( $instance['speed'], $valid_speeds ) ? $instance['speed'] : '500' );
		$reverse = ( isset( $instance['reverse'] ) && 'true' == $instance['reverse'] ? 'true' : 'false' );

		// Columns & Rows.
		$columns = ( is_int( (int) $instance['columns'] ) && 0 < $instance['columns'] && 4 > $instance['columns'] ? $instance['columns'] : '1' );
		$rows = ( is_int( (int) $instance['rows'] ) && 0 < $instance['rows'] && 6 > $instance['rows'] ? $instance['rows'] : '1' );

        echo '<div class="featured-content-columns-' . $columns . ' featured-content-rows-' . $rows . ' featured-content-slider">' . $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Featured Content Slider -->
<?php
$featured_content_query_args = array(
	'post_type' => array( 'post', 'page' ),
	'posts_per_page' => -1,
	'ignore_sticky_posts' => true,
	'meta_key' => '_oenology_featured_content',
	'meta_value' => 'true',
	'meta_compare' => '='
);
$featured_content = new WP_Query( $featured_content_query_args );

// Image size.
$image_size = 'featured-content-slider';
if ( 1 < $columns ) {
	$image_size .= ( 2 < $columns ? '-three-column' : '-two-column' );
}
if ( 1 < $rows ) {
	$image_size .= ( 2 < $rows ? '-three-row' : '-two-row' );
}

// Prev/Next or Pager?
$nav = 'prev-next';

/* Main loop - displays posts */
if ( $featured_content->have_posts() ) :
	?>
	<div class="cycle-slideshow"
		data-cycle-slides="> div.cycle-slide" 
		data-cycle-pause-on-hover="true" 
		data-cycle-fx="<?php echo $fx; ?>"
		data-cycle-timeout="<?php echo $timeout; ?>"
		data-cycle-speed="<?php echo $speed; ?>"
		data-cycle-reverse="<?php echo $reverse; ?>"
		<?php if ( in_array( $fx, array( 'tileSlide', 'tileBlind' ) ) ) { ?>
			data-cycle-tile-vertical="<?php echo ( 'horizontal' == $direction ? 'false' : 'true' ); ?>"
		<?php } ?>
	>
		<?php
		if ( 'prev-next' == $nav ) {
			?>
			<div class="cycle-prev"><div class="genericon genericon-leftarrow"></div></div>
			<div class="cycle-next"><div class="genericon genericon-rightarrow"></div></div>
			<?php
		}
		while ( $featured_content->have_posts() ) : $featured_content->the_post();
			?>			
			<div class="cycle-slide">
			<?php
				if ( has_post_thumbnail() ) {
					the_post_thumbnail( $image_size );
				}
				?>
				<div class="featured-content-slider-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</div>
				<div class="featured-content-slider-excerpt">
					<?php the_excerpt(); ?>
				</div>
				<?php
				?>
			</div>
			<?php			
		endwhile;
		?>
	</div>
	<?php
	wp_enqueue_script( 'cycle2', get_template_directory_uri() . '/js/cycle2/jquery.cycle2.min.js', array( 'jquery' ) );
	if ( 'scrollVert' == $fx ) { wp_enqueue_script( 'cycle2-scrollvert', get_template_directory_uri() . '/js/cycle2/jquery.cycle2.scrollVert.min.js', array( 'cycle2' ) ); }
	if ( in_array( $fx, array( 'tileSlide', 'tileBlind' ) ) ) { wp_enqueue_script( 'cycle2-tile', get_template_directory_uri() . '/js/cycle2/jquery.cycle2.tile.min.js', array( 'cycle2' ) ); }

endif; 
wp_reset_postdata();
?>
<!-- End Post Formats -->

<?php
        echo $after_widget . '</div>';
    }

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

		// Title.
        $instance['title'] = '' != $new_instance['title'] ? strip_tags( $new_instance['title'] ) : false;

		// Slider Effects.
		$valid_transitions = $this->get_valid_slider_transitions();
		$instance['fx'] = ( array_key_exists( $new_instance['fx'], $valid_transitions ) ? $new_instance['fx'] : $instance['fx'] );
		$valid_directions = $this->get_valid_slider_directions();
		$instance['direction'] = ( array_key_exists( $new_instance['direction'], $valid_directions ) ? $new_instance['direction'] : $instance['direction'] );
		$valid_timeouts = $this->get_valid_slider_timeouts();
		$instance['timeout'] = ( array_key_exists( $new_instance['timeout'], $valid_timeouts ) ? $new_instance['timeout'] : $instance['timeout'] );
		$valid_speeds = $this->get_valid_slider_speeds();
		$instance['speed'] = ( array_key_exists( $new_instance['speed'], $valid_speeds ) ? $new_instance['speed'] : $instance['speed'] );		
		$instance['reverse'] = ( isset( $new_instance['reverse'] ) && 'true' == $new_instance['reverse'] ? 'true' : 'false' );

		// Columns and Rows.
		$instance['columns'] = ( is_int( (int) $new_instance['columns'] ) && 0 < $new_instance['columns'] && 4 > $new_instance['columns'] ? $new_instance['columns'] : $instance['columns'] );
		$instance['rows'] = ( is_int( (int) $new_instance['rows'] ) && 0 < $new_instance['rows'] && 6 > $new_instance['rows'] ? $new_instance['rows'] : $instance['rows'] );

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 
			'title' => '', 
			'fx' => 'fade', 
			'direction' => 'horizontal', 
			'timeout' => '4000', 
			'speed' => '500', 
			'reverse' => 'false', 
			'columns' => '1', 
			'rows' => '1' 
		) );

		// Title.
        $title = strip_tags( $instance['title'] );

		// Slider Effects.
		$valid_transitions = $this->get_valid_slider_transitions();
		$fx = ( array_key_exists( $instance['fx'], $valid_transitions ) ? $instance['fx'] : 'fade' );
		$valid_directions = $this->get_valid_slider_directions();
		$direction = ( array_key_exists( $instance['direction'], $valid_directions ) ? $instance['direction'] : 'horizontal' );
		$valid_timeouts = $this->get_valid_slider_timeouts();
		$timeout = ( array_key_exists( $instance['timeout'], $valid_timeouts ) ? $instance['timeout'] : '4000' );
		$valid_speeds = $this->get_valid_slider_speeds();
		$speed = ( array_key_exists( $instance['speed'], $valid_speeds ) ? $instance['speed'] : '500' );
		$reverse = ( isset( $instance['reverse'] ) && 'true' == $instance['reverse'] ? 'true' : 'false' );

		// Columns and Rows.
        $columns = strip_tags( $instance['columns'] );
        $rows = strip_tags( $instance['rows'] );
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p>
				<label for="<?php echo $this->get_field_id('fx'); ?>"><?php _e( 'Transition Effect', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('fx'); ?>" name="<?php echo $this->get_field_name('fx'); ?>">
					<?php
					foreach ( $valid_transitions as $slug => $title ) {
						?>
						<option value="<?php echo $slug; ?>" <?php selected( $slug == $fx ); ?>><?php echo $title; ?></option>
						<?php
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('direction'); ?>"><?php _e( 'Transition Direction (Scroll/Tile)', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('direction'); ?>" name="<?php echo $this->get_field_name('direction'); ?>">
					<?php
					foreach ( $valid_directions as $slug => $title ) {
						?>
						<option value="<?php echo $slug; ?>" <?php selected( $slug == $direction ); ?>><?php echo $title; ?></option>
						<?php
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('timeout'); ?>"><?php _e( 'Transition Timeout (Time Between Slide Tranitions)', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('timeout'); ?>" name="<?php echo $this->get_field_name('timeout'); ?>">
					<?php
					foreach ( $valid_timeouts as $slug => $title ) {
						?>
						<option value="<?php echo $slug; ?>" <?php selected( $slug == $timeout ); ?>><?php echo $title; ?></option>
						<?php
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('speed'); ?>"><?php _e( 'Transition Speed', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('speed'); ?>" name="<?php echo $this->get_field_name('speed'); ?>">
					<?php
					foreach ( $valid_speeds as $slug => $title ) {
						?>
						<option value="<?php echo $slug; ?>" <?php selected( $slug == $speed ); ?>><?php echo $title; ?></option>
						<?php
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('reverse'); ?>"><?php _e( 'Reverse Slides', 'oenology' ); ?>:</label>
				<select id="<?php echo $this->get_field_id('reverse'); ?>" name="<?php echo $this->get_field_name('reverse'); ?>">
					<option value="false" <?php selected( 'false' == $reverse ); ?>><?php _e( 'False', 'oenology' ); ?></option>
					<option value="true" <?php selected( 'true' == $reverse ); ?>><?php _e( 'True', 'oenology' ); ?></option>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e( '# Columns', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php
					$i = 1;
					while ( $i <= 3 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $columns ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e( '# Rows', 'oenology' ); ?>:</label> 		
				<select id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>">
					<?php
					$i = 1;
					while ( $i <= 5 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $rows ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>
<?php
    }
} 

/**
 * Call To Action Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_call_to_action extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-call-to-action', 'description' => __( 'Oenology theme widget to display a Call To Action', 'oenology' ) );
        parent::__construct('oenology_call_to_action', __( 'Oenology Call To Action', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = ( ! $instance['title'] ? false : apply_filters( 'widget_title', $instance['title'] ) );
		$cta_text = ( empty( $instance['cta_text']) ? '' : $instance['cta_text'] );
		$cta_button_text = ( empty( $instance['cta_button_text'] ) ? '' : $instance['cta_button_text'] );
		$cta_button_page_id = ( empty( $instance['cta_button_page_id'] ) ? '0' : $instance['cta_button_page_id'] );
		$columns = ( is_int( (int) $instance['columns'] ) && 0 < $instance['columns'] && 4 > $instance['columns'] ? $instance['columns'] : '1' );
		$rows = ( is_int( (int) $instance['rows'] ) && 0 < $instance['rows'] && 6 > $instance['rows'] ? $instance['rows'] : '1' );

        echo '<div class="featured-content-columns-' . $columns . ' featured-content-rows-' . $rows . ' featured-content-call-to-action">' . $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin CTA -->

<div class="featured-content-cta-text"><?php echo esc_html( $cta_text ); ?></div>
<div class="featured-content-cta-button"><a href="<?php echo get_permalink( $cta_button_page_id ); ?>"><?php echo esc_html( $cta_button_text ); ?></a></div>

<!-- End CTA -->

<?php
        echo $after_widget . '</div>';
    }

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = '' != $new_instance['title'] ? strip_tags( $new_instance['title'] ) : false;
		$instance['cta_text'] = strip_tags( $new_instance['cta_text'] );
		$instance['cta_button_text'] = strip_tags( $new_instance['cta_button_text'] );
		$instance['cta_button_page_id'] = strip_tags( $new_instance['cta_button_page_id'] );
		$instance['columns'] = ( is_int( (int) $new_instance['columns'] ) && 0 < $new_instance['columns'] && 4 > $new_instance['columns'] ? $new_instance['columns'] : $instance['columns'] );
		$instance['rows'] = ( is_int( (int) $new_instance['rows'] ) && 0 < $new_instance['rows'] && 6 > $new_instance['rows'] ? $new_instance['rows'] : $instance['rows'] );

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Call To Action', 'oenology' ), 'cta_text' => '', 'cta_button_text' => '', 'cta_button_page_id' => '', 'columns' => '1', 'rows' => '1' ) );
        $title = strip_tags( $instance['title'] );
        $cta_text = strip_tags( $instance['cta_text'] );
        $cta_button_text = strip_tags( $instance['cta_button_text'] );
        $cta_button_page_id = strip_tags( $instance['cta_button_page_id'] );
        $columns = strip_tags( $instance['columns'] );
        $rows = strip_tags( $instance['rows'] );
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p>
				<label for="<?php echo $this->get_field_id('cta_text'); ?>"><?php _e( 'Call To Action Text', 'oenology' ); ?>:</label> 
				<textarea class="widefat" id="<?php echo $this->get_field_id('cta_text'); ?>" name="<?php echo $this->get_field_name('cta_text'); ?>" type="text"><?php
					echo esc_textarea($cta_text);
				?></textarea>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('cta_button_text'); ?>"><?php _e( 'CTA Button Text', 'oenology' ); ?>:</label> 
				<input class="widefat" id="<?php echo $this->get_field_id('cta_button_text'); ?>" name="<?php echo $this->get_field_name('cta_button_text'); ?>" type="text" value="<?php echo esc_attr($cta_button_text); ?>" />
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('cta_button_page_id'); ?>"><?php _e( 'CTA Page Link', 'oenology' ); ?>:</label>
				<?php
				wp_dropdown_pages( array( 
					'depth'            => 0,
					'child_of'         => 0,
					'selected'         => $cta_button_page_id,
					'echo'             => 1,
					'name'             => $this->get_field_name('cta_button_page_id'),
					'id'               => $this->get_field_id('cta_button_page_id')
				) );
				?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e( '# Columns', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php
					$i = 1;
					while ( $i <= 3 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $columns ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e( '# Rows', 'oenology' ); ?>:</label> 		
				<select id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>">
					<?php
					$i = 1;
					while ( $i <= 5 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $rows ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>
<?php
    }
} 

/**
 * Featured Page Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_featured_page extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-featured-page', 'description' => __( 'Oenology theme widget to display a featured page', 'oenology' ) );
        parent::__construct('oenology_featured_page', __( 'Oenology Featured Page', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = ( ! $instance['title'] ? false : apply_filters( 'widget_title', $instance['title'] ) );
		$page_id = ( empty( $instance['page_id'] ) ? '0' : $instance['page_id'] );
		$columns = ( is_int( (int) $instance['columns'] ) && 0 < $instance['columns'] && 4 > $instance['columns'] ? $instance['columns'] : '1' );
		$rows = ( is_int( (int) $instance['rows'] ) && 0 < $instance['rows'] && 6 > $instance['rows'] ? $instance['rows'] : '1' );

        echo '<div class="featured-content-columns-' . $columns . ' featured-content-rows-' . $rows . '">' . $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;

		$featured_post_args = array(
			'post_type' => 'page',
			'page_id' => $page_id
		);
		$featured_post = new WP_Query( $featured_post_args );

?>

<!-- Begin Featured Page -->

<?php if ( $featured_post->have_posts() ) : while ( $featured_post->have_posts() ) : $featured_post->the_post(); ?>

	<?php if ( 1 < $rows ) { ?>
	
		<div class="featured-post-image"><?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'featured-content-featured-post-thumbnail' ); } ?></div>
		
	<?php } ?>

	<div class="featured-post-title"><h2><?php the_title(); ?></h2></div>

	<div class="featured-post-excerpt"><?php the_excerpt(); ?></div>
	
	<div class="featured-post-read-more"><a href="<?php the_permalink(); ?>">Read More</a></div>

<?php endwhile; endif; wp_reset_postdata(); ?>

<!-- End Featured Page -->

<?php
        echo $after_widget . '</div>';
    }

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = '' != $new_instance['title'] ? strip_tags( $new_instance['title'] ) : false;
		$instance['page_id'] = strip_tags( $new_instance['page_id'] );
		$instance['columns'] = ( is_int( (int) $new_instance['columns'] ) && 0 < $new_instance['columns'] && 4 > $new_instance['columns'] ? $new_instance['columns'] : $instance['columns'] );
		$instance['rows'] = ( is_int( (int) $new_instance['rows'] ) && 0 < $new_instance['rows'] && 6 > $new_instance['rows'] ? $new_instance['rows'] : $instance['rows'] );

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => __( 'Featured Page', 'oenology' ), 'page_id' => '', 'columns' => '1', 'rows' => '1' ) );
        $title = strip_tags( $instance['title'] );
        $page_id = strip_tags( $instance['page_id'] );
        $columns = strip_tags( $instance['columns'] );
        $rows = strip_tags( $instance['rows'] );
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

			<p>
				<label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e( 'Page', 'oenology' ); ?>:</label>
				<?php
				wp_dropdown_pages( array( 
					'depth'            => 0,
					'child_of'         => 0,
					'selected'         => $page_id,
					'echo'             => 1,
					'name'             => $this->get_field_name('page_id'),
					'id'               => $this->get_field_id('page_id')
				) );
				?>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e( '# Columns', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php
					$i = 1;
					while ( $i <= 3 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $columns ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e( '# Rows', 'oenology' ); ?>:</label> 		
				<select id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>">
					<?php
					$i = 1;
					while ( $i <= 5 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $rows ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>
<?php
    }
} 

/**
 * Test Widget 
 * 
 * @uses	oenology_get_custom_post_format_list()	Defined in /functions/custom.php
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_text extends WP_Widget {

	/**
	 * Widget constructor
	 */
    public function __construct() {
        $widget_ops = array('classname' => 'oenology-widget-text', 'description' => __( 'Oenology Theme Text Widget', 'oenology' ) );
        parent::__construct('oenology_text', __( 'Oenology Featured Text', 'oenology' ), $widget_ops);
    }

	/**
	 * Widget output function
	 * 
	 * @param array $args		Widget arguments.
	 * @param obj   $instance	Widget instance object.
	 */
    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'] );
		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance['text'] );
		$columns = ( is_int( (int) $instance['columns'] ) && 0 < $instance['columns'] && 4 > $instance['columns'] ? $instance['columns'] : '1' );
		$rows = ( is_int( (int) $instance['rows'] ) && 0 < $instance['rows'] && 6 > $instance['rows'] ? $instance['rows'] : '1' );

        echo '<div class="featured-content-columns-' . $columns . ' featured-content-rows-' . $rows . '">' . $before_widget;
        if ( $title ) {
            echo $before_title . $title . $after_title;
		}
?>

<div class="textwidget"><?php echo ! empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></div>

<?php
        echo $after_widget . '</div>';
    }

	/**
	 * Widget update function
	 * 
	 * @param obj $new_instance		New widget instance.
	 * @param obj $old_instance		Old widget instance.
	 */
    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags( $new_instance['title'] );
		if ( current_user_can( 'unfiltered_html' ) ) {
			$instance['text'] =  $new_instance['text'];
		} else {
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes( $new_instance['text'] ) ) );
		}
		$instance['filter'] = isset( $new_instance['filter'] );
		$instance['columns'] = ( is_int( (int) $new_instance['columns'] ) && 0 < $new_instance['columns'] && 4 > $new_instance['columns'] ? $new_instance['columns'] : $instance['columns'] );
		$instance['rows'] = ( is_int( (int) $new_instance['rows'] ) && 0 < $new_instance['rows'] && 6 > $new_instance['rows'] ? $new_instance['rows'] : $instance['rows'] );

        return $instance;
    }

	/**
	 * Widget form function
	 * 
	 * @param obj $instance	Widget instance.
	 */
    function form( $instance ) {
        $instance = wp_parse_args( (array) $instance, array( 'title' => '', 'text' => '', 'filter' => false, 'columns' => '1', 'rows' => '1' ) );
        $title = strip_tags( $instance['title'] );
		$text = esc_textarea( $instance['text'] );
		$filter = $instance['filter'];
        $columns = strip_tags( $instance['columns'] );
        $rows = strip_tags( $instance['rows'] );
?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title', 'oenology' ); ?>:</label> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
			
			<textarea class="widefat" rows="16" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
			
			<p><input id="<?php echo $this->get_field_id('filter'); ?>" name="<?php echo $this->get_field_name('filter'); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo $this->get_field_id('filter'); ?>"><?php _e( 'Automatically add paragraphs', 'oenology' ); ?></label></p>

			<p>
				<label for="<?php echo $this->get_field_id('columns'); ?>"><?php _e( '# Columns', 'oenology' ); ?>:</label>			
				<select id="<?php echo $this->get_field_id('columns'); ?>" name="<?php echo $this->get_field_name('columns'); ?>">
					<?php
					$i = 1;
					while ( $i <= 3 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $columns ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>

			<p>
				<label for="<?php echo $this->get_field_id('rows'); ?>"><?php _e( '# Rows', 'oenology' ); ?>:</label> 		
				<select id="<?php echo $this->get_field_id('rows'); ?>" name="<?php echo $this->get_field_name('rows'); ?>">
					<?php
					$i = 1;
					while ( $i <= 5 ) {
						?>
						<option value="<?php echo $i; ?>" <?php selected( $i == $rows ); ?>><?php echo $i; ?></option>
						<?php
						$i++;
					}
					?>
				</select>
			</p>
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
	register_widget( 'oenology_widget_social_icons' );
	register_widget( 'oenology_widget_featured_post_formats' );
	register_widget( 'oenology_widget_featured_content' );
	register_widget( 'oenology_widget_call_to_action' );
	register_widget( 'oenology_widget_featured_page' );
	register_widget( 'oenology_widget_text' );
}
?>