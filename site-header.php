<?php 
/*
Site header content (main navigation menu, blog title, and description) is contained within div#header. 
This content is the same for all primary template page types (index.php, single.php, archive.php, page.php). 
*/ 
?>

<?php 
global $oenology_options;
if ( 'above' == $oenology_options['header_nav_menu_position'] ) {
	get_template_part('site-navigation');  // site-navigation.php contains the main navigation menu. 
}
?>

<div><?php bloginfo('name'); // Displays the blog name, as defined on the General Settings page in the administration panel ?></div>
<p><?php bloginfo('description'); // Displays the blog description, as defined on the General Settings page in the administration panel ?></p>

<?php 
$oenology_options = get_option( 'theme_oenology_options' );
if ( 'below' == $oenology_options['header_nav_menu_position'] ) { 
	get_template_part('site-navigation');  // site-navigation.php contains the main navigation menu. ?
}
?>

<?php /*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
bloginfo()
----------------------------------
bloginfo() is a WordPress template tag.  
Codex reference: http://codex.wordpress.org/Bloginfo

bloginfo() can be used to print several useful WordPress-related parameters. For example:

	description =  (blog description, as defined on the General Settings page in the administration panel)
	name =  (blog name, as defined on the General Settings page in the administration panel)
	
For the full list of parameters returned by bloginfo(), see the Codex.

bloginfo() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.

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

=============================================================================	
*/ ?>