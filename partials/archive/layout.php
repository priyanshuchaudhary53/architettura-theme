<?php
/**
 * Default post entry layout
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<?php if ( 'large-image' == get_theme_mod( 'architettura_blog_style', 'large-image') ) : ?>

    <div class="news-block-three">
        <div class="inner-box">
            <?php if ( has_post_thumbnail() ) : ?>
            <div class="image-box">
                <figure class="image"><a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt=""></a></figure>
                <span class="date"><a href="<?php echo get_day_link( get_the_time( 'Y' ), get_the_time( 'm' ), get_the_time( 'd' ) ); ?>"><?php the_time( 'j M Y' ); ?></a></span>
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
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <div class="text"><?php the_excerpt(); ?></div>
                <div class="link-box"><a href="<?php the_permalink(); ?>" class="theme-btn read-more">Read more</a></div>
            </div>
        </div>
    </div>

<?php else: ?>

    <div class="news-block-two style-two col-lg-6 col-md-12 col-sm-12">
        <div class="inner-box wow fadeInLeft" data-wow-delay="0ms" data-wow-duration="1500ms">
            <?php if ( has_post_thumbnail() ) : ?>    
            <div class="image">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo get_the_post_thumbnail_url( get_the_ID(), 'full' ); ?>" alt="" /></a>
            </div>
            <?php endif; ?>
            <div class="lower-content">
                <div class="upper-box clearfix">
                    <div class="posted-date"><?php the_time( 'j F Y' ); ?></div>
                    <ul class="post-meta">
                        <li>By :  <?php the_author(); ?></li>
                        <?php if ( get_post_type() == 'post' ) : ?>
                        <li><?php architettura_category_without_link(); ?></li>
                        <?php endif; ?>
                        <li><?php do_action( 'architettura_comments_count' ); ?></li>
                    </ul>
                </div>
                <div class="lower-box">
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="text"><?php the_excerpt(); ?></div>
                    <a href="<?php the_permalink(); ?>" class="theme-btn read-more">Read more</a>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>