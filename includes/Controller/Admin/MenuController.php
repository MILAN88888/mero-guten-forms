<?php
/**
 * Admin Menu Controller Class.
 *
 * @since 1.0.0
 * @package MeroGutenForms
 */

namespace MeroGutenForms\Controller\Admin;

use MeroGutenForms\Traits\Singleton;

defined( 'ABSPATH' ) || exit;

class MenuController {
	use Singleton;

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	protected function __construct() {
		add_action( 'admin_menu', array( $this, 'menu_init' ) );
	}
	/**
	 * Add menu items.
	 */
	public function menu_init() {
			$svg    = '<svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="96.433px" height="96.433px" viewBox="0 0 96.433 96.433" style="enable-background:new 0 0 96.433 96.433;"
	 xml:space="preserve">
<g>
	<g>
		<path d="M24.82,48.678c5.422,0,9.832-6.644,9.832-14.811c0-8.165-4.41-14.809-9.832-14.809s-9.833,6.644-9.833,14.809
			C14.987,42.034,19.399,48.678,24.82,48.678z"/>
		<path d="M71.606,48.678c5.422,0,9.833-6.644,9.833-14.811c0-8.165-4.411-14.809-9.833-14.809c-5.421,0-9.831,6.644-9.831,14.809
			C61.775,42.034,66.186,48.678,71.606,48.678z"/>
		<path d="M95.855,55.806c-0.6-0.605-1.516-0.77-2.285-0.4C81.232,61.29,65.125,64.53,48.214,64.53
			c-16.907,0-33.015-3.24-45.354-9.123c-0.77-0.367-1.688-0.205-2.284,0.4c-0.599,0.606-0.747,1.526-0.369,2.29
			c5.606,11.351,25.349,19.277,48.008,19.277c22.668,0,42.412-7.929,48.012-19.279C96.603,57.332,96.453,56.411,95.855,55.806z"/>
	</g>
</g>
</svg>';
		$base64_svg = 'data:image/svg+xml;base64,' . base64_encode($svg); // phpcs:ignore
		add_menu_page( esc_html__( 'MeroGutenForms', 'mero-guten-forms' ), esc_html__( 'MeroGutenForms', 'mero-guten-forms' ), 'manage_options', 'mero-guten-forms', array( $this, 'main_page' ), $base64_svg );
	}

	/**
	 * Handles output of the main page.
	 *
	 * @since 1.0.0
	 */
	public function main_page() {

		if ( ! is_admin_bar_showing() ) {
			return;
		}

		if ( ! empty( $_GET['page'] ) && 'mero-guten-forms' === $_GET['page'] ) { //phpcs:ignore WordPress.Security.NonceVerification
			ob_start();
			$this->body();
			$this->footer();
			exit;
		}
	}

	/**
	 * Page body content.
	 *
	 * @since 1.0.0
	 */
	protected function body() {
		?>
			<body class="mero-guten-forms notranslate" translate="no">
				<div id="mero_guten_forms">MeroGutenForms</div>
			</body>
		<?php
	}

	/**
	 * Page footer content.
	 *
	 * @since 1.0.0
	 */
	protected function footer() {
		if ( function_exists( 'wp_print_media_templates' ) ) {
			wp_print_media_templates();
		}
		wp_print_footer_scripts();
		wp_print_scripts( 'ccsnpt-script' );
		?>
		</html>
		<?php
	}
}
