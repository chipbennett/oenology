<?php
/*
Template Name: Main Navigation Bar
*/
?>

<?php 
	if ( has_nav_menu( 'nav-header' ) ) { // If a nav menu named 'nav-header' is configured, output it
		wp_nav_menu( array( 
			'container' => '',
			'container_class' => 'nav-header', 
			'menu_id' => 'nav', 
			'menu_class' => 'nav-header', 
			'fallback_cb' => '', 
			'depth' => 1, 
			'theme_location' => 'nav-header' 
		) ); 
		} else { // otherwise, output the top-level hierarchy list of pages ?>
			<ul id="nav" class="navmenu">
				<?php if ( get_option( 'show_on_front' ) == 'posts' ) { // if posts, and not a static page, are being used as the site home page, display a link to HOME ?>
					<li><a id="navhome" href="<?php echo home_url(); ?>">Home</a></li>
				<?php }
				wp_list_pages('depth=1&sort_column=menu_order&title_li='); 
				// depth=1 indicates that only the top-level hierarchy of pages (i.e. no child pages) will be displayed
				// sort_column=menu_order indicates that the pages will be sorted as defined by the user in the Pages administration panel
				// title_li= (blank) indicates that the list will not be wrapped in <ul> tags, and the <li> tags will not be given a title
				// NOTE: list items are set to overflow:hidden. Long page titles will be cut off, but the full Page Title will display in the tooltip ?>
			</ul>
		<?php }
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
get_option()
----------------------------------
get_option() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_option

get_option() is used to return the value of a specified database option.
If the option does not exist or has no value, the function returns FALSE.

get_option( $show, $default ) accepts two arguments
 - $show: the database option for which to return a value
     - See this Codex reference for full list of options: http://codex.wordpress.org/Option_Reference
 - $default: the value to return if the option does not exist, or has no value. Default is FALSE

Example:
if ( get_option( 'show_on_front' ) == 'posts' ) returns TRUE if the "Show On Front" option is set to display blog posts, and
returns FALSE if the "Show On Front" option is set to display a static page

***********************
has_nav_menu()
----------------------------------
has_nav_menu() is a WordPress template conditional tag.
Codex reference: N/A

has_nav_menu( $menu ) is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a nav_menu named $menu has been configured by the user; otherwise it returns false.

has_nav_menu() is useful for defining a fallback option for a navigation menu, in case the
user does not define a particular nav menu in the Menus administration panel.

***********************
home_url()
----------------------------------
home_url() is a WordPress function
Codex reference: http://codex.wordpress.org/Function_Reference/home_url

home_url() is used to return the home URL (the 'home' option), using the appropriate protocol 
(http or https), based on value of is_ssl().

home_url() accepts no arguments.

Example:
home_url(); returns e.g. "http://www.domain.tld"

***********************
wp_list_pages()
----------------------------------
wp_list_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_pages

wp_list_pages() is used to output a list of pages (as links). This function is
extremely powerful,  with several available arguments, including depth of
hierarchy to display, pages (or hierarchies) to include/exclude, display order
(ascending/descending/menu order).

To see the full list of arguments for wp_list_pages(), see the Codex.

***********************
wp_nav_menu()
----------------------------------
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_nav_menu

wp_nav_menu( $menu ) is used to output a nav menu named $menu. This menu must be configured
in the Menus administration panel.

wp_nav_menu() (note: no argument for a specific menu) is used to output the default nav menu. This
menu must be configured in the Menus administration panel.

=============================================================================	
*/
	?>