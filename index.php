<?php
/**
 * The main template file.
 * 
 * @package Architettura WordPress theme
 */ 

get_header(); ?>

<?php do_action( 'architettura_page_header' ); ?>

<?php do_action( 'architettura_before_container' ); ?>
    
    <div class="auto-container">

        <div class="row clearfix">

            <?php do_action( 'architettura_before_container_inner' ); ?>

            <?php if ( have_posts() ) : ?>
            
                <?php do_action( 'architettura_before_loop' ); ?>

                    <?php while ( have_posts() ) : the_post(); ?>

                        <?php get_template_part( 'partials/archive/layout' ); ?>

                    <?php endwhile; ?>
                   
                    <?php do_action( 'architettura_after_loop' ); ?>

                <?php do_action( 'architettura_before_pagination' ); ?>

                    <?php architettura_pagination(); ?>

                <?php do_action( 'architettura_after_pagination' ); ?>

            <?php else : ?>

                <?php get_template_part( 'partials/none' ); ?>

            <?php endif; ?>

            <?php do_action( 'architettura_after_container_inner' ); ?>
            
            <?php get_sidebar(); ?>
            
        </div>

    </div>

<?php do_action( 'architettura_after_container' ); ?>

<?php get_footer(); ?>