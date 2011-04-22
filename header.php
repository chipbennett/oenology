<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&raquo;', true, 'right'); ?></title>

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />

	<?php wp_head(); ?>
</head>

<!-- End HTML Header -->

<?php
global $oenology_options;
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
bloginfo()
----------------------------------
bloginfo() is a WordPress template tag.  
Codex reference: http://codex.wordpress.org/Bloginfo

bloginfo() can be used to print several useful WordPress-related parameters. For example:

	charset = (character set defined for the blog (see wp-config.php); usually UTF-8)
	html_type =  (HTML type, as defined on the General Settings page in the administration panel. Usually "text/html")
	
For the full list of parameters returned by bloginfo(), see the Codex.

bloginfo() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.
	
***********************
get_option()
----------------------------------
get_option() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_option

get_option( $option ) is used to return the value for a defined option in the 
WordPress wp-options database table. If the option does not exist, get_option()
returns 'false'.

get_option() returns, but does not print (output/display) the value requested. To 
print this value, use 'echo get_option()'.
	
***********************
get_stylesheet_uri()
----------------------------------
get_stylesheet_uri() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_stylesheet_uri

get_stylesheet_uri() is used to get the value for the URI of the Theme
style sheet (style.css).

get_stylesheet_uri() accepts no arguments.

get_option() returns, but does not print (output/display) the value requested. To 
print this value, use 'echo get_option()'.

Example:
<?php echo get_stylesheet_uri(); ?> returns e.g. "http://www.mydomain.tld/wp-content/themes/my-theme/style.css"

***********************
language_attributes()
----------------------------------
language_attributes() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/language_attributes

language_attributes() is added inside the HTML <html> tag, and outputs various HTML
language attributes, such as language and text-direction.

***********************
wp_head()
----------------------------------
wp_head() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Hook_Reference/wp_head

wp_head() is used by themes/plugins, usually to insert content into the HTML <head>.

***********************
wp_title
----------------------------------
wp_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/wp_title
	
wp_title() is a WordPress template tag used to display the title of a page:

	(Post Name for single.php, Date for date-based archive, Category for category archive, etc.)


=============================================================================	
*/ ?>