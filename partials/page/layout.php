<?php
/**
 * Outputs correct page layout
 *
 * @package Architettura WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="inner-box">

<?php get_template_part( 'partials/page/article' ); ?>

</div>

<?php
comments_template();