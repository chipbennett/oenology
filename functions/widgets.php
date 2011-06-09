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
		'before_widget' => '<div class="widget">',
		// Widget container closing tag
		'after_widget' => '</div>',
		// Widget Title container opening tag, with classes
		'before_title' => '<div class="title widgettitle">',
		// Widget Title container closing tag
		'after_title' => '</div>'
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

register_sidebar(array( // Top full-width widget area
'name'=>'Sidebar Column Top',
'id'=>'sidebar-column-top',
'description' => 'Top, full-width sidebar in two-column layout',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="title widgettitle">',
'after_title' => '</div>',
));
register_sidebar(array( // Left Column widget area
'name'=>'Sidebar Left',
'id'=>'sidebar-left',
'description' => 'Left-column, half-width sidebar in three-column layout',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="title widgettitle">',
'after_title' => '</div>',
));
register_sidebar(array( // Right Column widget area
'name'=>'Sidebar Right',
'id'=>'sidebar-right',
'description' => 'Right-column, half-width sidebar in three-column layout',
'before_widget' => '',
'after_widget' => '',
'before_title' => '<div class="title">',
'after_title' => '</div>',
));
register_sidebar(array( // Bottom full-width widget area
'name'=>'Sidebar Column Bottom',
'id'=>'sidebar-column-bottom',
'description' => 'Bottom, full-width sidebar in two-column layout',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="title widgettitle">',
'after_title' => '</div>',
));
register_sidebar(array( // Widget area beneath each Post content
'name'=>'Post Entry Below',
'id'=>'post-entry-below',
'description' => 'Beneath Post content, before Post footer',
'before_widget' => '<div id="%1$s" class="widget %2$s">',
'after_widget' => '</div>',
'before_title' => '<div class="title widgettitle">',
'after_title' => '</div>',
));
register_sidebar(array( // Widget area below each Post
'name'=>'Post Below',
'id'=>'post-below',
'description' => 'Beneath Post',
'before_widget' => '<div id="%1$s" class="widget %2$s aligncenter">',
'after_widget' => '</div>',
'before_title' => '<div class="title widgettitle">',
'after_title' => '</div>',
));

} // function oenology_widget_setup()


/**
 * Define Recent Posts Custom Widget 
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_recentposts extends WP_Widget {

    function oenology_widget_recentposts() {
        $widget_ops = array('classname' => 'oenology-widget-recentposts', 'description' => 'oenology theme widget to display recent posts in the left column' );
        $this->WP_Widget('oenology_recentposts', 'oenology Recent Posts', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters( 'widget_title', empty($instance['title']) ? 'oenology Recent Posts' : $instance['title'] );

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Recent Posts -->
<span class="showhide">Click to <span style="color:#5588aa;" onclick="document.getElementById('arch01').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('arch01').style.display='none';">hide</span>
</span>
<br /><br />
<div id="arch01" style="display:none;">
				<ul class="listrecentposts">
				<?php wp_get_archives('type=postbypost&limit=20'); ?>
				</ul>
</div>
<!-- End Recent Posts -->

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
 * Define Archives Custom Widget 
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_archives extends WP_Widget {

    function oenology_widget_archives() {
        $widget_ops = array('classname' => 'oenology-widget-archives', 'description' => 'oenology theme widget to display archives in the left column' );
        $this->WP_Widget('oenology_archives', 'oenology Archives', $widget_ops);
    }

    function widget( $args, $instance ) {
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Archives' : $instance['title']);

        echo $before_widget;
        if ( $title )
            echo $before_title . $title . $after_title;
?>

<!-- Begin Archives -->
<span class="showhide">Click to <span style="color:#5588aa;" onclick="document.getElementById('arch02').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('arch02').style.display='none';">hide</span>
</span>
<br /><br />
<div id="arch02" style="display:none;">
	<ul class="listarchives">
		<?php wp_get_archives('type=monthly&show_post_count=1'); ?>
	</ul>
</div>
<!-- End Archives -->

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
 * Define Categories Custom Widget 
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
<span class="showhide">Click to <span style="color:#5588aa;" onclick="document.getElementById('tax01').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('tax01').style.display='none';">hide</span>
</span>
<br /><br />
<div id="tax01" style="display:none;">
	<ul class="leftcolcatlist">

		<?php
		 $catrssimg = "/images/rss.png";
		 $catrssurl = get_template_directory_uri() . $catrssimg;
		 $customcatlist ='';
		 $customcats=  get_categories();
		 foreach($customcats as $customcat) {
		 	$customcatlist = '<li><a title="Subscribe to the '.$customcat->name.' news feed" href="'.home_url().'/category/'.$customcat->category_nicename.'/feed/"><img src="'.$catrssurl.'" alt="feed" /></a><a href="'.home_url().'/category/'.$customcat->category_nicename.'/">'.$customcat->name.'</a> ('.$customcat->count.')</li>';
			echo $customcatlist;
		 }
		?>

	</ul>
</div>
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
<span class="showhide">Click to <span style="color:#5588aa;" onclick="document.getElementById('tax02').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('tax02').style.display='none';">hide</span>
</span>
<br /><br />
<div id="tax02" style="display:none;">
	<ul class="leftcolcatlist">

	<?php
		 $tagrssimg = "/images/rss.png";
		 $tagrssurl = get_template_directory_uri() . $tagrssimg;
		 $customtaglist ='';
		 $customtags =  get_tags();
		 foreach($customtags as $customtag) {
		 	$customtaglist = '<li><a title="Subscribe to the '.$customtag->name.' feed" href="'.home_url().'/tag/'.$customtag->slug.'/feed/"><img src="'.$tagrssurl.'" alt="feed" /></a><a href="'.home_url().'/tag/'.$customtag->slug.'/">'.$customtag->name.'</a> ('.$customtag->count.')</li>';
			echo $customtaglist;
		 } 
	?>
	</ul>

</div>
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
 * Define Linkroll By Cat Custom Widget 
 * 
 * @since	WordPress 2.8
 */
