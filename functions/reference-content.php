<?php 

/* Load Settings Page Tab Content
*******************************************************************************************/

global $pagenow;
if ( 'themes.php' == $pagenow && isset( $_GET['page'] ) && 'oenology-reference' == $_GET['page'] ) :
    if ( isset ( $_GET['tab'] ) ) :
        $tab = $_GET['tab'];
    else:
        $tab = 'general';
    endif;
    switch ( $tab ) :
        case 'general' :
            oenology_reference_page_general();
            break;
        case 'faq' :
            oenology_reference_page_faq();
            break;
        case 'coderef' :
            oenology_reference_page_coderef();
            break;
        case 'changelog' :
            oenology_reference_page_changelog();
            break;
    endswitch;
endif;


/* Reference Page Tab Content
*******************************************************************************************/

// Changelog Tab
function oenology_reference_page_changelog() { ?>
	
	<h3>1.1 [2011.02.DD]</h3>
	<p>Update Release</p>
	<ol>
	<li>New Features:
		<ol>
		<li>Added support for Post Formats (introduced in WordPress 3.1)</li>
		<li>Added basic Theme options: Header Navigation Menu Position, disabled-by-default footer credit link</li>
		<li>Added Theme color schemes ("Varietals"): Syrah, Seyval Blanc</li>
		</ol>
	</li>
	<li>Maintenance/Bugfixes:
		<ol>
		<li>Added check to ensure TwentyTen header images are registered only if TwentyTen is installed</li>
		<li>Minor tweak/bugfix to ensure floats are cleared properly on paginated posts</li>
		<li>Minor tweaks to comments.php</li>
		</ol>
	</li>
	</ol>

	<h3>1.0 [2010.12.08]</h3>
	<p>Maintenance Release</p>
	<ol>
	<li>Moved all CSS declarations into style.css, and eliminated @import calls</li>
	<li>Cleaned up un-needed CSS files in css\ and css\fonts\ directories; removed css\fonts\ directory.</li>
	<li>Fixed a few minor bugs</li>
	<li>Added Prev/Next page navigation in Loop Footer, to match Infobar navigation</li>
	<li>Added default Widgets to appear in each sidebar if no widgets are defined by the user</li>
	<li>Finished adding inline documentation for all functions used in the Theme, including functions.php</li>
	<li>Added default "(Untitled)" text to appear in place of Title for Posts without a defined Post Title</li>
	<li>Removed translation strings. Internationalization will be added in a later revision.</li>
	</ol>

	<h3>0.9.2 [2010.11.04]</h3>
	<p>Minor BugFix release</p>
	<ol>
	<li>Fixed divide-by-zero PHP notice generated on the attachment page when the image metadata indicates 
	a shutter speed of zero.</li>
	<li>Fixed minor CSS image dimension bug</li>
	<li>Updated Theme tags</li>
	</ol>

	<h3>0.9.1 [2010.09.24]</h3>
	<p>Initial Release.</p>
	
<?php }

// Changelog Tab
function oenology_reference_page_general() { ?>
	
	<h3>Menu Functionality</h3>

	<p>The Theme fully supports WordPress core Navigation Menu functionality. The main site navigation menu 
	is called "Header Navigation", and the left sidebar page navigation is called "Sidebar Navigation".</p>

	<p>The Header Navigation menu can optionally be set to display either above or below the Site Title and 
	Description. By default, the Header Navigation menu displays above the Site Title/Description. To change 
	this setting, see Appearance -> Oenology Options.</p>

	<p>The Theme defaults to using wp_list_pages() for these menus, which means that you do not have to create 
	your own menus. With the Theme-default functionality, any time you add pages, they will automatically appear 
	in the menus.</p>

	<p>The Header Navigation menu shows only top-level Pages. The Sidebar Navigation shows up to four levels of 
	Child Pages, and shows the current Page and its Child Pages. Second-level Child Pages show from the first level, 
	third-level Child Pages show from the second level, and fourth-level Child Pages show from the third level.</p>

	<p>Menus are displayed as lists, with each list item being a link displaying a Page Title. The list items are 
	styled so that overly long Page Titles will not break the layout. Long Page Titles will be cut off, and the full 
	Page Title will appear in the tooltip when hovering over the link.</p>

	<h3>Post Thumbnail Functionality</h3>

	<p>The Theme fully supports WordPress core Post Thumbnail functionality. By default, Post Thumbnails will appear 
	in the Post Title for Archive, Taxonomy (Category/Tag), and Search pages.</p>

	<h3>Custom Header Image Functionality</h3>

	<p>The Theme fully supports WordPress core Custom Header Image functionality. The Theme is configured to make the 
	TwentyTen header images available if TwentyTen is installed. Custom images will be cropped to 1000x198px when uploaded.</p>

	<h3>Custom Background Functionality</h3>

	<p>The Theme fully supports WordPress core Custom Background functionality. Background image or color is applied to 
	the BODY tag, and will appear outside the Theme content.</p>

	<h3>Post Formats Functionality</h3>

	<p>The Theme fully supports WordPress core Post Formats functionality. Custom layout and style are applied for each of 
	the core Post Format types: Aside, Audio, Chat, Gallery, Image, Link, Status, and Video. Post Format archive pages are 
	linked in the post footer of each post that uses a Post Format other than "standard". Also, the Theme includes a custom 
	Widget to display a list of Post Format types, similar to the Category list or Tag list.</p>

	<h3>Widgets</h3>

	<p>The Theme includes some custom Widgets, that can take the place of their built-in counterparts. In fact, the custom 
	Widgets are essentially identical to the core Widgets, except that the custom Widgets are collapsible. The following 
	Widgets are available:</p>
	<ol>
		<li>Archives</li>
		<li>Categories</li>
		<li>Linkroll by Cat</li>
		<li>Post Formats</li>
		<li>Recent Posts</li>
		<li>Tags</li>
	</ol>
	
<?php }

// FAQ Tab
function oenology_reference_page_faq() { ?>
	
	<h3>So, how do I learn from Oenology?</h3>

	<p>Each Theme template file includes a considerable amount of inline documentation, explaining the code 
	use. Also, each template file includes a function reference, that lists each function, hook, and tag 
	used in the file, along with a WordPress Codex reference, an explanation of the function, and example usage.</p>

	<h3>What is oenology-reference.txt?</h3>

	<p>oenology-reference.txt is the master cross-reference file, that contains all of the functions, template tags, 
	and hooks used in the Theme.</p>

	<h3>Why so many template files?</h3>

	<p>Oenology is likely broken down into more template parts than the average Theme. This deconstruction is by 
	design, in order to facilitate easier Child-Theming.</p>

	<h3>What's in store for the future?</h3>

	<p>First and foremost, since Oenology is intended to be a learning tool, the inline and reference documentation 
	will be a continual work-in-progress, based upon user feedback. This documentation is complete as of Oenology 
	Version 1.0, but will continue to be updated and improved.</p>

	<p>Other features that may be added in the future:</p>
	<ol>
	<li>Internationalization</li>
	<li>Theme Options</li>
	<li>others, as determined by user feedback and demand</li>
	</ol>

	<h3>What About SEO?</h3>
 
	<p>I am a firm believer that the single, most important criterion for SEO is good content. That said, the Theme 
	does take apply some SEO considerations:</p>
	<ol>
	<li>The Theme assumes that the H1 heading tag will only be applied to the Post Title, and not to any post-entry 
	content. Accordingly, if you use an H1 heading in the post-entry content, you'll find that it is styled rather 
	similarly to the H2 heading tag.</li>
	<li>The Theme template files ensure that the most important content - the post-entry content - is rendered 
	as early as possible. The loop.php template file is called first, and the sidebar-left.php and sidebar-right.php 
	files are called second.</li>
	<li>The Theme supplies a default breadcrumb navigation function.</li>
	<li>The Theme includes plug-and-play support for the following plugins: WP-Paginate, Yoast Breadcrumbs</li>
	</ol>

	<p>Most of the rest is really up to the user. The Theme is intended to be SEO-neutral: neither hurting your SEO, 
	nor going out of its way (and adding considerable bloat that is better added via the many good plugins available) 
	to improve it.</p>
	
<?php }

