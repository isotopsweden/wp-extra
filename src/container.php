<?php

use Isotop\Wx\Container;

/**
 * Get value once as long as it don't return null.
 *
 * Like a global container that only lives under one page request.
 *
 * @param  string    $key
 * @param  callbable $fn
 * @param  mixed     $default
 *
 * @return mixed
 */
function wx_get_once( $key, $fn = null, $default = null ) {
	$container = Container::instance();

	// Check if key exists in the container and return value if so.
	if ( $container->bound( $key ) ) {
		return $container->make( $key );
	}

	// Bail if provided function is not a function and return default value.
	if ( ! is_callable( $fn ) ) {
		return $default;
	}

	// Call the provided function if no existing data is found.
	$value = call_user_func( $fn );

	// Bail if the returning value is `null` and return the default value.
	if ( is_null( $value ) ) {
		return $default;
	}

	return $container->bind( $key, $value );
}
