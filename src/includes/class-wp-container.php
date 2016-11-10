<?php

namespace Isotop\Wx;

use Frozzare\Tank\Container as Base;

class Container extends Base {

	/**
	 * Get the container instance.
	 *
	 * @return WP_Container
	 */
	public static function instance() {
		if ( ! isset( static::$instance ) ) {
			static::$instance = new static;
		}

		return static::$instance;
	}
}
