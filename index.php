<?php get_header();  // MUST come first. Calls the header PHP file. Used in all primary template page types (index.php, single.php, archive.php, search.php, page.php) ?>

<body id="home" <?php body_class(); ?>> 

<!-- Begin Extent (div#extent) -->
<div id="extent"> 
<?php 
	/*
	All displayed content (including the footer) is contained within div#extent, for which width and position are set via CSS.
	*/ 
?>

	<!-- Begin Header  (div#header)-->
	<div id="header"> 
		<!-- Begin Blog Head -->
		<?php get_template_part('site-header'); // site-header.php contains the Main Navigation Menu, Blog Title and Blog description. ?>
		<!-- End Blog Head -->

	</div>
	<!-- End Header (div#header) -->
	
	<?php get_template_part('infobar'); // infobar.php contains the location/breadcrumb/login/search bar. ?>

	<!-- Begin Content (div#content) -->
	<div id="content">
	<?php 
		/*
		Main blog content (left column, center column, right column) is contained within div#content.
		*/ 
	?>

		<!-- Begin Main (div#main) -->
		<div id="main">
		<?php 
			/*
			div#main contains the center column content of the three-column layout. Generally, the center column contains the main content of the page (blog post/posts, 
			page content, search results, etc.).
			*/ 
			get_template_part('loop'); 
			/* 
				loop.php is the center column content for all primary template page types (index.php, single.php, archive.php, search.php, page.php), and contains
			    the WordPress "loop".  For other non-WordPress pages (or any page not containing the "loop", the site structure can be kept consistent by replacing "loop.php"
				with whatever file is desired.
			*/ 
		?>
		</div>
		<!-- End Main (div#main) -->

		<!-- Begin Left Column (div#leftcol) -->
		<?php if ( is_home() || ( is_single() && ! is_attachment() && ! has_post_format( 'image' ) ) || is_archive() ) { ?>
		
		<?php if ( is_active_sidebar( 'sidebar-column-top' ) || oenology_display_sidebar_icons() ) { ?>
		
		<div id="doublecoltop">
			
		<?php
		$oenology_options = get_option( 'theme_oenology_options' );
		$socialprofiles = oenology_get_social_networks();
		foreach ( $socialprofiles as $profile ) {
			$profilename = $profile['slug'] . '_profile';
			$display = 'display_' . $profilename;
			if ( $oenology_options[$display] && ! empty( $oenology_options[$profilename] ) ) { 
				$baseurl = $profile['baseurl'];
				$profileurl = $baseurl . '/' . $oenology_options[$profilename]; ?>
				<a class="sidebar-social-icon" href="<?php echo $profileurl; ?>" title="<?php echo $profile['name']; ?>">
				<?php echo $profile['name']; ?>
				</a>
			<?php }
		}
		if ( $oenology_options['display_rss_feed'] ) {
			$rssarg = $oenology_options['rss_feed'] . '_url';
			$rssurl = get_bloginfo( $rssarg );
			?>
			<a class="sidebar-social-icon" href="<?php echo $rssurl; ?>" title="RSS">
			RSS
			</a>
		<?php } ?>
		
			<?php get_sidebar( 'column-top' ); ?>
		</div>
		
		<?php } ?>
		
		<div id="leftcol">
		<?php 
			/*
			div#leftcol contains the left column content of the three-column layout. 
			*/ 
			get_sidebar('left'); 
				/*
				sidebar-left.php is the left column content. Used in all primary template page types (index.php, single.php, archive.php, search.php, page.php)
				For index.php, sidebar-left and sidebar-right both appear to the right of the main content column.
				For page.php, sidebar-left is to the left, and sidebar-right is to the right, with the main content column in the center.
				*/ 
		?>
		</div>
		<!-- End Left Column (div#leftcol) -->

		<!-- Begin Right Column (div#rightcol) -->
		<div id="rightcol">
		<?php 
			/*
			div#rightcol contains the right column content of the three-column layout.
			*/ 
			get_sidebar('right'); 
				/*
				sidebar-right.php is the right column content. Used in all primary template page types (index.php, single.php, archive.php, search.php, page.php)
				For index.php, sidebar-left and sidebar-right both appear to the right of the main content column.
				For page.php, sidebar-left is to the left, and sidebar-right is to the right, with the main content column in the center.
				*/
			?>
		</div>
		
		<?php if ( is_active_sidebar( 'sidebar-column-bottom' ) ) { ?>
		
		<div id="doublecolbottom">
		
		</div>
		
			<?php get_sidebar( 'column-bottom' ); ?>
		
		<?php } ?>
		<!-- End Right Column (div#rightcol) -->
		<?php } ?>

	</div>
	<!-- End Content  (div#content)-->
	
<!-- Begin Footer (div#footer) -->
<div id="footer">
	<?php get_footer(); // Used in all primary template page types (index.php, single.php, archive.php, search.php, page.php) ?>
</div>
<!-- End Footer (div#footer) -->

</div>
<!-- End Extent (div#extent) -->

<?php wp_footer(); ?>
</body>
</html>
<?php /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
body_class()
----------------------------------
body_class() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/body_class

body_class() is added inside the HTML <body> tag, and outputs various CSS class
declarations, depending on which page is currently being displayed.

For the full list of CSS classes returned by body_class(), see the Codex.

***********************
get_footer()
----------------------------------
get_footer() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_footer

get_footer() is used to include the footer Theme template file (footer.php) within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_footer( $foo ) will attempt to include footer-foo.php. If it doesn't exist, the default footer.php will be used.

***********************
get_header()
----------------------------------
get_header() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_header

get_template_part() is used to include the header Theme template file (header.php) within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_header( $foo ) will attempt to include header-foo.php. If it doesn't exist, the default header.php will be used.

***********************
get_sidebar()
----------------------------------
get_sidebar() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_sidebar

get_sidebar() is used to include a sidebar template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_sidebar( $name ) will attempt to include sidebar-name.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's sidebar-name.php
 - the Theme's sidebar.php
 - the parent Theme's sidebar-name.php
 - the parent Theme's sidebar.php

get_sidebar() with no argument passed will attempt to include sidebar.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's sidebar.php
 - the parent Theme's sidebar.php

***********************
get_template_part()
----------------------------------
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_template_part

get_template_part() is used to include a Theme template file within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_template_part( $file ) will attempt to include file.php. The function will attempt to 
include files in the following order, until it finds one that exists:
 - the Theme's file.php
 - the parent theme's file.php

get_template_part( $file , $foo ) will attempt to include file-foo.php. The function will
attempt to include files in the following order, until it finds one that exists:
 - the Theme's file-foo.php
 - the Theme's file.php
 - the parent theme's file-foo.php
 - the parent theme-s file.php

***********************
wp_footer()
----------------------------------
wp_footer() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer

wp_footer() is used by themes/plugins, usually to insert content into the WordPress Theme footer.

=============================================================================	
*/ ?>