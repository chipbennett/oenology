<?php
/*
Template Name: 404 Page
*/
get_header();  // MUST come first. Calls the header PHP file. Used in all primary template page types (index.php, single.php, archive.php, search.php, page.php) ?>

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
		
			<div <?php post_class(); ?>>	 
			
				<div class="post-title">
					<h1>Don't Panic</h1>				
				</div>
				
				<div class="post-entry">
					<p>Oh no, not again.</p>
					<p>Well, this is weird. The post, page, or file you requested could not be found. The best laid plans of mice, and all that. Those who study the complex interplay of cause and effect in the history of the Universe say that this sort of thing is going on all the time. </p>
					<p>I apologize for the inconvenience.</p>
					<?php 
						if ( function_exists( 'oenology_404_handler') ) {
							oenology_404_handler();
						}
					?>				
				</div>

			</div>
			
		</div>
		<!-- End Main (div#main) -->

		<!-- Begin Left Column (div#leftcol) -->
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
		<!-- End Right Column (div#rightcol) -->

	</div>
	<!-- End Content  (div#content)-->

<div id="container" style="clear:both;">&nbsp;</div>
	
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
function_exists()
----------------------------------
function_exists() is a boolean (returns TRUE or FALSE) conditional PHP function.
Codex reference: N/A

function_exists( 'foo' ) returns TRUE if a function named foo() is found; otherwise, it returns FALSE.

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
oenology_404_handler()
----------------------------------
oenology_404_handler() is a custom Theme function.
Codex reference: N/A

oenology_404_handler() is used to generate suggested site content when a user is sent to
the 404 page due to a server 404 "file not found" error.

oenology_404_handler() is defined in functions.php.

***********************
post_class()
----------------------------------
post_class() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/post_class

post_class() is added inside the HTML <div> or <span> tag that contains the post, 
and outputs various CSS class declarations, depending on which post is currently 
being displayed.

For the full list of CSS classes returned by post_class(), see the Codex.

***********************
wp_footer()
----------------------------------
wp_footer() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer

wp_footer() is used by themes/plugins, usually to insert content into the WordPress Theme footer.

=============================================================================	
*/ ?>