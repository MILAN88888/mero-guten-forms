<?php
/**
 * Plugin Name: MeroGutenForms
 * Plugin URI: https://wordpress.org/plugins/mero-guten-forms
 * Description: MeroGutenForms makes it easy to integrate and manage custom contact forms directly within the Gutenberg block editor, providing a seamless and user-friendly experience.
 * Version: 1.0.0
 * Author: MGF@Milan
 * Author URI: https://milanc.com.np/
 * Text Domain: mero-guten-forms
 * Domain Path: /languages/
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 5.2
 * Requires PHP: 7.4
 *
 * @package MeroGutenForms
 */


defined( 'ABSPATH' ) || exit;

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	/**
	 * Outputs an admin notice if composer install has not been ran.
	 */
	add_action(
		'admin_notices',
		function () {
			?>
			<div class="notice notice-error">
				<p>
					<?php
					printf(
						/* translators: 1: composer command. 2: plugin directory */
						esc_html__( 'Your installation of the  MeroGutenForms plugin is incomplete. Please run %1$s within the %2$s directory.', 'mero-guten-forms' ),
						'<code>composer install</code>',
						'<code>' . esc_html( str_replace( ABSPATH, '', __DIR__ ) ) . '</code>'
					);
					?>
				</p>
			</div>
			<?php
		}
	);
	return;
}

use MeroGutenForms\MeroGutenForms;

! defined( 'MGF_VERSION' ) && define( 'MGF_VERSION', '1.0.0' );
! defined( 'MGF_PLUGIN_FILE' ) && define( 'MGF_PLUGIN_FILE', __FILE__ );
! defined( 'MGF_PLUGIN_DIR' ) && define( 'MGF_PLUGIN_DIR', dirname( MGF_PLUGIN_FILE ) );
! defined( 'MGF_PLUGIN_DIR_URL' ) && define( 'MGF_PLUGIN_DIR_URL', plugin_dir_url( MGF_PLUGIN_FILE ) );
! defined( 'MGF_DIST_DIR' ) && define( 'MGF_DIST_DIR', MGF_PLUGIN_DIR . '/dist' );
! defined( 'MGF_ASSETS_DIR_URL' ) && define( 'MGF_ASSETS_DIR_URL', MGF_PLUGIN_DIR_URL . 'assets' );
! defined( 'MGF_DIST_DIR_URL' ) && define( 'MGF_DIST_DIR_URL', MGF_PLUGIN_DIR_URL . 'dist' );
! defined( 'MGF_LANGUAGES' ) && define( 'MGF_LANGUAGES', MGF_PLUGIN_DIR . '/languages' );
! defined( 'MGF_UPLOAD_DIR' ) && define( 'MGF_UPLOAD_DIR', wp_upload_dir()['basedir'] . '/mero-guten-forms' );
! defined( 'MGF_UPLOAD_DIR_URL' ) && define( 'MGF_UPLOAD_DIR_URL', wp_upload_dir()['baseurl'] . '/mero-guten-forms' );


if ( ! function_exists( 'mero_init' ) ) {
	/**
	 * Returns the main instance of MeroGutenForms to prevent the need to use globals.
	 *
	 * @return MeroGutenForms|null
	 */
	function mero_init() {
		return MeroGutenForms::instance();
	}

	mero_init();
}