class oenology_widget_linkrollbycat extends WP_Widget {

    function oenology_widget_linkrollbycat() {
        $widget_ops = array('classname' => 'oenology-widget-linkrollbycat', 'description' => 'oenology theme widget to display linkroll by category' );
        $this->WP_Widget('oenology_linkrollbycat', 'oenology Links By Cat', $widget_ops);
    }

    function widget( $args, $instance ) {
	
        extract($args);
        $title = apply_filters('widget_title', empty($instance['title']) ? 'oenology Links By Cat' : $instance['title']);
	$defaultview = isset($instance['defaultView']) && $instance['defaultview'] == true  ? 'inline' : 'none'; 
	$show_description = isset($instance['description']) ? $instance['description'] : false; 
	$show_name = isset($instance['name']) ? $instance['name'] : false; 
	$show_rating = isset($instance['rating']) ? $instance['rating'] : false; 
	$show_images = isset($instance['images']) ? $instance['images'] : false; 
	$categorize = isset($instance['categorize']) ? $instance['categorize'] : false; 
	$category = isset($instance['category']) ? $instance['category'] : false; 
	$categoryid = $category;
	$bookmarkid = rand();
	$bookmarksexist = get_bookmarks( array( 'category' => $categoryid));

    	if ( $bookmarksexist ) {
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>
<span class="showhide">Click to <span style="color:#5588aa;" onclick="document.getElementById('br<?php echo $categoryid; ?>-<?php echo $bookmarkid; ?>').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('br<?php echo $categoryid; ?>-<?php echo $bookmarkid; ?>').style.display='none';">hide</span>
</span>
<br /><br />
<div id="br<?php echo $categoryid; ?>-<?php echo $bookmarkid; ?>" style="display:<?php echo $defaultview; ?>;">
	<ul>
	<?php 
		wp_list_bookmarks(apply_filters('widget_links_args', array( 
			'title_li' => '', 'title_before' => '', 'title_after' => '', 
			'category_before' => $before_widget, 'category_after' => $after_widget, 
			'show_images' => $show_images, 'show_description' => $show_description, 
			'show_name' => $show_name, 'show_rating' => $show_rating, 
			'categorize' =>  $categorize, 'category' => $category, 
			'class' => 'linkcat widget' 
		))); 

	?>
	</ul>
</div>

<?php
			echo $after_widget;
		}
    }

    function update( $new_instance, $old_instance ) {
        $new_instance = (array) $new_instance; 
		$instance = array( 'defaultview' => 0, 'images' => 0, 'name' => 0, 'description' => 0, 'rating' => 0); 
			foreach ( $instance as $field => $val ) { 
				if ( isset($new_instance[$field]) ) 
					$instance[$field] = 1; 
			} 
			$instance['title'] = strip_tags( stripslashes( $new_instance['title'] ) );
			$instance['category'] = intval($new_instance['category']); 
			
        return $instance;
    }

