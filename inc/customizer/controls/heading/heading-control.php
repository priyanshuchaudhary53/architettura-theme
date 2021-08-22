<?php
/**
 * Customizer Control: architettura-heading.
 *
 * @package     Architettura WordPress theme
 * @subpackage  Controls
 * @since       1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Range control
 */
class Architettura_Customizer_Heading_Control extends WP_Customize_Control {

	/**
	 * The control type.
	 *
	 * @access public
	 * @var string
	 */
	public $type = 'architettura-heading';

	/**
	 * Enqueue control related scripts/styles.
	 *
	 * @access public
	 */
	public function enqueue() {
		wp_enqueue_style( 'architettura-heading', ARCHITETTURA_INC_DIR_URI . 'customizer/controls/heading/heading.css', null );
	}

	/**
	 * An Underscore (JS) template for this control's content (but not its container).
	 *
	 * @access protected
	 */
	protected function content_template() {
		?>
		<h4 class="architettura-customizer-heading">{{{ data.label }}}</h4>
		<div class="description">{{{ data.description }}}</div>
		<?php
	}
}