// Code Ref Tab
function oenology_reference_page_coderef() { ?>

<div class="updated"><p><strong>Please note: this page is a work-in-progress! For the time being, refer to the <em>oenology-reference.txt</em>
file in the Theme root directory for a better-formatted version of this information.</strong></p></div>

<p>The following functions, tags, and hooks are used (or referenced) in Oenology:</p>

<h3>$_SERVER[]</h3>
<p><code>$_SERVER[]</code> is a PHP function that returns various server variables.</p>
<ul style="list-style:disc inside;margin-left:25px;">
<li>Codex reference: N/A</li>
<li>PHP reference: <a href="http://php.net/manual/en/reserved.variables.server.php">$_SERVER</a></li>
</ul>

<p>Example:</p>
<ul style="list-style:disc inside;margin-left:25px;">
<li><code>$_SERVER['PHP_SELF']</code><br />Returns the name of the current file</li>
</ul>

<p>Used in the following template files:</p>
<ul style="list-style:disc inside;margin-left:25px;">
<li>(tbd)</li>
</ul>


<h3>add_action()</h3>
<p><code>add_action()</code> is a WordPress function.</p>
<ul style="list-style:disc inside;margin-left:25px;">
<li>Codex reference: http://codex.wordpress.org/Function_Reference/add_action</li>
</ul>

<p><code>add_action()</code> is used to hook a function into a WordPress action</p>

<p><code>add_action( $tag, $function_to_add, $priority, $accepted_args )</code> accepts four arguments:</p>
<ul style="list-style:disc inside;margin-left:25px;">
<li><code>$tag:</code> WordPress action into which to hook the function.<br />Default: none</li>
<li><code>$function_to_add:</code> function to hook into the WordPress action.<br />Default: none</li>
<li><code>$priority:</code> relative priority (order of execution, lower numbers execute sooner) of function.<br />Default: 10</li>
<li><code>$accepted_args:</code> number of arguments accepted by function being hooked.<br />Default: 1</li>
</ul>

Example:
<ul style="list-style:disc inside;margin-left:25px;">
<li><code>add_action( 'after_setup_theme', 'oenology_setup', 10 );</code>
Hooks custom function oenology_setup() into the "after_setup_theme" action, with the default priority</li>
</ul>

<p>Used in the following template files:</p>
<ul style="list-style:disc inside;margin-left:25px;">
<li>functions.php</li>
</ul>

<h3>add_custom_background()</h3>
add_custom_background() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_custom_background

add_custom_background() is used to add Theme support for WordPress custom background functionality

add_custom_background( $header_callback, $admin_header_callback, $admin_image_div_callback ) accepts three arguments:
 - $header_callback: Callback to add to "wp_head". Default: none.
 - $admin_header_callack: Callback to add to Custom Background admin screen. Default: none.
 - $admin_image_div_callback: Output a custom background image div on Custom Background admin screen. Default: none

Example:
add_custom_background();
Adds custom background support to Theme, with no default background image defined.

Used in the following template files:
functions.php

<h3>add_custom_image_header()</h3>
add_custom_image_header() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/add_custom_image_header

add_custom_image_header() is used to add Theme support for WordPress custom background functionality

add_custom_image_header( $header_callback, $admin_header_callback ) accepts two arguments:
 - $header_callback: Callback to add to "wp_head". Default: none.
 - $admin_header_callback: Callback to add to Custom Image Header admin screen. Default: none.

Example:
add_custom_image_header( 'oenology_header_style', 'oenology_admin_header_style' );
Adds custom image header support to Theme, using header style defined in custom function
oenology_header_style(), and Custom Image Header admin screen style defined in custom function
oenology_admin_header_style().

Used in the following template files:
functions.php

<h3>add_editor_style()</h3>
add_editor_style() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/add_editor_style

add_editor_style() is used to add Theme support for WordPress custom visual editor style functionality

add_editor_style( $stylesheet ) accepts one argument:
 - $stylesheet: name (without file extension) of the CSS file that contains the custom editor style
 definitions. Default: editor-style.css ('editor-style')

Example:
add_editor_style();
Adds custom visual editor style support to Theme, with styles defined in CSS file editor-style.css.

Used in the following template files:
functions.php

<h3>add_filter()</h3>
add_filter() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_filter

add_filter() is used to hook a function into a WordPress action

add_filter( $tag, $function_to_add, $priority, $accepted_args ) accepts four arguments:
 - $tag: WordPress filter into which to hook the function. Default: none
 - $function_to_add: function to hook into the WordPress filter. Default: none
 - $priority: relative priority (order of execution, lower numbers execute sooner) of function. Default: 10
 - $accepted_args: number of arguments accepted by function being hooked. Default: 1

Example:
add_filter('get_comments_number', 'oenology_comment_count', 0);
Hooks custom function oenology_comment_count() into the "get_comment_count" filter, with the highest priority (0)

Used in the following template files:
functions.php

<h3>add_image_size()</h3>
add_image_size() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_image_size

add_image_size() is used to define a custom thumbnail image size, which will be generated
along with the default sizes of "Original", "Large", "Medium", "Small", and "Thumbnail".

add_image_size( $name, $width, $height, $crop ) accepts four arguments:
 - $name: Name of the custom Image Size to be added. Default: none.
 - $width: Width (in pixels) of the custom image. Default: '0'.
 - $height: Height (in pixels) of the custom image. Default: '0'.
 - $crop: boolean (TRUE or FALSE) argument to indicate crop method:
  - TRUE: hard crop mode
  - FALSE: soft (proportional) crop mode

Example:
add_image_size( 'attachment-nav-thumbnail', 45, 45, true );
Adds a custom image size "attachment-nav-thumbnail", 45px wide, 45px in height, hard-cropped.

Used in the following template files:
functions.php

<h3>add_theme_support()</h3>
add_theme_support() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/add_theme_support

add_theme_support() is used to add Theme support for the specified functionality

add_theme_support( $feature ) accepts one argument:
 - $feature: feature for which to add Theme support. 
  - Currently, either 'automatic-feed-links' or 'post-thumbnails'
  - Default: none

Example:
add_theme_support( 'post-thumbnails' );
Adds Theme support for core WordPress Post Thumbnails feature

Used in the following template files:
functions.php

<h3>apply_filters()</h3>
apply_filters() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/apply_filters

apply_filters() is used to call the functions added to a filter hook, and apply them to a specified value.

apply_filters( $tag, $value ) accepts two arguments:
 - $tag: the name of the filter hook. Default: none.
 - $value: the value to be modified by the specified filter hook.

Examples:
apply_filters( 'oenology_header_image_width', 1000 ) );
 - Applies the value of 1000 (px) to the "oenology_header_image_width" filter hook.
$title = apply_filters( 'widget_title', empty($instance['title']) ? 'oenology Recent Posts' : $instance['title'] );
 - Applies a string (based on a shorthand conditional) to the "widget_title" filter hook, and sets that value to the variable "$title".

Used in the following template files:
functions.php

<h3>array_map()</h3>
array_map() is a PHP function.
PHP reference: http://php.net/manual/en/function.array-map.php

array_map() is used to apply a callback to the elements of the given array(s)

array_map() returns an array containing all the elements of arr1 after applying the callback function to each one. 
The number of parameters that the callback function accepts should match the number of arrays passed to the array_map()

array_map( $callback, $array ) accepts two arguments:
 - $callback: the function to apply to the array
 - $array: the array to which to apply the function

Used in the following template files:
functions.php

<h3>array_reverse()</h3>
array_reverse() is a PHP function.
PHP reference: http://php.net/manual/en/function.array-reverse.php

array_reverse() is used to reverse the order of elements in an array

array_reverse() will take an array containing elements array[0] = A, array[1] = B, array[2] = C,
and reverse the array, such that array[0] = C, array[1] = B, array[2] = A.

array_reverse( $array, $preserve_keys ) accepts two arguments:
 - $array: the array to reverse
 - $preserve_keys: (boolean) set to TRUE to preserve keys

Example:
$breadcrumbs = array_reverse($breadcrumbs);
Reverses the order of elements in the $breadcrumb array (containing a list of Parent Categories)

Used in the following template files:
functions.php

<h3>array_values()</h3>
array_values() is a PHP function.
PHP reference: http://php.net/manual/en/function.array-values.php

array_values() is used to return an array of indexed values

array_values() will take an array containing elements "size" => "XL", "color" => "black", "sleeve" => "long",
and return an array containing elements array[0] = "XL", array[1] = "black", array[3] = "long"

array_values( $array ) accepts one argument:
 - $array: array for which to return values

Used in the following template files:
functions.php

<h3>basename()</h3>
basename() is a PHP function.
PHP reference: http://php.net/manual/en/function.basename.php

basename() is used to return the filename component of a "\path\to\filename.ext" string

basename( $path, $ext ) accepts two arguments:
 - $path: string containing a filepath
 - $ext: file extension, e.g. ".php". If included, the indicated extension will omitted from the returned value

Used in the following template files:
functions.php

<h3>bloginfo()</h3>
bloginfo() is a WordPress template tag.  
Codex reference: http://codex.wordpress.org/Function_Reference/bloginfo

bloginfo() can be used to print several useful WordPress-related parameters. For example:

	charset = (character set defined for the blog (see wp-config.php); usually UTF-8)
	description =  (blog description, as defined on the General Settings page in the administration panel)
	html_type =  (HTML type, as defined on the General Settings page in the administration panel. Usually "text/html")
	name =  (blog name, as defined on the General Settings page in the administration panel)
	template_directory = (url of the directory that contains the currently active theme)
	version = (version of WordPress installed)
	
For the full list of parameters returned by bloginfo(), see the Codex.

bloginfo() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_bloginfo() instead.

Used in the following template files:
footer.php, functions.php, header.php, loop-header.php, site-header.php

<h3>body_class()</h3>
body_class() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/body_class

body_class() is added inside the HTML <body> tag, and outputs various CSS class
declarations, depending on which page is currently being displayed.

For the full list of CSS classes returned by body_class(), see the Codex.

Used in the following template files:
404.php, index.php, page.php

<h3>category_description()</h3>
category_description() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/category_description

category_description() is used to display the description for the current category.

category_description( $cat ) accepts one argument:
 - $cat: category (ID) for which to display the description. Defaults to current category.

 category_description() must be used within the Loop, unless given a category ID 
 using the $cat argument.
 
 Used in the following template files:
 loop-header.php

<h3>comment_form()</h3>
comment_form() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/comment_form

comment_form() is used to output the comment reply form in the comments section
of a Post or Page.

comment_form() accepts two arguments:
 - $args: ampersand (&) joined list of arguments. See the Codex reference for full list. 
 - $postid: PostID of the post to which the comment form should post comments. 
    Defaults to the current post.

Example:
comment_form();

comment_form() must be used from within the Loop, unless the $postid parameter is used.

Used in the following template files:
comments.php

<h3>comments_link()</h3>
comments_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/comments_link

comments_link() is used to display the URL to the current post's comments. This tag
returns the URL only, rather than the full HTML anchor-tag link.

comments_link() accepts no arguments.

Example:
<a href="comments_link();">Comments</a>

comments_link() must be used within the Loop.

Used in the following template files:
post-header.php

<h3>comments_number()</h3>
comments_number() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/comments_number

comments_number() is used to display the number of comments (including 
comments, trackbacks, and pingbacks) on the current post.

comments_number( $a, $b, $c ) accepts three arguments:
 - $a: what to display for 0 comments
 - $b: what to display for 1 comment
 - $c: what to display for multiple comments
 
Example:
comments_number('0','1','%'); displays:
  - '0' if 0 comments
  - '1' if 1 comment
  - '#' (actual number of comments) if multiple comments

comments_number() must be used within the Loop.

Used in the following template files:
comments.php, post-header.php

<h3>comments_open()</h3>
comments_open() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/comments_open

comments_open() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
comments are open for the current post.

comments_open( $postid ) accepts one argument:
 - $postid: PostID of the post being checked. Defaults to the current post.

comments_open() must be used from within the Loop, unless the $postid parameter is used.

Used in the following template files:
comments.php, loop.php

<h3>count()</h3>
count() is a PHP function.
PHP reference: http://php.net/manual/en/function.count.php

count() is used to count the number of elements in an array.

count() will take an array containing elements array[0] = "red", array[1] = "green", array[2] = "blue",
and return the value "3".

count( $array, $mode ) accepts two arguments:
 - $array: the array for which to count the elements.
 - $mode: count normally, or count recursively. Default: count_normal.

