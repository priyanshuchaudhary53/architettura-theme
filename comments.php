<?php
/**
 * The template for displaying Comments.
 *
 * @package Architettura WordPress theme
 */

// Return if password is required.
if ( post_password_required() ) {
	return;
}

// Comment form args.
$args = array(
	'comment_notes_before' => false,
	'comment_notes_after'  => false,
	'comment_field'        => '<div class="comment-textarea"><label for="comment" class="screen-reader-text">Comment</label><textarea name="comment" id="comment" cols="39" rows="4" tabindex="0" class="textarea-comment" placeholder="Your comment here..."></textarea></div>',
);

?>

<div id="comments" class="comments-area">

    <?php 
    
    if ( have_comments() ) :

        // Get comments title.
		$comments_number = number_format_i18n( get_comments_number() );
		if ( '1' === $comments_number ) {
			$comments_title = 'Comment 1';
		} else {
			$comments_title = sprintf( 'Comments %s', $comments_number );
		}

        ?>

        <div class="group-title">
            <h2><?php echo $comments_title; ?></h2>
        </div>

        <ol class="comment-list">
			<?php
			// List comments.
			wp_list_comments(
				array(
					'callback' => 'architettura_comment',
					'style'    => 'ol',
					'format'   => 'html5',
				)
			);
			?>
		</ol>

        <?php
		// Display comments closed message.
		if ( ! comments_open() && get_comments_number() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'oceanwp' ); ?></p>
		<?php endif; ?>

    <?php endif; // have_comments() ?>

</div>

<div class="comment-form">

    <?php comment_form( $args ); ?>

</div>