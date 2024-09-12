<?php
/**
 * Abstract block class.
 *
 * @since 1.0.0
 * @package MeroGutenForms
 */

namespace MeroGutenForms\BlockTypes;

use MeroGutenForms\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

/**
 * Abstract class.
 *
 * @since 1.0.0
 */
abstract class Block {

	use Singleton;

	/**
	 * Block namespace.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected $namespace = 'mero-guten-forms';

	/**
	 * Block name.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected $block_name = '';

	/**
	 * Attributes.
	 *
	 * @since 1.0.0
	 * @var array
	 */
	protected $attributes = array();

	/**
	 * Block content.
	 *
	 * @since 1.0.0
	 * @var string
	 */
	protected $content = '';

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @param string $block_name Block name.
	 */
	public function __construct( $block_name = '' ) {
		error_log( print_r( $this->block_name, true ) );
		$this->block_name = empty( $block_name ) ? $this->block_name : $block_name;
		$this->register();
	}

	/**
	 * Register.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function register() {
		if ( empty( $this->block_name ) ) {
			_doing_it_wrong( __CLASS__, esc_html__( 'Block name is not set.', 'mero-guten-forms' ), '1.0.0' );
			return;
		}

		$metadata = $this->get_metadata_base_dir() . "/$this->block_name/block.json";

		if ( ! file_exists( $metadata ) ) {
			_doing_it_wrong(
				__CLASS__,
				/* Translators: 1: Block name */
				esc_html( sprintf( __( 'Metadata file for %s block does not exist.', 'mero-guten-forms' ), $this->block_name ) ),
				'2.0.9'
			);
			return;
		}
		register_block_type_from_metadata(
			$metadata,
			array(
				'render_callback' => array( $this, 'render' ),
			)
		);
	}

	/**
	 * Get base metadata path.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	protected function get_metadata_base_dir() {
		return dirname( MGF_PLUGIN_FILE ) . '/build';
	}

	/**
	 * Get block type.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	protected function get_block_type() {
		return "$this->namespace/$this->block_name";
	}

	/**
	 * Render callback.
	 *
	 * @param array     $attributes Block attributes.
	 * @param string    $content Block content.
	 * @param \WP_Block $block Block object.
	 *
	 * @since 1.0.0
	 * @return string
	 */
	public function render( $attributes, $content, $block ) {
		$this->attributes = $attributes;
		$this->block      = $block;
		$this->content    = $content;
		$content          = apply_filters(
			"everest_forms_{$this->block_name}_content",
			$this->build_html( $this->content ),
			$this
		);
		return $content;
	}

	/**
	 * Build html.
	 *
	 * @since 1.0.0
	 * @param string $content Build html content.
	 * @return string
	 */
	protected function build_html( $content ) {
		return $content;
	}
}
