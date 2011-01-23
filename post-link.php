<div class="post-entry">

	<!-- Post Entry Begin -->
	<?php get_template_part('post-entry'); // post-entry.php contains the post content ?>
	<!-- Post Entry End -->

</div>

<div class="post-footer">

	<!-- Post footer Begin -->
	<?php get_template_part('post-footer'); // post-footer.php contains post timestamp and copyright information ?>
	<!-- Post Footer End -->
			
</div>

<?php
/*
Reference:
=============================================================================
The following functions, tags, and hooks are used (or referenced) in this Theme template file:

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