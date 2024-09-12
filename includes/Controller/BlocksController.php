<?php
/**
 * Blocks Controller Class.
 *
 * @since 1.0.0
 * @package MeroGutenForms
 */

namespace MeroGutenForms\Controller;

use MeroGutenForms\Traits\Singleton;
use MeroGutenForms\BlockTypes\AddNewForm;

defined( 'ABSPATH' ) || exit;

class BlocksController {
	use Singleton;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {
		$this->init_hooks();
	}

	/**
	 * Init hooks.
	 *
	 * @since 1.0.0
	 */
	private function init_hooks() {
		add_filter( 'block_categories_all', array( $this, 'block_categories' ), PHP_INT_MAX, 2 );
		add_action( 'init', array( $this, 'register_block_types' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'enqueue_block_editor_assets' ) );
	}

	/**
	 * Enqueue Block Editor Assets.
	 *
	 * @since 1.0.0
	 * @return void.
	 */
	public function enqueue_block_editor_assets() {

		$enqueue_script = array( 'wp-blocks', 'wp-element', 'wp-i18n', 'wp-editor', 'wp-components', 'react', 'react-dom' );
		wp_register_script(
			'mero-guten-forms-block-editor',
			$this->plugin_url() . '/build/blocks.min.js',
			$enqueue_script,
			MGF_VERSION,
			true
		);

		wp_enqueue_script( 'mero-guten-forms-block-editor' );
	}
	/**
	 * PLugin url.
	 *
	 * @since 1.0.0
	 * @param string $path
	 * @return void
	 */
	public function plugin_url( $path = '/' ) {
		return untrailingslashit( plugins_url( $path, MGF_PLUGIN_FILE ) );
	}
	/**
	 * Add "Mero Guten Forms" category to the blocks listing in post edit screen.
	 *
	 * @param array $block_categories All registered block categories.
	 * @return array
	 * @since 1.0.0
	 */
	public function block_categories( array $block_categories ) {

		return array_merge(
			array(
				array(
					'slug'  => 'mero-guten-forms',
					'title' => esc_html__( 'Mero Guten Forms', 'mero-guten-forms' ),
				),
			),
			$block_categories
		);
	}
	/**
	 * Register block types.
	 *
	 * @return void
	 */
	public function register_block_types() {
		$block_types = $this->get_block_types();
		foreach ( $block_types as $block_type ) {
			$block_type::instance();
		}
	}

	/**
	 * Get block types.
	 *
	 * @return AbstractBlock[]
	 */
	private function get_block_types() {

		$class = array(
			AddNewForm::class, //phpcs:ignore;
		);

		return apply_filters(
			'mgf_block_types',
			$class
		);
	}
}