Example:
count($comments_by_type['comment']);
Returns the number of comments of type 'comment' (rather than 'trackback' or 'pingback') for the current Post->$ID.

Used in the following template files:
functions.php

<h3>create_function()</h3>
create_function() is a WordPress function.
PHP reference: http://php.net/manual/en/function.create-function.php

create_function() is used to create an anonymous function from the parameters passed, 
and return a unique name for it. 

create_function( $args, $code ) accepts two arguments:
 - $args: the arguments to pass to the function
 - $code: the function code

Used in the following template files:
functions.php

<h3>date()</h3>
date() is a PHP function that returns the current date.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.date.php

date() accepts one argument: a string indicating the date format.

Used in the following template files:
footer.php

<h3>define()</h3>
define() is a PHP function.
PHP reference: http://php.net/manual/en/function.define.php

define() is used to define a named constant.

define( $name, $value, $case_insensitive ) accepts arguments:
 - $name: name of the constant. Default: none.
 - $value: value of the constant. Default: none.
 - $case_insensitive: (boolean) determines if constant name is case-sensitive or not.
  - TRUE: name is case-sensitive ("CONSTANT" and "constant" are two different constants)
  - FALSE: name is case-insensitive ("CONSTANT" and "constant" are the same constant)
  - Default: FALSE

Example:
define( 'HEADER_TEXTCOLOR', '000000' );
Defines the "HEADER_TEXTCOLOR" constant, with a value of "000000" (the HEX value for black)

Used in the following template files:
functions.php

<h3>dynamic_sidebar()</h3>
dynamic_sidebar() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

dynamic_sidebar() is used to insert widgetized areas ("sidebars") into a Theme.
dynamic_sidebar( 'foo' ) will insert a dynamic sidebar named "foo".

Dynamic sidebars must be defined and registered. Refer to functions.php for more information.

Used in the following template files:
sidebar-left.php, sidebar-right.php

<h3>edit_post_link()</h3>
edit_post_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/edit_post_link

edit_post_link() is used to display a link to edit the current post. This link only
displays if the current user is logged in and has the edit_post capability
(typically, Admins, Editors, and Authors). 

This tag returns the full HTML anchor tag, rather than just the URL of the edit-post
link. To retrieve just the URL, use get_edit_post_link().

edit_post_link( $link, $before, $after, $id ) accepts four arguments:
- $link: link text to display. Defaults to "Edit This"
- $before: text to display before link. Defaults to no text.
- $after: text to display after link. Defaults to no text.
- $id: ID of post to be edited. Defaults to ID of current post.

Example:
edit_post_link( 'Edit' ); displays: "<a href='[link to post edit screen]'>Edit</a>"

edit_post_link() must be used within the Loop, unless the $id argument is specified.

Used in the following template files:
post-header.php

<h3>file_exists()</h3>
file_exists() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.file-exists.php

file_exists() is a boolean (returns TRUE or FALSE) conditional function that returns true if 
the specified file exists.

file_exists( $filepath ) accepts one argument:
 - $filepath: (string) the filepath and filename, e.g. /path/to/my/file.ext

Example:
file_exists( get_theme_root() . '/twentyten/style.css' )
 - returns TRUE if the file is found

Used in the following template files:
functions.php

<h3>filesize()</h3>
filesize() is a PHP function.
PHP reference: http://php.net/manual/en/function.filesize.php

filesize() is used to return the size, in bytes, of the specified file 

filesize( $file ) accepts arguments:
 - $file: string containing full path to file for which to return the size.

Used in the following template files:
functions.php

<h3>function_exists()</h3>
function_exists() is a boolean (returns TRUE or FALSE) conditional PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.function-exists.php

function_exists( 'foo' ) returns TRUE if a function named foo() is found; otherwise, it returns FALSE.

Used in the following template files:
404.php, functions.php, loop-footer.php, post-entry.php

<h3>get_avatar()</h3>
get_avatar() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_avatar

get_avatar() is used to display the Post ID for the current post.

get_avatar( $id_or_email, $size, $default, $alt );  accepts four arguments:
 - $id_or_email: UserID or email address;
 - $size: width/height (in pixels) of the displayed avatar. Defaults to '96'.
 - $default: URL for default image to display if the user has no defined avatar. Defaults to "Mystery Man"
 - $alt: alt text to display for avatar image. Defaults to no alt text.

Example:
echo get_avatar( get_the_author_meta('email'), $size = '20'); displays a 20x20px avatar for the post author.

To get the Avatar without displaying it, omit "echo" in the function call for get_avatar().

Used in the following template files:
post-footer.php


<h3>get_bloginfo()</h3>
See: bloginfo()

Used in the following template files:
functions.php

<h3>get_category()</h3>
See: the_category()

Used in the following template files:
functions.php

<h3>get_category_parents()</h3>
get_category_parents() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_category_parents

get_category_parents() is used to return a list of the parents of a category, 
including the category, sorted by ID.

get_category_parents( $category, $displaylink, $separator, $nicename ) accepts four arguments:
 - $category: category ID for which to return the list. Default: current category, or none
 - $displaylink: boolean (TRUE/FALSE) argument to display the list as links to the categories
  - TRUE: display list as links to categories
  - FALSE: display list as text-only
  - Default: TRUE
 - $separator: text string to be used as separator between categories in the list
 - $nicename: boolean (TRUE/FALSE) argument to display the category nicename (slug)
  - TRUE: Display the category nicename (e.g. "my-category")
  - FALSE: Display the category display name (e.g. "My Category")
  - Default: FALSE

Used in the following template files:
functions.php

<h3>get_children()</h3>
get_children() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_children

get_children() is used to retrieve attachments, revisions of a given Post

get_children() returns an associative array of posts (of variable type set 
by $output parameter) with post IDs as array keys, or an empty array if no 
posts are found.

get_children( $args[string] ) accepts multiple arguments. See the Codex for full list.

Used in the following template files:
functions.php

<h3>get_comment_link()</h3>
get_comment_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_comment_link

get_comment_link() is used to get the permalink to a given comment

get_comment_link() accepts two arguments:
 - $comment: Id for comment for which to output link. Defaults to current comment.
 - $args: ampersand (&) linked array of options. See Codex for full list.

Example:
<a href="echo get_comment_link();">Comment</a>

get_comment_link() must be used from within the Loop, unless the $comment parameter is used.

Used in the following template files:
comments.php

<h3>get_comments_number()</h3>
get_comments_number() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/get_comments_number

get_comments_number() is used to return the number (as a numeric value) of comments (including 
comments, trackbacks, and pingbacks) on the current post.

get_comments_number() accepts no arguments

get_comments_number() must be used within the Loop.

Used in the following template files:
comments.php

<h3>get_comment_pages_count()</h3>
get_comment_pages_count() is a WordPress function.
Codex reference: N/A

get_comment_pages_count() is used to return the number of comment pages for a given post. Generally,
it is used as part a conditional, to display comment-page navigation links only if more than one comment
page exists.

get_comment_pages_count() accepts no arguments.

Examples:
 - get_comment_pages_count() returns a number equal to the number of comment pages, e.g. '1', '2', etc.

 - if (get_comment_pages_count() > 1 )  will return true if more than one comment page exists.

get_comment_pages_count() must be used from within the Loop.

Used in the following template files:
comments.php

<h3>get_comment_type()</h3>
get_comment_type() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/comment_type

get_comment_type() is used to return (not output or print) the type of a given comment:
'comment', 'pingback', or 'trackback. To output this value, use comment_type().

get_comment_type() accepts no arguments.

Examples:
 - get_comment_type() will return either 'comment', 'pingback', or 'trackback'

 - if ( get_comment_type() != "comment" ) will return true if the current comment type is 
    'pingback' or 'trackback'

get_comment_type() must be used from within the Loop.

Used in the following template files:
comments.php

<h3>get_footer()</h3>
get_footer() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_footer

get_footer() is used to include the footer Theme template file (footer.php) within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_footer( $foo ) will attempt to include footer-foo.php. If it doesn't exist, the default footer.php will be used.

Used in the following template files:
404.php, index.php, page.php

<h3>get_header()</h3>
get_header() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_header

get_template_part() is used to include the header Theme template file (header.php) within another. This function facilitates
re-use of Theme template files, and also facilitates child Theme template files to take precedence
over parent Theme template files.

get_header( $foo ) will attempt to include header-foo.php. If it doesn't exist, the default header.php will be used.

Used in the following template files:
404.php, index.php, page.php

<h3>get_month_link()</h3>
get_month_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_month_link

get_month_link() is used to return the monthly archive URL to a specific year and month

get_month_link() returns, but does not display (print) the URL. Use echo get_month_link() to display the URL.

get_month_link( $year, $month ) accepts two arguments:
 - $year: the year from which to retrieve the archive URL
 - $month: the month from which to retrive the archive URL
 - Default: current year/month

Used in the following template files:
functions.php
	
<h3>get_option()</h3>
get_option() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_option

get_option() is used to return the value of a specified database option.
If the option does not exist or has no value, the function returns FALSE.

get_option() returns, but does not print (output/display) the value requested. To 
print this value, use 'echo get_option()'.

get_option( $show, $default ) accepts two arguments
 - $show: the database option for which to return a value
     - See this Codex reference for full list of options: http://codex.wordpress.org/Option_Reference
 - $default: the value to return if the option does not exist, or has no value. Default is FALSE

Examples:
 - if ( get_option( 'show_on_front' ) == 'posts' ) returns TRUE if the "Show On Front" option is set to display blog posts, and
   returns FALSE if the "Show On Front" option is set to display a static page
   
 - get_option( 'page_comments' ) returns TRUE is the "Paged Comments" option is true; otherwise returns FALSE

Used in the following template files:
comments.php, header.php, site-navigation.php

<h3>get_permalink()</h3>
get_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_permalink

get_permalink() is used to return the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

get_permalink() returns, but does not display, the requested post permalink.

get_permalink( $id ) accepts one argument:
 - $id: ID of the post for which to return the permalink

Example:
echo get_permalink($post->post_parent);
Displays the URL to the post parent of the current post.

Used in the following template files:
post-entry-image.php

<h3>get_post()</h3>
get_post() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_post

get_post() is used to return an object or array containing the data for the specified post.

get_post() returns, but does not display, the requested data.

