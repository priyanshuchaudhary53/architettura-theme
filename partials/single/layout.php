<?php
/**
 * Outputs correct post layout
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="inner-box clearfix">

    <?php if ( has_post_thumbnail() ) : ?>
        <div class="image-box">
            <figure class="image"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt=""></figure>
            <span class="date"><?php the_time( 'j M Y' ); ?></span>
        </div>
    <?php endif; ?>

    <div class="lower-content">

        <div class="post-meta">
            <ul class="post-info clearfix">
                <li>By : <?php the_author_posts_link(); ?></li>
                <?php if ( ! has_post_thumbnail() ) : ?>
                    <li><a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>"><?php the_time( 'j M Y' ); ?></a></li>
                <?php endif; ?>
                <?php if ( get_post_type() == 'post' ) : ?>
                        <li><?php echo get_the_category_list( ', ' ); ?></li>
                        <?php endif; ?>
                <li><a href="<?php the_permalink(); ?>#comments"><?php do_action( 'architettura_comments_count' ); ?></a></li>
            </ul>
        </div>

        <?php get_template_part( 'partials/single/content' ); ?>

    </div>

</div>

<?php
comments_template();