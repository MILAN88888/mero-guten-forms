<?php
/**
 * MeroGutenForms main class.
 *
 * This file is responsible for managing all blocks and block categories
 * used within the MeroGutenForms plugin. It includes functionality for
 * registering, rendering, and categorizing blocks to be used in the
 * Gutenberg editor.
 *
 * @since 1.0.0
 * @package MeroGutenForms
 */

namespace MeroGutenForms;

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

use MeroGutenForms\Controller\Admin\MenuController;
use MeroGutenForms\Controller\BlocksController;
use MeroGutenForms\Traits\Singleton;

/**
 * MeroGutenForms setup.
 *
 * Include and initialize necessary files and classes for the plugin.
 *
 * @since   1.0.0
 */
final class MeroGutenForms {

	use Singleton;

	/**
	 * Plugin Constructor.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	protected function __construct() {
		MenuController::instance();
		BlocksController::instance();
	}
}