get_post( $post, $output ) accepts two arguments
 - $post: a variable containing the PostID interger value
 - $output: 'OBJECT', 'ARRAY_A', 'ARRAY_N'

Used in the following template files:
functions.php

<h3>get_post_format()</h3>
get_post_format() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_post_format

get_post_format() is used to retrieve the Post Format of the current Post

get_post_format() returns the Post Format type, as a string, if the current Post
has a Post Format (other than "standard") selected; otherwise, it returns NULL.

get_post_format( $postid ) accepts one argument:
 - $postid: the ID of the post for which to return the Post Format type. Defaults to
   the current post.

Used in the following template files:
loop.php

<h3>get_posts()</h3>
get_posts() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_posts

get_posts() is used to create/output multiple Post Loops.

get_posts( 'arguments' ) accepts various arguments. See the Codex for the complete list.

Used in the following template files:
functions.php

<h3>get_search_form()</h3>
get_search_form() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_search_form

get_search_form() is used to display the search form. If the Theme includes a
searchform.php template file, it will be used. Otherwise, the built-in search form
will be used.

get_search_form() accepts no arguments.

Used in the following template files:
infobar.php

<h3>get_sidebar()</h3>
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

Used in the following template files:
404.php, index.php, page.php
	
<h3>get_stylesheet_uri()</h3>
get_stylesheet_uri() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_stylesheet_uri

get_stylesheet_uri() is used to get the value for the URI of the Theme
style sheet (style.css).

get_stylesheet_uri() accepts no arguments.

get_option() returns, but does not print (output/display) the value requested. To 
print this value, use 'echo get_option()'.

Example:
echo get_stylesheet_uri(); returns e.g. "http://www.mydomain.tld/wp-content/themes/my-theme/style.css"

Used in the following template files:
header.php

<h3>get_tag_feed_link()</h3>
get_tag_feed_link() is a WordPress template tag.
Codex reference: N/A

get_tag_feed_link() returns the link for the RSS feed for the specified tag.

get_tag_feed_link( $tagid, $feed ) accepts two arguments:
 - $tagid: ID of the tag for which to display the RSS feed.
 - $feed: feed format ('rss', 'rss2', 'atom'). Defaults to user-defined default.

Example:
get_tag_feed_link( $wp_query->get( 'tag_id' ) ); returns the default RSS feed for the
current tag (e.g. when on a tag page).

get_tag_feed_link() must be used outside the Loop.

Used in the following template files:
loop-header.php

<h3>get_template_part()</h3>
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

Used in the following template files:
404.php, index.php, loop.php, page.php, post-entry.php, site-header.php

<h3>get_the_author_meta()</h3>
get_the_author_meta() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_author_meta

get_the_author_meta() is used to display the Post Author for the current post.

get_the_author_meta( $field, $userID )  accepts two arguments:
 - $field: field name for data item to be displayed. See the Codex for full list.
 - $userID: UserID for whom data item is displayed. Defaults to Post Author.

Example:
get_the_author_meta( 'email' ); returns the Post Author's email address.

To display the author meta information, use 'echo" in the function call
for get_the_author_meta(), or use the_author_meta() instead.

get_the_author_meta()  must be used within the Loop, unless the $userID argument is used.

Used in the following template files:
post-footer.php

<h3>get_the_category()</h3>
get_the_category() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_category

get_the_category() returns an array of categories for the current page. The returned 
array includes the following variables:
 - $cat[n]->cat_ID: the ID of category 'n'
 - $cat[n]->cat_name: the name of category 'n'
 - $cat[n]->category_nicename: the nicename (slug) of category 'n'
 - $cat[n]->category_description: the description of category 'n'
 - $cat[n]->category_parent: the name of the parent category of category 'n'
 - $cat[n]->category_count: the count of posts included in category 'n'

get_the_category( $id ) accepts one argument:
 - $id: post ID for which to return the category array. Defaults to current post ID.

Example:
$cat = get_the_category(); $cat = $cat[0]; echo $cat->category_nicename;
displays the nicename (slug) of the first category returned in the category array.

get_the_category() must be used inside the loop, unless a post ID is passed 
using the $id argument.

Used in the following template files:
loop-header.php

<h3>get_the_excerpt()</h3>
See: the_excerpt()

Used in the following template files:
functions.php

<h3>get_the_time()</h3>
See: the_time()

Used in the following template files:
functions.php

<h3>get_the_title()</h3>
get_the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_the_title

get_the_title() is used to display the Post Title of the current post.

get_the_title( $id ) accepts one argument:
 - $id: ID of the post for which to return the Post Title

Example:
echo get_the_title($post->post_parent); 
Displays the Post Title of the current post's parent post. 

Used in the following template files:
functions.php, post-entry-image.php

<h3>get_theme_root()</h3>
get_theme_root() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_theme_root

get_theme_root() is used to retrieve the file path to the directory in which 
Themes are installed (e.g. 'home/username/html/wp-content/themes').

Note that the returned string has no trailing slash.

get_theme_root() accepts no arguments.

Used in the following template files:
functions.php

<h3>get_trackback_url()</h3>
get_trackback_url() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/trackback_url

get_trackback_url() is used to display the URL to the current post's trackback URL. This tag
returns the URL only, rather than a full HTML anchor-tag link.

get_trackback_url() accepts no arguments.

Example:
<a href="get_trackback_url();">Trackback</a>

get_trackback_url() must be used within the Loop.

Used in the following template files:
post-header.php

<h3>get_queried_object()</h3>
get_queried_object() is a property of the WordPress WP_Query class.
Codex reference: http://codex.wordpress.org/Function_Reference/WP_Query

get_queried_object() is used to return information about the current 
category, author, permalink, or page

get_queried_object() returns an object that contains the specified information.

get_queried_object() accepts no arguments

Example:
$my_obj = $wp_query->get_queried_object();
returns object $my_obj that contains the specified information from $wp_query.

Used in the following template files:
functions.php

<h3>get_query_var()</h3>
get_query_var() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_query_var

get_query_var() is used to return the specified variable from the $wp_query object

get_query_var( $var ) accepts one argument:
 - $var: the query variable to return.

Examples:
get_query_var('paged');
 - Returns the current page number of an index page (home, archive, etc.)
get_query_var('page');
 - Returns the current page number of a Post or Page

Used in the following template files:
functions.php

<h3>get_search_query()</h3>
get_search_query() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/get_search_query

get_search_query() is used to return the string used in a search query.

get_search_query() returns, but does not print/display, the search query string.
To print/display the search query string, use "echo get_search_query()" or "the_search_query()"

get_search_query( $args ) accepts no arguments

Example:
get_search_query();
If e.g. "lorem ipsum" was entered as the search query, returns the string "lorem ipsum"

Used in the following template files:
functions.php

<h3>get_userdata()</h3>
get_userdata() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_userdata

get_userdata() is used to return an object containing user data for the specified user.

get_userdata( userid ) accepts one argument:
 - userid: the ID of the user for which to return data

Example:
$user_info = get_userdata($id);
Returns the following object values (not inclusive):
 - $user_info->user_login
 - $user_info->user_pass
 - $user_info->user_nicename
 - $user_info->user_email
 - $user_info->user_url
 - $user_info->user_registered
 - $user_info->display_name
 - $user_info->user_firstname
 - $user_info->user_lastname
 - $user_info->nickname
 - $user_info->user_description

Used in the following template files:
functions.php

<h3>get_year_link()</h3>
get_year_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/get_year_link

get_year_link() is used to return (not print) the URL for the year-archive for the specified year.

get_year_link( $year ) accepts one argument:
 - $year: year for which to return the year-archive URL. Default: current year

Used in the following template files:
functions.php

<h3>has_nav_menu()</h3>
has_nav_menu() is a WordPress template conditional tag.
Codex reference: N/A

has_nav_menu( $menu ) is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a nav_menu named $menu has been configured by the user; otherwise it returns false.

has_nav_menu() is useful for defining a fallback option for a navigation menu, in case the
user does not define a particular nav menu in the Menus administration panel.

Used in the following template files:
sidebar-left.php, site-navigation.php

<h3>have_comments()</h3>
have_comments() is a WordPress conditional tag.
Codex reference: N/A

have_comments() is a conditional that returns TRUE if the current post has comments
associated with it; otherwise, it returns FALSE. The most typical use of this conditional
is within the comments template, as part of the comments "Loop".

have_comments() accepts no arguments.

Example:
if ( have_comments() ) is used to begin the comments "Loop", which displays only if the current
post has comments.

have_comments() must be used from within the Loop.

Used in the following template files:
comments.php

<h3>have_posts()</h3>
have_posts() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/User:Samsm/have_posts

have_posts() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the current query has posts available. It is primarily used in conjunction with the_post() 
as part of the call to the Loop.

Example (the Loop):
if ( have_posts() ) : while ( have_posts() ) : the_post();

Used in the following template files:
loop.php

<h3>header_image()</h3>
header_image() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/header_image

header_image() is used to display the path to the header image

header_image() accepts no arguments.

Used in the following template files:
functions.php

<h3>home_url()</h3>
home_url() is a WordPress function
Codex reference: http://codex.wordpress.org/Function_Reference/home_url

home_url() is used to return the home URL (the 'home' option), using the appropriate protocol 
(http or https), based on value of is_ssl().

home_url() accepts no arguments.

Example:
home_url(); returns e.g. "http://www.domain.tld"

Used in the following template files:
footer.php, infobar.php, site-navigation.php

<h3>is_404()</h3>
is_404() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_404

is_404() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a 404 error page is currently displayed.

A 404 error page corresponds to the 404.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="error404".

Used in the following template files:
functions.php

<h3>is_archive()</h3>
is_archive() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_archive

is_archive() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an archive page is currently displayed.

An archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="archive".

Used in the following template files:
loop-header.php

<h3>is_array()</h3>
is_array() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.is-array.php

is_array() is a boolean (returns TRUE or FALSE) conditional function that returns true if
a variable is an array.

is_array() accepts one argument: the variable to be evaluated

Used in the following template files:
functions.php

<h3>is_attachment()</h3>
is_attachment() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_attachment

is_attachment() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an attachment post ("attachment" post-type) is currently displayed.

An attachment post corresponds to the attachment.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
attachment post will have class="attachment".

Used in the following template files:
functions.php, post-entry.php

<h3>is_author()</h3>
is_author() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_author

