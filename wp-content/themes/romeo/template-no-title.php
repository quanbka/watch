<?php
/**
 * Template Name: No Title Page
 */

get_header(); ?>
<div id="main-content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    		<?php
            if ( has_post_thumbnail() ) {
                the_post_thumbnail();
               }
        ?>

        	<?php the_content(); ?>

          <?php if (get_comments_number()==0) {
                  comment_form();
              } else {
                  comments_template();
              } ?>

            <?php wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'romeo' ),
                'after'  => '</div>',
            ) );

endwhile; endif; ?>

</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
