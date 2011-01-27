<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

	<title><?php wp_title('&raquo;', true, 'right'); ?></title>

	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="all" />
	
	<?php
		if ( is_singular() && get_option( 'thread_comments' ) ) { // on single blog post pages with threaded comments
			wp_enqueue_script( 'comment-reply' ); // load the javascript that performs in-link comment reply fanciness
		}
	?>

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
is_singular()
----------------------------------
is_singular() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_singular

is_singular() is a boolean (returns TRUE or FALSE) conditional tag that returns true if any of the following are true:

	is_single() - a single post ("post" post-type, i.e. a single blog post) is displayed
	is_page() - a page ("page" post-type) is displayed
	is_attachment() - an attachment 

***********************
language_attributes()
----------------------------------
language_attributes() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/language_attributes

language_attributes() is added inside the HTML <html> tag, and outputs various HTML
language attributes, such as language and text-direction.

***********************
wp_enqueue_script()
----------------------------------
wp_enqueue_script() is a WordPress filter hook.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script

wp_enqueue_script() is used as a safe way to add JavaScript to displayed pages. WordPress 
maintains a "queue" of javascript files to load when a page is displayed. The wp_enqueue_script()
filter enables a Theme or Plugin to add its own javascript files to this queue. 

Using wp_enqueue_script() facilitates the addition of javascript files only on pages where they
are needed, and will ensure that the same javascript file (e.g. jQuery) is not loaded multiple times.

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