is_author() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
an author archive page is currently displayed.

An author archive page corresponds to the author.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
attachment post will have class="author".

Used in the following template files:
functions.php

<h3>is_category()</h3>
is_category() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_category

is_category() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a category page is currently displayed.

A category page corresponds to the category.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="category".

is_category( $category ) accepts one optional argument:
 - $category: category ID, slug, or nicename. If used, will return TRUE if the current
  page corresponds to the indicated category.

Used in the following template files:
functions.php, loop-header.php

<h3>is_day()</h3>
is_day() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_day

is_day() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (day) archive page is currently displayed.

A date (day) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="date".

Used in the following template files:
functions.php

<h3>is_feed()</h3>
is_feed() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_feed

is_feed() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a feed is currently displayed.

A feed does not correspond to any template files in the Theme hierarchy.

Used in the following template files:
functions.php

<h3>is_home()</h3>
is_home() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_home

is_home() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the home page is currently displayed.

The home page corresponds to the index.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="blog".

Used in the following template files:
post-entry.php

<h3>is_month()</h3>
is_month() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_month

is_month() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (month) archive page is currently displayed.

A date (month) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="date".

Used in the following template files:
functions.php

<h3>is_page()</h3>
is_page() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_page

is_page() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a page ("page" post-type) is currently displayed.

A page corresponds to the page.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="page".

Used in the following template files:
functions.php, loop.php, post-entry.php, post-footer.php, post-header.php, sidebar-left.php

<h3>is_search()</h3>
is_search() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_search

is_search() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a search results page is currently displayed.

A search results page corresponds to the search.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="search".

Used in the following template files:
functions.php, loop-header.php

<h3>is_single()</h3>
is_single() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_single

is_single() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a single post ("post" post-type, i.e. a single blog post) is currently displayed.

A single post corresponds to the single.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of a 
single post will have class="single".

Used in the following template files:
functions.php, loop.php, post-entry.php, post-footer.php, post-header.php

<h3>is_singular()</h3>
is_singular() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_singular

is_singular() is a boolean (returns TRUE or FALSE) conditional tag that returns true if any of the following are true:

	is_single() - a single post ("post" post-type, i.e. a single blog post) is displayed
	is_page() - a page ("page" post-type) is displayed
	is_attachment() - an attachment 

Used in the following template files:
functions.php, header.php, loop-footer.php

<h3>is_tag()</h3>
is_tag() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_tag

is_tag() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a tag page is currently displayed.

A tag page corresponds to the tag.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="tag".

is_tag( $tag ) accepts one optional argument:
 - $tag: tag ID, slug, or nicename. If used, will return TRUE if the current
  page corresponds to the indicated tag.

Used in the following template files:
loop-header.php

<h3>is_user_logged_in()</h3>
is_user_logged_in() is a WordPress conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_user_logged_in

is_user_logged_in() is a boolean (returns TRUE or FALSE) conditional tag that returns
true if the current user is logged in; otherwise it returns false.

is_user_logged_in() accepts no arguments.

Used in the following template files:
infobar.php

<h3>is_year()</h3>
is_year() is a WordPress template conditional tag.
Codex reference: http://codex.wordpress.org/Function_Reference/is_year

is_year() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
a date (year) archive page is currently displayed.

A date (year) archive page corresponds to the archive.php Theme template file in the
Theme hierarchy, and if the body_class() hook is used, the <body> tag of an
page will have class="date".

Used in the following template files:
functions.php

<h3>isset()</h3>
isset() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.isset.php

isset() is used to determine if a specified variable is set, and is not NULL

isset() returns TRUE if the specified veriable is set, and is not NULL. Otherwise, it
returns false. Note: a zero-value ("0") is *not* equivalent to a NULL value.

isset( $arg ) accepts arguments:
 - $arg: variable to evaluate
 - isset() can take multiple variables. In this case, variables ae evaluated as defined 
 from left to right, and the function returns true only if ALL variables return true. Upon
 the first occurrence of a NULL-value variable, the function stops evaluating, and returns false.

Example:
if ( ! isset( $content_width ) ) {
  $content_width = 640;
}
This conditional will determine if the $content_width variable is set. If $content_width is not already
set, then it is set to a value of "640".

Used in the following template files:
functions.php

<h3>language_attributes()</h3>
language_attributes() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/language_attributes

language_attributes() is added inside the HTML <html> tag, and outputs various HTML
language attributes, such as language and text-direction.

Used in the following template files:
header.php

<h3>max()</h3>
max() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.max.php

max() is used to determine the highest numerical value of a given group of inputs

max() returns the highest numerical value of the given inputs. String values can be passed to the function,
but are evaluated as a numerical value of zero.

max( $arg1, $arg2, etc ) accepts multiple arguments:
 - $arg1, $arg2, etc: a list of values

max( $array ) accepts one argument:
 - $array: an array, for which each array value will be evaluated.
 - If used, an array MUST be the FIRST and ONLY value passed to the function, in order for the function
 to evaluate each array value

Example:
max( $paged, $page ) );
Will return the higher value between $paged (index page number) and $page (single-post page number)

Used in the following template files:
functions.php

<h3>next_comments_link()</h3>
next_comments_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/next_comments_link
Codex reference: http://codex.wordpress.org/Function_Reference/next_comments_link

next_comments_link() is used to display the next page of comments (older comments)

next_comments_link( $label, $max_page ) accepts two arguments:
 - $label: text label for the link text. Defaults to '' (no label).
 - $max_page: maximum number of comment pages on which to place the link. Defaults to '0' (no limit)

Example:
previous_comments_link( '<span class="meta-nav">&larr;</span> Older Comments' );
returns "<- Older Comments" (with an ASCII left-arrow symbol)

next_comments_link() must be used from within the Loop.

Used in the following template files:
comments.php

<h3>next_post_link()</h3>
next_post_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/next_post_link

next_post_link() is used to display the next post (older post) 

next_post_link() displays a fully-formed HTML link.

next_post_link( $format, $link, $in_same_cat, $exclude_categories ) accepts four arguments:
 - $format: string format of the link, using the %link% placeholder for the HTML link. Default: "%link% &raquo;"
 - $link: text (string) to display within the HTML link. Default: "%title%" (Post Title)
 - $in_same_cat: boolean (TRUE/FALSE) value to specify if linked post must be in the same category as the
 current post. Default: FALSE
 - $exclude_categories: list of categories by ID, separated by 'and', to exclude. Default: none.

Example:
next_post_link( '%link', '&lArr; ' );
Displays the link to the next post, with a left arrow as the link text.

next_post_link() must be used from within the Loop.

Used in the following template files:
functions.php, infobar.php

<h3>number_format()</h3>
number_format() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.number-format.php

number_format() is used to format a number with grouped thousands 

number_format( $number, $decimals, $dec_point, $thousands_sep ) accepts one, two, our four arguments:
 - $number: the number to be formatted
 - $decimals: (optional) the number of decimal places. Default: 0
 - $dec_point / $thousands_sep: (optional, but must be in tandem if used) string value to use for 
 decimal place and thousands separator. Defaults: dot (".") for decimal place, and comma (",") for 
 thousands separator.

Used in the following template files:
functions.php

<h3>oenology_404_handler()</h3>
oenology_404_handler() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_404_handler() is used to generate suggested site content when a user is sent to
the 404 page due to a server 404 "file not found" error.

oenology_404_handler() is defined in functions.php.

Used in the following template files:
404.php

<h3>oenology_admin_header_style()</h3>
oenology_admin_header_style() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_admin_header_style() is used to define the CSS to apply to the header image displayed
on the Custom Header admin option page, as part of the Custom Image Header feature

Used in the following template files:
functions/functions-theme-setup.php

<h3>oenology_breadcrumb()</h3>
oenology_breadcrumb() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_breadcrumb() is used to output breadcrumb links.

oenology_breadcrumb() outputs a home link, followed by appropriate breadcrumb links,
including categories (hierarchical), tags, search query, etc.

oenology_breadcrumb() accepts no arguments.

Used in the following template files:
infobar.php

<h3>oenology_comment_count()</h3>
oenology_comment_count() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_comment_count() is used to return only the number of comment-type 
comments (excluding trackbacks/pingbacks)

oenology_comment_count() hooks into the get_comments_number() filter hook

Used in the following template files:
functions/functions-custom.php

<h3>oenology_copyright()</h3>
oenology_copyright() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_copyright() is used to output the copyright date range, in the format 'XXXX - YYYY',
where 'XXXX' is the year the oldest post was published, and'YYYY' is the current year.

oenology_copyright() is defined in functions.php.

Used in the following template files:
footer.php

<h3>oenology_filter_wp_title()</h3>
oenology_filter_wp_title() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_filter_wp_title() is used to display more accurate information in wp_title,
according to current location (search query, single post, etc.)

oenology_filter_wp_title() hooks into the wp_title filter hook

Used in the following template files:
functions/functions-custom.php

<h3>oenology_gallery_image_meta()</h3>
oenology_gallery_image_meta() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_gallery_image_meta() is used to output various metadata related to
gallery images. The function outputs an array containing the
following values:
 - $image_meta['image']: image output, using wp_get_attachment_image()
 - $image_meta['url']: image attachment url, using wp_get_attachment_url()
 - $image_meta['width']: image width, in px
 - $image_meta['height']: image height, in px
 - $image_meta['dimensions']: image width/height dimensions, in px, displayed as "# x # px"
 - $image_meta['filesize']: image filesize, converted to human-readable size format, displayed as e.g. "### kb"
 - $image_meta['created_timestamp']: image metadata - date/time image taken, displayed as "D MMM YYYY"
 - $image_meta['copyright']: image metadata - copyright statement
 - $image_meta['credit']: image metadata - photographer
 - $image_meta['aperture']: image metadata - camera aperture setting
 - $image_meta['focal_length']: image metadata - camera focal length setting, displayed as "f/###"
 - $image_meta['iso']: image metadata - camera ISO setting
 - $image_meta['shutter_speed']: image metadata - camera shutter speed setting, displayed as e.g. "1/### sec"
 - $image_meta['camera']: image metadata - camera type
 - $image_meta['caption']: the image caption, as defined in image settings

oenology_gallery_image_meta() is defined in functions.php.

Used in the following template files:
post-entry-image.php