    function form( $instance ) {
		$defaults = array( 'defaultview' => 'false' );
        $instance = wp_parse_args( (array) $instance, array( 
		'title' => '' , 
		'defaultview' => 'false' , 
		'category' => '' , 
		'images' => 'false' , 
		'name' => 'false' , 
		'description' => 'false' , 
		'rating' => 'false'
		) 
	  );
        $title = strip_tags($instance['title']);
?>
           	 <p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Bookmark Category:</label>
			<select id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>" class="widefat" style="width:100%;">
			<?php $link_cats = get_terms( 'link_category'); ?>
			<?php foreach ( $link_cats as $link_cat ) : ?>
				<option <?php if ( $link_cat->term_id == $instance['category'] ) echo 'selected="selected"'; ?> value="<?php echo $link_cat->term_id; ?>"><?php echo $link_cat->name; ?></option>
			<?php endforeach; ?>
			</select>
		</p>
           	 <p>
			<input class="checkbox" type="checkbox" <?php checked($instance['defaultview'], true) ?> id="<?php echo $this->get_field_id('defaultview'); ?>" name="<?php echo $this->get_field_name('defaultview'); ?>" /> 
			<label for="<?php echo $this->get_field_id('defaultview'); ?>"><?php _e('View Inline (Unchecked: Hidden)', 'oenology'); ?></label><br /> 
           	 </p>
		<p> 
			<input class="checkbox" type="checkbox" <?php checked($instance['images'], true) ?> id="<?php echo $this->get_field_id('images'); ?>" name="<?php echo $this->get_field_name('images'); ?>" /> 
			<label for="<?php echo $this->get_field_id('images'); ?>"><?php _e('Show Link Image', 'oenology'); ?></label><br /> 
			<input class="checkbox" type="checkbox" <?php checked($instance['name'], true) ?> id="<?php echo $this->get_field_id('name'); ?>" name="<?php echo $this->get_field_name('name'); ?>" /> 
			<label for="<?php echo $this->get_field_id('name'); ?>"><?php _e('Show Link Name', 'oenology'); ?></label><br /> 
			<input class="checkbox" type="checkbox" <?php checked($instance['description'], true) ?> id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" /> 
			<label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Show Link Description', 'oenology'); ?></label><br /> 
			<input class="checkbox" type="checkbox" <?php checked($instance['rating'], true) ?> id="<?php echo $this->get_field_id('rating'); ?>" name="<?php echo $this->get_field_name('rating'); ?>" /> 
			<label for="<?php echo $this->get_field_id('rating'); ?>"><?php _e('Show Link Rating', 'oenology'); ?></label> 
		</p> 

<?php
    }
} 

/**
 * Define Post Formats Custom Widget 
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
<span class="showhide">Click to <span style="color:#5588aa;" onclick="document.getElementById('tax03').style.display='inline';">view</span> / <span style="color:#5588aa;" onclick="document.getElementById('tax03').style.display='none';">hide</span>
</span>
<br /><br />
<div id="tax03" style="display:none;">
	<ul class="leftcolcatlist">

		<?php
		 $postformatrssimg = "/images/rss.png";
		 $postformatrssurl = get_template_directory_uri() . $postformatrssimg;
		 $postformatterms = get_terms( 'post_format' );
		 foreach( $postformatterms as $term ) {
			$termslug = substr( $term->slug, 12 );
			$termname = $term->name;
			$termlink = get_post_format_link( $termslug );
			$termcount = $term->count;
		 	$postformatlist = '<li><a title="Subscribe to the '. $termname .' news feed" href="' . $termlink .'feed/"><img src="'.$postformatrssurl.'" alt="feed" /></a><a href="'. $termlink .'">' . $termname . '</a> (' . $termcount . ')</li>';
			echo $postformatlist;
		 }
		?>

	</ul>
</div>
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
	register_widget( 'oenology_widget_recentposts' );
	unregister_widget('WP_Widget_Recent_Posts');
	register_widget( 'oenology_widget_archives' );
	unregister_widget('WP_Widget_Archives');
	register_widget( 'oenology_widget_categories' );
	unregister_widget('WP_Widget_Categories');
	register_widget( 'oenology_widget_tags' );
	register_widget( 'oenology_widget_linkrollbycat' );
	unregister_widget('WP_Widget_Links');
	register_widget( 'oenology_widget_post_formats' );
}
?>