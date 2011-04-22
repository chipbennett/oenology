<?php if ( ! is_singular() ) { ?>
<ul id="loop-footer">
<li id="bottompostnav">
<?php oenology_paginate_archive_page_links( 'list', 1, 3 ); ?>
</li>
</ul>
<?php } 

/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

***********************
function_exists()
----------------------------------
function_exists() is a boolean (returns TRUE or FALSE) conditional PHP function.
Codex reference: N/A
PHP reference: http://php.net/manual/en/function.function-exists.php

function_exists( 'foo' ) returns TRUE if a function named foo() is found; otherwise, it returns FALSE.

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
posts_nav_link()
----------------------------------
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
<?php posts_nav_link('&nbsp;&diams;&nbsp;','&laquo;&laquo; Newer Posts','Older Posts &raquo;&raquo;'); ?>
Displays '<< Newer Posts' and 'Older Posts >>', with diamonds as a separator.

posts_nav_link() must be used within the Loop.

***********************
wp_paginate()
----------------------------------
wp_paginate() is a custom function for the WP-Paginate plugin
Codex reference: N/A
Plugin reference: http://wordpress.org/extend/plugins/wp-paginate/

wp_paginate() accepts one argument, that can be used to override default settings.
Refer to the plugin reference for more information.

wp_paginate() is used to output page numbers, in place of Previous/Next Post links.

wp_paginate() must be used within the Loop.

=============================================================================
*/ ?> 
