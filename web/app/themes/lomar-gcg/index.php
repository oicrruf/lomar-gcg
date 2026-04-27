<?php
// Fallback template — WordPress requires this file.
get_template_part( 'template-parts/header' );
if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();
        the_content();
    endwhile;
endif;
get_template_part( 'template-parts/footer' );
