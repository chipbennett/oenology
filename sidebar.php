<?php
/**
 * Template part file that contains the default sidebar content
 *
 * This file is called by all primary template pages
 * 
 * @uses		dynamic_sidebar()
 * @uses		get_bloginfo()
 * @uses		get_option()
 * @uses		get_sidebar()
 * @uses		has_post_format()
 * @uses		is_active_sidebar()
 * @uses		is_attachment()
 * @uses 		is_front_page()
 * @uses		is_single()
 * 
 * @package 	Oenology
 * @copyright	Copyright (c) 2010, Chip Bennett
 * @license		http://www.gnu.org/licenses/old-licenses/gpl-2.0.html GNU General Public License, v2 (or newer)
 *
 * @since 		Oenology 2.0
 */
?>
<?php 
// Globalize the variable that contains the
// Theme's options array.
global $oenology_options;

// Do not display sidebars on attachment pages or posts with 
// format-type "image"
if ( 
	// WordPress conditional tag that returns true if the 
	// current page is an Attachment Page
   ! is_attachment() 
   && ! ( 
		 // WordPress conditional tag that returns true if the
		 // current page is a Single Blog Post Page
         is_single() 
		 // WordPress conditional tag that returns true if a
		 // Post on the current page has the specified Post 
		 // Format taxonomy term assigned.
	  && has_post_format( 'image' ) 
   ) 
) { 
	// Only display div#doublecoltop if dynamic sidebar 
	// 'sidebar-column-top is active, or if the Theme is 
	// set to display social icons
	if ( 
	   // WordPress conditional tag that returns true if the 
	   // specified dynamic sidebar is active (has Widgets
	   // assigned to it)
	   ( is_active_sidebar( 'sidebar-column-top' ) 
	   // Boolean Theme option
	|| $oenology_options['display_social_icons'] )
	&& ( ! is_single() || 'three-column' != $oenology_options['single_post_layout'] )
	&& ( ( ! is_home() && ! is_archive() && ! is_search() && ! is_404() ) || 'three-column' != $oenology_options['post_index_layout'] )
	) { 
		?>
		<?php
		// div#doublecoltop is the top, right-colum content in the two-column
		// layout. It displays only on static Pages, including static Page as
		// Front Page, and is a double-width column, and displays above the 
		// single-width columns div#leftcol and div#rightcol.
		// 
		// Includes social icons, and the 'sidebar-column-top' dynamic sidebar,
		// and displays only if this dynamic sidebar is active (has Widgets 
		// assigned to it), or if the Theme is set to display social icons.
		?>
		<div id="doublecoltop">
		<?php
		// If Theme option is set to display social icons
		if ( $oenology_options['display_social_icons'] ) {
			?>
			<div class="sidebar-social-icons">
			<?php
			// Obtain the list of valid social networks
			$socialprofiles = oenology_get_social_networks();
			// Loop through each social network
			foreach ( $socialprofiles as $profile ) {
				// holds the profile name for the currentsocial network
				$profilename = $profile['name'] . '_profile';
				// if the user has provided a profile name
				// for the current social network
				if ( ! empty( $oenology_options[$profilename] ) ) { 
					// holds the base URL for the current social network
					$baseurl = $profile['baseurl'];
					// build the full URL, including base URL and profile name
					$profileurl = $baseurl . '/' . $oenology_options[$profilename];
					// Output the fully formed social network profile link
					?>
					<a class="sidebar-social-icon" href="<?php echo $profileurl; ?>" title="<?php echo $profile['title']; ?>">
						<?php echo $profile['title']; ?>
					</a>
				<?php 
				}
			}
			// If the user has not set the RSS feed icon not to display
			if ( 'none' != $oenology_options['rss_feed'] ) {
				// holds the WordPress bloginfo() argument name 
				// for the user-selected RSS feed type
				$rssarg = $oenology_options['rss_feed'] . '_url';
				// holds the WordPress-defined URL for the
				// user-selected RSS feed type
				$rssurl = get_bloginfo( $rssarg ); 
				// Output the fully formed RSS feed link
				?>
				<a class="sidebar-social-icon" href="<?php echo $rssurl; ?>" title="RSS">RSS</a>
			<?php 
			}
			?>
			</div>
			<?php	
		} 
		?>
		<!-- Begin Sidebar Top Widget Area-->
		<?php 
		// Output a dynamic sidebar
		// 
		// Codex reference: {@link http://codex.wordpress.org/Function_Reference/dynamic_sidebar}
		// 
		// Outputs the specified dynamic sidebar. A dynamic sidebar 
		// is used to output Widgets as specified by the user.
		dynamic_sidebar( 'sidebar-column-top' );
		?>
		<!-- End Sidebar Top Widget Area-->
		</div>
		<?php 
	} 
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
	<!-- Begin Left Column Widget Area-->
		<?php 
		// Display default sidebar content if the following conditions are true:
		//  - Dynamic sidebar 'sidebar-right' is not active, AND
		//  - A static Page as Front Page is not being displayed
		if ( 
		// WordPress conditional tag that returns true if the 
		// specified dynamic sidebar is active
		! dynamic_sidebar( 'sidebar-left' ) 
		&& ! ( 
			// WordPress conditional tag that returns true if 
			// the current page is the Front Page
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
			// via "sidebar-left.php"
			get_sidebar( 'left' ); 
		} 
		?>
		<!-- End Left Column Widget Area-->
	</div>
	<!-- End Left Column (div#leftcol) -->

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
	if ( 
	// WordPress conditional tag that returns true if the 
	// specified dynamic sidebar is active (has Widgets
	// assigned to it)
	   is_active_sidebar( 'sidebar-column-bottom' ) 
	&& ( ! is_single() || 'three-column' != $oenology_options['single_post_layout'] )
	&& ( ( ! is_home() && ! is_archive() && ! is_search() && ! is_404() ) || 'three-column' != $oenology_options['post_index_layout'] )
	) { 
		// div#doublecolbottom is the bottom, right-colum content in the two-column
		// layout. It displays only on static Pages, including static Page as
		// Front Page, and is a double-width column, and displays above the 
		// single-width columns div#leftcol and div#rightcol.
		// 
		// Includes sthe 'sidebar-column-bottom' dynamic sidebar, and displays only
		// if this sidebar is active (has Widgets assigned to it).
		?>
		<div id="doublecolbottom">
			<!-- Begin Sidebar Bottom Widget Area-->
			<?php 
			// Output a dynamic sidebar
			// 
			// Codex reference: {@link http://codex.wordpress.org/Function_Reference/dynamic_sidebar}
			// 
			// Outputs the specified dynamic sidebar. A dynamic sidebar 
			// is used to output Widgets as specified by the user.
			dynamic_sidebar( 'sidebar-column-bottom' ); 
			?>
			<!-- End Sidebar Bottom Widget Area-->
		</div>		
		<?php 
	} 
} 
?>