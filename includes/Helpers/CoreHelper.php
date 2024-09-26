<?php
/**
 * CoreHelper.
 *
 * @since 1.0.0
 * @package MeroGutenForms\Helpers\CoreHelper
 */

namespace MeroGutenForms\Helpers;

/**
 * CoreHelper class.
 *
 * @since 1.0.0
 */
class CoreHelper {
	/**
	 * Check the env is development or not.
	 *
	 * @since 1.0.0
	 * @return boolean
	 */
	public static function is_development() {
		return defined( 'MGF_DEVELOPMENT' ) && MGF_DEVELOPMENT;
	}
}
