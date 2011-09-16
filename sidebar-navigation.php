<?php
/**
 * Sidebar Navigation Template Part
 * 
 * Template part file that contains the sidebar navigation 
 * menu. 
 * 
 * By default, this sidebar navigation will output
 * the descendant menu to the current top-level static 
 * Page, and will output up to three additional levels
 *  of Page hierarchy. The default menu is incredibly
 * flexible and powerful, because it updates dynamically
 * whenever the user changes Page hierarchy, by adding
 * or removing Pages, or by changing the child-parent
 * relationship for Pages.
 * 
 * However, users can override this menu output by 
 * creating a custom navigation menu, and assigning it 
 * to the 'nav-sidebar' Theme location.
 *
 * This file is called by static Pages
 * 
 * @link		http://codex.wordpress.org/Function_Reference/has_nav_menu 		has_nav_menu()
 * @link		http://codex.wordpress.org/Function_Reference/wp_list_pages 	wp_list_pages()
 * @link		http://codex.wordpress.org/Function_Reference/wp_nav_menu 		wp_nav_menu()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.0
 */
?>
<!-- Page Subnavigation Menu -->
<?php
/**
 * Output the sidebar navigation menu
 * 
 * If the user has defined a custom navigation menu
 * and has applied that menu to the 'nav-sidebar'
 * theme location, then output that menu. Otherwise,
 * output a list of Pages.
 * 
 * The menu displays the descendant menu to the 
 * current top-level static Page, and will output 
 * up to three additional levels of Page hierarchy.
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
has_nav_menu( 'nav-sidebar' ) 
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
		// apply 'id="subnav"' to the <ul> tag that 
		// contains the menu
		'menu_id' => 'subnav', 
		// apply 'class="subnavmenu"' to the <ul> 
		// tag that contains the menu
		'menu_class' => 'subnavmenu', 
		// Use the default fallback if the user has 
		// not applied a menu to the specified theme 
		// location
		'fallback_cb' => '', 
		// Apply four levels hierarchical depth, 
		// i.e. Parent Page plus three levels of
		// descendant Child Pages
		'depth' => 4, 
		// Output the menu the user has applied to
		// the 'nav-sidebar' Theme Location
		'theme_location' => 'nav-sidebar' 
	) ); 
} 
else {  
	/**
	 * Otherwise, if the user has not applied a 
	 * menu to the 'nav-header' Theme location,
	 * output a list of static Pages.
	 */
	?>
	<ul class="subnavmenu">
		<?php 
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
			// Display four levels of Page hierarchy
			// i.e. three levels of child pages)
			'depth' => 4,
			// Sort pages as defined by the user 
			// in the Pages administration panel
			'sort_column' => 'menu_order',
			// Do not wrap list in <ul> tags, and
			// do not give the menu a title <li>
			'title_li' => ''
		) );
		?>
	</ul>
<?php
}