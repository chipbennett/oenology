<?php
/**
 * Site Navigation Template Part
 * 
 * Template part file that contains the site header navigation 
 * menu.
 * 
 * By default, this header navigation will output
 * the list of top-level static Pages, and depending
 * on the 'header_nav_menu_depth' setting, up to two 
 * additional levels of Page hierarchy. The default menu 
 * is incredibly flexible and powerful, because it updates 
 * dynamically whenever the user changes Page hierarchy, 
 * by adding or removing Pages, or by changing the 
 * child-parent relationship for Pages.
 * 
 * However, users can override this menu output by 
 * creating a custom navigation menu, and assigning it 
 * to the 'nav-header' Theme location.
 *
 * This file is called by header.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/get_option 		get_option()
 * @link		http://codex.wordpress.org/Function_Reference/get_permalink 	get_permalink()
 * @link		http://codex.wordpress.org/Function_Reference/has_nav_menu 		has_nav_menu()
 * @link		http://codex.wordpress.org/Function_Reference/home_url 			home_url()
 * @link		http://codex.wordpress.org/Function_Reference/is_front_page 	is_front_page()
 * @link		http://codex.wordpress.org/Function_Reference/is_home 			is_home()
 * @link		http://codex.wordpress.org/Function_Reference/wp_list_pages 	wp_list_pages()
 * @link		http://codex.wordpress.org/Function_Reference/wp_nav_menu 		wp_nav_menu()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 1.0
 */
?>
<?php 
/**
 * Global variable that contains the
 * Theme's options array.
 * 
 * @global array	$oenology_options
 */
global $oenology_options;
/**
 * Output the header navigation menu
 * 
 * If the user has defined a custom navigation menu
 * and has applied that menu to the 'nav-header'
 * theme location, then output that menu. Otherwise,
 * output a list of Pages.
 * 
 * The menu displays only top-level menu items or
 * top-level Pages by default; however, dropdown
 * menus up to an additional two levels of
 * hierarchy can be displayed, using the appropriate
 * Theme setting.
 * 
 * NOTE: list items are set to overflow:hidden. 
 * Long page titles will be cut off, but the full 
 * Page Title will display in the tooltip
 */
if ( 
/**
 * WordPress conditional tag that returns true if
 * the user has applied a custom navigation menu 
 * to the specified theme location
 */
has_nav_menu( 'nav-header' ) 
) {
	/**
	 * Output a custom navigation menu
	 * 
	 * Output a custom navigation menu
	 * according to the parameters
	 * specified by the options array
	 * 
	 * @param	array	options defining menu output
	 */
	wp_nav_menu( array( 
		// apply 'id="nav"' to the <ul> tag that 
		// contains the menu
		'menu_id' => 'nav', 
		// apply 'class="nav-header"' to the <ul> 
		// tag that contains the menu
		'menu_class' => 'nav-header', 
		// Use the default fallback if the user has 
		// not applied a menu to the specified theme 
		// location
		'fallback_cb' => '', 
		// Apply hierarchical depth per the Theme
		// setting 'header_nav_menu_depth'
		'depth' => $oenology_options['header_nav_menu_depth'], 
		// Output the menu the user has applied to
		// the 'nav-header' Theme Location
		'theme_location' => 'nav-header' 
	) ); 
} else { 
	/**
	 * Otherwise, if the user has not applied a 
	 * menu to the 'nav-header' Theme location,
	 * output a list of static Pages.
	 */
	?>
	<ul id="nav" class="nav-header">
		<?php 
		/**
		 * If posts, and not a static page, are being used 
		 * as the site home page, display a link to HOME.
		 */
		if ( 
		/**
		 * Returns true if the Front Page is set to
		 * display the Blog Posts Index
		 */
		'posts' == get_option( 'show_on_front' ) 
		) {  
			$list_pages_exclude = ''; 
			?>
			<li><a id="navhome" href="<?php echo home_url(); ?>">Home</a></li>
			<?php 
		} else {
			// By default, do not exclude any 
			// static Pages
			$list_pages_exclude = '';
			// Determine if a static Page is 
			// currently set to display the 
			// site Front Page
			$page_on_front = ( get_option( 'page_on_front' ) ? get_option( 'page_on_front' ) : false );
			// Determine if a static Page is 
			// currently set to display the 
			// Blog Posts index
			$page_for_posts = ( get_option( 'page_for_posts' ) ? get_option( 'page_for_posts' ) : false );
			// If static Pages are set to
			// display both the Front Page
			// and the Blog Posts Index
			if ( $page_on_front && $page_for_posts ) {
				// Exclude both static Pages from 
				// the 'wp_list_pages()'
				$list_pages_exclude = $page_on_front . ',' . $page_for_posts;
			} 
			// Otherwise, if a static Page
			// is set to display the site
			// Front page
			else if ( $page_on_front ) {
				// Exclude this static Page from 
				// the 'wp_list_pages()'
				$list_pages_exclude = $page_on_front;
			} 
			// Otherwise, if a static Page
			// is set to display the Blog
			// Posts Index
			else if ( $page_for_posts ) {
				// Exclude this static Page from 
				// the 'wp_list_pages()'
				$list_pages_exclude = $page_for_posts;
			} 
			/**
			 * If a static Page is set to display the site
			 * Front Page, output a link to the Front Page
			 */
			if ( $page_on_front ) {
				?>
				<li class="page_item<?php if ( is_front_page() ) echo ' current_page_item'; ?>"><a href="<?php echo home_url(); ?>"><?php echo get_the_title( $page_on_front ); ?></a></li>
				<?php
			}
			/**
			 * If a static Page is set to display the Blog
			 * Posts Index, output a link to the Blog Posts
			 * Index
			 */
			if ( $page_for_posts ) {
				?>
				<li class="page_item<?php if ( is_home() ) echo ' current_page_item'; ?>"><a href="<?php echo get_permalink( $page_for_posts ); ?>"><?php echo get_the_title( $page_for_posts ); ?></a></li>
				<?php
			}
		}
		/**
		 * Output a list of static Pages
		 * 
		 * Output a custom navigation menu
		 * according to the parameters
		 * specified by the options array
		 * 
		 * @param	array	options defining menu output
		 */
		wp_list_pages( array( 
			// Display levels of Page hierarchy (i.e. levels 
			// of child pages) as specified by Theme setting 
			// 'header_nav_menu_depth'
			'depth' => $oenology_options['header_nav_menu_depth'],
			// Sort pages as defined by the user 
			// in the Pages administration panel			
			'sort_column' => 'menu_order', 
			// Do not wrap list in <ul> tags, and
			// do not give the menu a title <li>
			'title_li' => '', 
			// Exclude static Pages used for the Front Page
			// and for the Blog Posts Index, as these are
			// added explicitly already, if they exist
			'exclude' => $list_pages_exclude 
		) ); 
		?>
	</ul>
	<?php
}
?>