<h3>oenology_gallery_links()</h3>
oenology_gallery_links() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_gallery_links() is used to output "previous" and "next" links with both text and
thumbnail images, for use with gallery images. The function outputs an array containing the
following values:
 - $links['prevlink']: text link to previous gallery image
 - $links['prevthumb']: thumbnail of previous gallery image
 - $links['nextlink']: text link to next gallery image
 - $links['nextthumb']: thumbnail of next gallery image

oenology_gallery_links() is defined in functions.php.

Used in the following template files:
post-entry-image.php

<h3>oenology_header_style()</h3>
oenology_header_style() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_header_style() is used to define the CSS to apply to the header image, as part
of the Custom Image Header feature

Used in the following template files:
functions/functions-theme-setup.php

<h3>oenology_load_widgets()</h3>
oenology_load_widgets() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_load_widgets() is used to register the custom Theme Widgets.

oenology_load_widgets() hooks into the widgets_init action hook

Used in the following template files:
functions/functions-widgets.php

<h3>oenology_setup()</h3>
oenology_setup() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup() is used to define and setup all of the custom Theme features, including
Theme support for optional WordPress features. This function is designed to be over-ridden
by a Child Theme, if necessary.

oenology_setup() hooks into the after_setup_theme action hook

Used in the following template files:
functions/functions-theme-setup.php

<h3>oenology_setup_widgets()</h3>
oenology_setup_widgets() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_setup_widgets() is used to define all of the custom Theme Widgets. This function is
designed to be over-ridden by a Child Theme, if necessary.

oenology_setup_widgets() hooks into the after_theme_setup action hook

Used in the following template files:
functions/functions-widgets.php

<h3>oenology_show_current_cat_on_single()</h3>
oenology_show_current_cat_on_single() is a custom Theme function.
Codex reference: N/A
Defined in: functions.php

oenology_show_current_cat_on_single() is used to add a "current-cat" CSS class, analogous to the
"current-page" CSS class, for use in styling the output of wp_list_categories()

oenology_show_current_cat_on_single() hooks into the wp_list_categories filter hook

Used in the following template files:
functions/functions-custom.php

<h3>oenology_widget_archives()</h3>
oenology_widget_archives() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_archives() outputs the default "Archives" Widget, but adds a "show/hide" 
toggle to the Widget output.

Used in the following template files:
functions/functions-widgets.php

<h3>oenology_widget_categories()</h3>
oenology_widget_categories() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_categories() outputs the default "Categories" Widget, but adds a "show/hide" 
toggle to the Widget output. 

Used in the following template files:
functions/functions-widgets.php

<h3>oenology_widget_linkrollbycat()</h3>
oenology_widget_linkrollbycat() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_linkrollbycat() outputs the default "Linkroll" Widget, but adds a "show/hide" 
toggle to the Widget output. 

Used in the following template files:
functions/functions-widgets.php

<h3>oenology_widget_recentposts()</h3>
oenology_widget_recentposts() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_recentposts() outputs the default "Recent Posts" Widget, but adds a "show/hide" 
toggle to the Widget output. 

Used in the following template files:
functions/functions-widgets.php

<h3>oenology_widget_tags()</h3>
oenology_widget_tags() is a custom Theme Widget.
Codex reference: N/A
Defined in: functions.php

oenology_widget_tags() outputs the default "Tags" Widget, but adds a "show/hide" 
toggle to the Widget output. 

Used in the following template files:
functions/functions-widgets.php

<h3>post_class()</h3>
post_class() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/post_class

post_class() is added inside the HTML <div> or <span> tag that contains the post, 
and outputs various CSS class declarations, depending on which post is currently 
being displayed.

For the full list of CSS classes returned by post_class(), see the Codex.

Used in the following template files:
404.php, loop.php

<h3>post_password_required()</h3>
post_password_required() is a WordPress conditional tag.
Codex reference: N/A

post_password_required() is a conditional that returns TRUE if the current post is password-protected; 
otherwise, it returns FALSE. The most typical use of this conditional is within the comments template, as 
part of the comments "Loop".

post_password_required() accepts no arguments.

Example:
if ( post_password_required() ) is used to display a "password required" message, and prevents post
comments from displaying, if the post is password-protected.

post_password_required() must be used from within the Loop.

Used in the following template files:
comments.php

<h3>posts_nav_link()</h3>
posts_nav_link() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/posts_nav_link

posts_nav_link() is used to display Previous/Next links for paginated lists of posts
(e.g. index.php, archive.php, category.php, tag.php).

Note: the "Previous" link indicates *newer* posts; the "Next" link indicates *older* posts.
Thus, "Previous" and "Next" indicate the reverse-chronological nature of blog posts;
i.e. Previous in time (more recent) and Next in time (older).

posts_nav_link( $sep, $prelabel, $nxtlabel ) accepts 3 arguments:
 - $sep: text displayed between "Previous" and "Next" links. Defaults to ' :: '.
 - $prelabel: Link text displayed for "Previous" link. Defaults to '<< Previous Page'.
 - $nxtlabel:  Link text displayed for "Next" link. Defaults to 'Next Page >>'.

Example:
posts_nav_link('&nbsp;&diams;&nbsp;','&laquo;&laquo; Newer Posts','Older Posts &raquo;&raquo;');
Displays '<< Newer Posts' and 'Older Posts >>', with diamonds as a separator.

posts_nav_link() must be used within the Loop.

Used in the following template files:
functions.php, loop-footer.php

<h3>preg_replace()</h3>
preg_replace() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.preg-replace.php

preg_replace() is used to perform a regular-expression search-and-replace

preg_replace() returns an array if the subject parameter is an array, or a string otherwise. If matches are 
found, the new subject will be returned, otherwise subject will be returned unchanged or NULL if an error occurred.

preg_replace( $pattern, $replacement, $subject ) accepts arguments:
 - $pattern: the pattern for which to search
 - $replacement: the string with which to replace found instances of $pattern
 - $subject: the string on which to perform the search (for $pattern)-and-replace (with $replacement)

Used in the following template files:
functions.php

<h3>previous_comments_link()</h3>
previous_comments_link() is a WordPress template tag.

Codex reference: http://codex.wordpress.org/Template_Tags/previous_comments_link
Codex reference: http://codex.wordpress.org/Function_Reference/previous_comments_link

previous_comments_link() is used to display the previous page of comments (newer comments)

previous_comments_link( $label, $max_page ) accepts two arguments:
 - $label: text label for the link text. Defaults to '' (no label).
 - $max_page: maximum number of comment pages on which to place the link. Defaults to '0' (no limit)

Example:
next_comments_link( 'Newer Comments <span class="meta-nav">&rarr;</span>' );
returns "Newer Comments ->" (with an ASCII right-arrow symbol)

previous_comments_link() must be used from within the Loop.

Used in the following template files:
comments.php.

<h3>previous_post_link()</h3>
previous_post_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/previous_post_link

previous_post_link() is used to display the previous post (newer post) 

previous_post_link() displays a fully-formed HTML link.

previous_post_link( $format, $link, $in_same_cat, $exclude_categories ) accepts four arguments:
 - $format: string format of the link, using the %link% placeholder for the HTML link. Default: "%link% &raquo;"
 - $link: text (string) to display within the HTML link. Default: "%title%" (Post Title)
 - $in_same_cat: boolean (TRUE/FALSE) value to specify if linked post must be in the same category as the
 current post. Default: FALSE
 - $exclude_categories: list of categories by ID, separated by 'and', to exclude. Default: none.

Example:
previous_post_link( '%link', '&rArr; ' );
Displays the link to the next post, with a right arrow as the link text.

previous_post_link() must be used from within the Loop.

Used in the following template files:
functions.php, infobar.php

<h3>register_default_headers()</h3>
register_default_headers() is a WordPress function.
Codex reference: 

register_default_headers() is used to register default header images available through the
Custom Header admin option page, as part of the Custom Image Header feature. 

register_default_headers( $array ) accepts one argument, as an array-of-arrays:
 - $array: array of arrays containing the following key pairs:
   - 'url' => 'url/path/to/header/image'
   - 'thumbnail_url' => 'url/path/to/header/image/thumbnail'
   - 'description' => 'Description of the header image'

Used in the following template files:
functions.php

<h3>register_nav_menus()</h3>
register_nav_menus() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_nav_menus

register_nav_menus() is used to register Navigation Menu locations, as part of the 
Navigation Menus feature 

register_nav_menus( $array ) accept one argument, as an array:
 - $array: an array of key pairs, as $location => $description
   - $location: the menu location, used to add the Menu to a Theme template file
   - $description: description of the menu location, used on the Menus admin option page

Used in the following template files:
functions.php

<h3>register_sidebar()</h3>
register_sidebar() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_sidebar

register_sidebar() is used to 

register_sidebar() 

register_sidebar( $array ) accepts one argument, as an array:
 - $array: array containing the following key pairs:
   - 'name' => 'sidebar_name'
   - 'description' => 'Description of the sidebar'
   - 'before_widget' => 'HTML to output before the widget'
   - 'after_widget' => 'HTML to output after the widget'
   - 'before_title' => 'HTML to output before the widget title'
   - 'after_title' => 'HTML to output after the widget title'

Used in the following template files:
functions.php

<h3>register_widget()</h3>
register_widget() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/register_widget

register_widget() is used to register a custom Theme Widget

register_widget( $widget ) accepts one argument:
 - $widget: function that defines the Widget being registered

Used in the following template files:
functions.php

<h3>require_once()</h3>
require_once() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.require-once.php

require_once( $file ) will include the file specified by the $file argument

require_once() will return a fatal error if the specified file cannot be included. Also, if theme
specified file has already been included, require_once() will not attempt to include it again.

require_once( $file ) accepts one argument:
 - $file (string): file to be included.

require_once( 'foo.php' )
 - will include the file "foo.php".
 
Used in the following template files:
functions.php, functions/functions-options.php, functions/functions-options-init.php

<h3>set_post_thumbnail_size()</h3>
set_post_thumbnail_size() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/the_post_thumbnail

set_post_thumbnail_size() is used to define the default size for an image thumbnail,
for use with the_post_thumbnail()

set_post_thumbnail_size( $width, $height, $crop ) accepts arguments:
 - $width: image thumbnail width, in pixels
 - $height: image thumbnail height, in pixels
 - $crop: boolean (TRUE/FALSE) to determine whether thumbnail should be cropped
   - TRUE: hard-crop: image is resized and cropped to match the specified dimensions exactly
   - FALSE: box-resize: image is resized proportionally

