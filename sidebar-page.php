<?php
/**
 * Template part file that contains the sidebar content for static Pages
 *
 * This file is called by page.php
 * 
 * @uses		oenology_get_current_page_layout()	Defined in /functions/custom.php
 * 
 * @link		http://codex.wordpress.org/Function_Reference/dynamic_sidebar	dynamic_sidebar()
 * @link		http://codex.wordpress.org/Function_Reference/get_option		get_option()
 * @link		http://codex.wordpress.org/Function_Reference/get_sidebar		get_sidebar()
 * @link		http://codex.wordpress.org/Function_Reference/is_attachment		is_attachment()
 * @link 		http://codex.wordpress.org/Function_Reference/is_front_page		is_front_page()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.0
 */

// Do not display sidebars on attachment pages or posts with 
// format-types "gallery", "image", or "video"
if ( in_array( oenology_get_current_page_layout(), array( 'one-column', 'attachment', 'full' ) ) ) {
	return;
}

// Only output div#leftcol and div#rightcol if
// the current Page is not an Attachment Page
if ( 
// WordPress conditional tag that returns true if
// the current page is an Attachment Page
! is_attachment() 
) { 
	?>
	
	<!-- Begin Left Column (div#leftcol) -->
	<?php
	// div#leftcol contains the left column content of the three-column 
	// layout. For the Blog Posts Index, div#rightcol and div#leftcol both
	// appear to the right of the main content column. For static Pages,
	// including a static Page as Front Page, div#leftcol is to the left, 
	// and div#rightcol is to the right, with div#main in the center.
	// 
	// Includes the 'sidebar-left' dynamic sidebar
	?>
	<div id="leftcol">
		<?php 
		// Calls a sidebar template part file.
		// Used in all primary template pages
		// 
		// Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
		// 
		// Child Themes can replace this template part file globally, 
		// via "sidebar-navigation.php"
		get_sidebar( 'navigation' ); 
		
		//Display the left-column dynamic
		//sidebar, if it is in use
		if ( is_active_sidebar( 'sidebar-left' ) ) {
			dynamic_sidebar( 'sidebar-left' );
		}
		?>
	</div>
	<!-- End Left Column (div#leftcol) -->

	<?php
	global $post;
	if ( 'two-column' != oenology_get_current_page_layout()
	) {
		?>
		<!-- Begin Right Column (div#rightcol) -->
		<?php
		// div#rightcol contains the right column content of the three-column 
		// layout. For the Blog Posts Index, div#rightcol and div#leftcol both
		// appear to the right of the main content column. For static Pages,
		// including a static Page as Front Page, div#leftcol is to the left, 
		// and div#rightcol is to the right, with div#main in the center.
		// 
		// Includes the 'sidebar-right' dynamic sidebar
		?>
		<div id="rightcol">
			<!-- Begin Right Column Widget Area-->
			<?php 
			// Display default sidebar content if the following conditions are true:
			//  - Dynamic sidebar 'sidebar-right' is not active, AND
			//  - A static Page as Front Page is not being displayed
			if ( 
			   // WordPress conditional tag that returns true if the 
			   // specified dynamic sidebar is active
			   ! dynamic_sidebar( 'sidebar-right' ) 
			&& ! ( 
				   // WordPress conditional tag that returns true if the 
				   // current page is the Front Page
					  is_front_page() 
				   // Returns true if the Front Page is set to display a 
				   // static Page
				   && 'page' == get_option('show_on_front') ) 
			) {
				// Calls a sidebar template part file.
				// Used in all primary template pages.
				//
				// Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar
				// 
				// Child Themes can replace this template part file globally, 
				// via "sidebar-right.php"
				get_sidebar( 'right' ); 
			} 
			?>
			<!-- End Right Column Widget Area -->
		</div>
		<!-- End Right Column (div#rightcol) -->
		<?php 
	}
}
?>