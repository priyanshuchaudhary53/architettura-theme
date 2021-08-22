<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package Architettura WordPress theme
 */
?>

<?php if ( is_home() && current_user_can( 'publish_posts' ) ) { ?>
    
    <p>Ready to publish your first post? <a href="<?php echo admin_url( 'post-new.php' ); ?>" target="_blank">Get started here</a>.</p>

<?php } elseif ( is_search() ) { ?>

    <p>Sorry, but nothing matched your search terms. Please try again with different keywords.</p>

<?php } elseif ( is_category() ) { ?>

    <p>There aren't any posts currently published in this category.</p>

<?php } elseif ( is_tag() ) { ?>

    <p>There aren't any posts currently published under this tag.</p>

<?php } else { ?>

    <p>It seems we can't find what you're looking for.</p>

<?php } ?>