Used in the following template files:
functions.php

<h3>single_cat_title()</h3>
single_cat_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/single_cat_title

single_cat_title() is used to display the title for the current category when displaying
the category page.

single_cat_title( $prefix, $display ) accepts one argument:
 - $prefix: string to display before the category title. Defaults to 'null'
 - $display: boolean (TRUE or FALSE) display value. Defaults to 'true' (display)

single_cat_title() must be used outside the Loop.

Used in the following template files:
functions.php, loop-header.php

<h3>single_tag_title()</h3>
single_tag_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/single_tag_title

single_tag_title() is used to display the title for the current tag when displaying
the tag page.

single_tag_title( $prefix, $display ) accepts one argument:
 - $prefix: string to display before the category title. Defaults to 'null'
 - $display: boolean (TRUE or FALSE) display value. Defaults to 'true' (display)

single_tag_title() must be used outside the Loop.

Used in the following template files:
functions.php, loop-header.php

<h3>size_format()</h3>
size_format() is a WordPress function.
Codex reference: N/A

size_format() is used to format filesizes into human-readable
formats, from bytes into KB, MB, etc.

size_format() takes a value in bytes, and returns the same value 
in KiB, MiB (where 1 MiB = 1024 B), with units "MB", "KB", etc.

size_format( $bytes, $decimals ) accepts arguments:
 - $bytes: filesize value (up to 32bits)
 - $decimals: decimal places to return. Default: '0'.

Example:
size_format( '1048576' );
 - returns "1 MB"

Used in the following template files:
functions.php

<h3>sprintf()</h3>
sprintf() is a PHP function.
Codex reference: N/A
PHP reference: http://us.php.net/manual/en/function.sprintf.php

sprintf() is used to return a string formatted according to the
defined formatting string format. See the PHP reference for more information.

Used in the following template files:
functions.php

<h3>str_replace()</h3>
str_replace() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.str-replace.php

str_replace() is used to replace all occurrences of the search string with
the replacement string 

str_replace() returns a string or array (depending on what arguments are passed)
that contains the replaced strings.

str_replace( $search, $replace, $subject, $count ) accepts arguments:
 - $search: string to be replaced. Can be a string, or an array of strings
 - $replace: string with which to replace. Can be a string, or an array of strings.
 - $subject: string from within to search/replace. Can be a string, or an arrya of strings.
 - $count: integer. If passed, holds the number of replacements performed.

Used in the following template files:
functions.php

<h3>the_author()</h3>
the_author() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_author

the_author() is used to display the Post Author for the current post.

the_author()  accepts no arguments.

Example:
the_author();

To get the Post Author without displaying it, use get_the_author().

the_author()  must be used within the Loop.

Used in the following template files:
post-footer.php

<h3>the_category()</h3>
the_category() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_category

the_category() is used to display a list of links to categories to which the post belongs.

the_category( $separator, $parents, $postid ) accepts three arguments:
 - $separator: separator list between categories. Defaults to placing categories in an unordered list (<ul>)
 - $parents: accepts 'multiple' or 'single':
      - 'multiple': Display separate links to parent/child categories, exhibiting parent/child relationship
	  - 'single': Display link to child categories only (default)
 - $postid: ID of post for which categories to list. Defaults to ID of current post.

Example:
the_category( ', '); displays: "Category1, Category2, Category3"

the_category() prints (displays/outputs) the data requested. To get, but not display/output the data, use get_category() instead.

the_category() must be used within the Loop, unless the $postid argument is specified.

Used in the following template files:
functions.php, post-header.php

<h3>the_content()</h3>
the_content() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_content

the_content() is used to display the Post Content for the current post.

the_content( $more_link_text, $strip_teaser )  accepts two arguments:
 - $more_link_text: string to display for the "read more" link, if <!--more--> is used in the post. Defaults to '(more...)'.
 - $strip_teaser: boolean (true/false); 'false' displays the content before <!--more-->; 'false' hides this content on single.php. Defaults to 'false'

Example:
the_content();

To get the Post Content without displaying it, use get_the_content().

the_content()  must be used within the Loop.

Used in the following template files:
post-entry.php

<h3>the_date()</h3>
the_date() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_date

the_date() is used to display the Post Date.

the_date( $d ) accepts one argument:
 -$d: date format (per PHP date() function). Defaults to time format configured in General Settings

Example:
the_date( 'Y' ); displays the year the post was published, e.g. '2010'.

the_date() must be used within the Loop.

Used in the following template files:
post-footer.php

<h3>the_excerpt()</h3>
the_excerpt() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_excerpt

the_excerpt() is used to display the Post Excerpt for the current post.

the_excerpt()  accepts no arguments.

Example:
the_excerpt();

To get the Post Excerpt without displaying it, use get_the_excerpt().

the_excerpt()  must be used within the Loop.

Used in the following template files:
post-entry.php, post-entry-image

<h3>the_ID()</h3>
the_ID() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_ID

the_ID() is used to display the Post ID for the current post.

the_ID()  accepts no arguments.

Example:
the_ID();

To get the Post ID without displaying it, use get_the_ID().

the_ID()  must be used within the Loop.

Used in the following template files:
post-header.php

<h3>the_permalink()</h3>
the_permalink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_permalink

the_permalink() is used to display the permalink URL for the current post. This tag
returns only the permalink URL, not a fully formed HTML anchor tag.

the_permalink() accepts no arguments.

Example:
<a href="the_permalink();">Permalink</a>

the_permalink() must be used within the Loop.

Used in the following template files:
post-header.php

<h3>the_post()</h3>
the_post() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/User:Jefte/the_post

the_post() is used to output the content of each post. It is primarily used in conjunction
with have_posts() as part of the call to the Loop.

Example (the Loop):
if ( have_posts() ) : while ( have_posts() ) : the_post();

Used in the following template files:
loop.php

<h3>the_post_thumbnail()</h3>
the_post_thumbnail() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_post_thumbnail

the_post_thumbnail() is used to display the post thumbnail for the current post.

the_post_thumbnail( $size, $attr ) accepts two arguments:
 - $size: size of the thumbnail image:
     - 'thumbnail' (default)
	 - 'medium'
	 - 'large'
	 - 'full'
	 - array( 'W', 'H' , $crop )
	      - 'W': width, in pixels
		  - 'H': height, in pixels
		  - $crop: boolean (true/false) forced-cropping of image to specified dimensions. Defaults to 'false'
 - $attr: used to override default attributes, such as src, alt, title, or class

Example:
the_post_thumbnail();

the_post_thumbnail() must be used within the Loop.

Post Thumbnails support must be defined and configured. Refer to functions.php for more information.

Used in the following template files:
post-entry.php, post-header.php

<h3>the_search_query()</h3>
the_search_query() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_search_query

the_search_query() displays the current search query entered via the search form.

the_search_query() accepts no arguments.

Example:
'Search results for "the_search_query();" search' will display (assuming
the user entered 'lorem ipsum' as the search query): 'Search results for "lorem ipsum" search'

Used in the following template files:
loop-header.php

<h3>the_shortlink()</h3>
the_shortlink() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_shortlink

the_shortlink() is used to display the Shortlink for the current post.

This tag returns the full HTML anchor tag, rather than just the URL of the Shortlink. To retrieve just 
the URL, use wp_get_shortlink().

the_shortlink( $text, $title, $before, $after ) accepts four arguments:
 - $text: Link text to display. Defaults to 'This is the shortlink'.
 - $title: HTML anchor tag title attribute text (displays in tooltip on hover). Defaults to Post Title.
 - $before: string to display before the Shortlink. Defaults to no text.
 - $after: string to display after the Shortlink. Defaults to no text.

Example:
the_shortlink( 'Shortlink' ); displays: <a href="[shortlink URL]" title="[Post Title]">Shortlink</a>.

the_shortlink() must be used within the Loop.

Used in the following template files:
post-header.php

<h3>the_tags()</h3>
the_tags() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_tags

the_tags() is used to display a list of links to tags to which the post belongs.

the_tags( $before, $separator, $after ) accepts three arguments:
 - $before: string to display before the tag list. Defaults to "Tags: ".
 - $separator: string/character to display between tags. Defaults to ", ".
 - $after: string to display after the tag list. Defaults to no text.

Example:
the_tags();

the_tags() must be used within the Loop.

Used in the following template files:
post-header.php

<h3>the_time()</h3>
the_time() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_time

the_time() is used to display the Post Time.

the_time( $d ) accepts one argument:
 -$d: time format (per PHP date() function). Defaults to time format configured in General Settings

Example:
the_time( 'Y' ); displays the year the post was published, e.g. '2010'.

the_time() prints the date. To get (return) the date but not print it, use get_the_time().

the_time() must be used within the Loop.

Used in the following template files:
post-footer.php, post-header.php

<h3>the_title()</h3>
the_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_title

the_title() is used to display the Post Title of the current post.

the_title( $before, $after, $echo ) accepts three arguments:
 - $before: text string to display before the title. Defaults to no text.
 - $after:text string to display after the title. Defautls to no text.
 - $echo: boolean (true/false). 'True' displays the title; 'false' does not (for use in functions, etc.). Defaults to 'true'.

Example:
the_title();

the_title() must be used within the Loop.

Used in the following template files:
comments.php, post-header.php

<h3>the_widget()</h3>
the_widget() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/the_widget

the_widget() is used to output a Widget anywhere within a Theme. This tag allows Widgets to be
displayed outside of a Widgetized sidebar. The tag can also be used to output "default" Widgets that will 
display in a defined Widgetized sidebar location if no Widgets are defined (by the user) to appear in
the sidebar.

the_widget( 'WP_Widget_Calendar' ) will display the Calendar Widget.

the_widget( $widget, $instance, $args ) accepts 3 arguments:
 - $widget: name of the Widget to be output (can be a core Widget, such as WP_Widget_Calendar, or a custom, Theme-defined Widget)
 - $instance: Widget instance settings (e.g. Title)
 - $args:  Widget arguments (before_widget, after_widget, before_title,after_title, etc.)

the_widget() can be used anywhere within a template.

Used in the following template files:
sidebar-left.php, sidebar-right.php

<h3>trim()</h3>
trim() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.trim.php

trim() is used to strip whitespace or characters from the beginning
and end of a string

