<?php
/**
 * Search entry layout
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="news-block-three">
    <div class="inner-box row">
        <div class="lower-content col">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="text"><?php the_excerpt(); ?></div>
            <div class="link-box"><a href="<?php the_permalink(); ?>" class="theme-btn read-more">Read more</a></div>
        </div>
    </div>
</div>