trim( $string ) accepts arguments:
 - $string: string to be trimmed

Used in the following template files:
functions.php

<h3>urldecode()</h3>
urldecode() is a PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.urlencode.php

urldecode() is used to URL-encode a string

urldecode() returns a string in which all non-alphanumeric characters except -_. 
have been replaced with a percent (%) sign followed by two hex digits and spaces 
encoded as plus (+) signs. It is encoded the same way that the posted data from a 
WWW form is encoded, that is the same way as in application/x-www-form-urlencoded 
media type.

urldecode( $string ) accepts arguments:
 - $string: string to URL-encode

Used in the following template files:
functions.php

<h3>wp_attachment_is_image()</h3>
wp_attachment_is_image() is a WordPress template conditional tag
Codex reference: http://codex.wordpress.org/Function_Reference/is_attachment

wp_attachment_is_image() is a boolean (returns TRUE or FALSE) conditional tag that returns true if 
the current post's attachment is an image.

Used in the following template files:
post-entry.php

<h3>wp_enqueue_script()</h3>
wp_enqueue_script() is a WordPress filter hook.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_enqueue_script

wp_enqueue_script() is used as a safe way to add JavaScript to displayed pages. WordPress 
maintains a "queue" of javascript files to load when a page is displayed. The wp_enqueue_script()
filter enables a Theme or Plugin to add its own javascript files to this queue. 

Using wp_enqueue_script() facilitates the addition of javascript files only on pages where they
are needed, and will ensure that the same javascript file (e.g. jQuery) is not loaded multiple times.

Used in the following template files:
header.php

<h3>wp_footer()</h3>
wp_footer() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer

wp_footer() is used by themes/plugins, usually to insert content into the WordPress Theme footer.

Used in the following template files:
404.php, index.php, page.php

<h3>wp_get_attachment_image()</h3>
wp_get_attachment_image() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_attachment_image

wp_get_attachment_image() is used to return an HTML image tag for an attachment image

wp_get_attachment_image( $id, $size, $icon ) accepts arguments:
 - $id: the ID of the attachment
 - $size: string ("thumbnail", "large", etc.), or array ( array('width','height') ). Default: "thumbnail"
 - $icon: boolean: return the media icon for the attachment (TRUE).  Default: FALSE 

Used in the following template files:
functions.php

<h3>wp_get_attachment_link()</h3>
wp_get_attachment_link() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_attachment_link

wp_get_attachment_link() is used to return an HTML hyperlink to an attachment
page or file. 

wp_get_attachment_link( $id, $size, $permalink, $icon ) accepts four arguments:
 - $id: the ID of the attachment
 - $size: string ("thumbnail", "large", etc.), or array ( array('width','height') ). Default: "thumbnail"
 - $permalink: boolean: return permalink (TRUE) or the file directly (FALSE). Default: TRUE
 - $icon: boolean: return the media icon for the attachment (TRUE).  Default: FALSE

Used in the following template files:
functions.php

<h3>wp_get_current_user()</h3>
wp_get_current_user() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_current_user

wp_get_current_user() is used to retrieve the information contained in the 
$current_user global variable.

wp_get_current_user() accepts no arguments.

Example:
wp_get_current_user();
echo $current_user->display_name; will display e.g. "John Smith"

Used in the following template files:
infobar.php

<h3>wp_get_post_categories()</h3>
wp_get_post_categories() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_get_post_categories

wp_get_post_categories() is used to retrieve the list of categories for a post

wp_get_post_categories() returns an array of Category IDs.

wp_get_post_categories( $id, $args ) accepts arguments:
 - $id: PostID for which to retrieve the categories
 - $args: an array of arguments. See Codex.

Used in the following template files:
functions.php

<h3>wp_head()</h3>
wp_head() is a WordPress action hook.
Codex reference: http://codex.wordpress.org/Hook_Reference/wp_head

wp_head() is used by themes/plugins, usually to insert content into the HTML <head>.

Used in the following template files:
header.php

<h3>wp_link_pages()</h3>
wp_link_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_link_pages

wp_link_pages() is used to output page links for paginated posts. 

wp_link_pages( '&arg1=value1&arg2=value2' ) accepts several arguments, in array format.
 - 'before': text string to display before the output. Default:'<p>Pages:'
 - 'after':  text string to display after the output. Default: '</p>'
 - 'link_before': text string to output before each link. Default: NULL 
 - 'link_after': text string to output after each link. Default: NULL
 - 'next_or_number': display either "Previous/Next" links ('next') or page numbers ('number'). Default: 'number'
 - 'nextpagelink': text string to display for "Next" page link (if 'next_or_number' is 'next'. Default: 'Next page'
 - 'previouspagelink':text string to display for "Previous" page link (if 'next_or_number' is 'next'. Default: 'Previous page'
 - 'pagelink': text string to display for page numbers (if 'next_or_number' is 'number'), where % returns the page number. Default: '%'
 - 'more_file': page to which the link points. Default: NULL (i.e. current post) 
 - 'echo': (boolean) output (print/display) or return (for use in PHP) the output. Default: 1 (i.e. TRUE; print/display output)

Example:
wp_link_pages( 'before=<p class="link-pages">Page: ' ); 
 - outputs e.g.: '<p class="link-pages">Pages: 1 2 3</p>'

wp_link_pages() must be used within the Loop.

Used in the following template files:
post-entry.php

<h3>wp_list_comments()</h3>
wp_list_comments() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_comments

wp_list_comments() is used to display the comments associated with a given post.

wp_list_comments( array( 'arg1' => 'value' , 'arg2' => 'value' ) ) accepts several arguments, in the form of an array. Some of the more useful arguments:
 - max_depth: for threaded comments, the maximum thread depth. Defaults to user-configured setting in Settings -> Discussion.
 - style: HTML structure for the comment list. Can be 'ul', 'ol', or 'div'. Defaults to 'ul'.
     - Note: if using 'div' or 'ol', wp_list_comments() must be wrapped in a containing element of the specified type (i.e. <div></div> or <ol></ol>)
 - type: comment type to include. Can be 'all', 'comment', 'trackback', 'pingback', or 'pings' (both trackbacks and pingbacks). Defaults to 'all'
 - avatar_size: size (px) of the user avatar. Can be any interger value between '1' and '512'. Defaults to '32'.
 - per_page: number of comments to display per comments page. Defaults to user-configured setting in Settings -> Discussion.
 - reverse_top_level: if TRUE, will display the newest comments first. Defaults to user-configured setting in Settings -> Discussion.
 
Example:
	wp_list_comments( 'type=comment&avatar_size=40' ); displays comments that are "comment" type (no pingbacks or trackbacks),
with an avatar size of 40px.

wp_list_comments() must be used from within the Loop.

Used in the following template files:
comments.php

<h3>wp_list_pages()</h3>
wp_list_pages() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_list_pages

wp_list_pages() is used to output a list of pages (as links). This function is
extremely powerful,  with several available arguments, including depth of
hierarchy to display, pages (or hierarchies) to include/exclude, display order
(ascending/descending/menu order).

To see the full list of arguments for wp_list_pages(), see the Codex.

Used in the following template files:
sidebar-left.php, site-navigation.php

<h3>wp_loginout()</h3>
wp_loginout() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_loginout

wp_loginout() displays a login link if user is logged out, or a logout link if user is logged in.

wp_loginout() accepts 1 argument:
 - $redirect: redirect location after login/out. Defaults to no redirect (current location)

Used in the following template files:
infobar.php

<h3>wp_nav_menu()</h3>
get_template_part() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_nav_menu

wp_nav_menu( $menu ) is used to output a nav menu named $menu. This menu must be configured
in the Menus administration panel.

wp_nav_menu() (note: no argument for a specific menu) is used to output the default nav menu. This
menu must be configured in the Menus administration panel.

Used in the following template files:
sidebar-left.php, site-navigation.php

<h3>wp_paginate()</h3>
wp_paginate() is a custom function for the WP-Paginate plugin
Codex reference: N/A
Plugin reference: http://wordpress.org/extend/plugins/wp-paginate/

wp_paginate() accepts one argument, that can be used to override default settings.
Refer to the plugin reference for more information.

wp_paginate() is used to output page numbers, in place of Previous/Next Post links.

wp_paginate() must be used within the Loop.

Used in the following template files:
functions.php, loop-footer.php

<h3>wp_register()</h3>
wp_register() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_register

wp_register() displays a registration link if user is logged out and user registration is 
permitted; otherwise, displays a link to site admin (Dashboard) if user is logged in.

wp_register() accepts 3 arguments:
 - $before: string to display before link. Defaults to '<li>'
 - $after:  string to display after link. Defaults to '</li>'
 - $echo: return result boolean (true/false). Defaults to 'true'

Example:
wp_register( '' , '' ); returns the Registration or Site Admin link, without wrapping
in <li></li> tags.

Used in the following template files:
infobar.php

<h3>wp_title</h3>
wp_title() is a WordPress template tag.
Codex reference: http://codex.wordpress.org/Template_Tags/wp_title
	
wp_title() is a WordPress template tag used to display the title of a page:

	(Post Name for single.php, Date for date-based archive, Category for category archive, etc.)

Used in the following template files:
header.php

<h3>wp_upload_dir()</h3>
wp_upload_dir() is a WordPress function.
Codex reference: http://codex.wordpress.org/Function_Reference/wp_upload_dir

wp_upload_dir() is used to return an array of information regarding the
current upload directory.

wp_upload_dir() returns the following $key => $value pairs:
 - [path] - base directory and sub directory or full path to upload directory
 - [url] - base url and sub directory or absolute URL to upload directory.
 - [subdir] - sub directory if uploads use year/month folders option is on.
 - [basedir] - path without subdir.
 - [baseurl] - URL path without subdir.
 - [error] - set to false.

wp_upload_dir( $time ) accepts arguments:
 - $time: time, as a string, formatted as 'yyyy/mm'. Default: null.

Example:

$upload_dir = wp_upload_dir();
echo $upload_dir['baseurl'];

 - returns "http://www.mydomain.tld/wp-content/uploads/"

Used in the following template files:
functions.php

=============================================================================	

Hooks
/*
after_setup_theme
get_comments_number
widgets_init
wp_list_categories
wp_title
*/

Global Variables
/*
$page
$paged
$post
$wpdb
*/

<?php }
?>