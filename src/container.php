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
	$container = wx_container();

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

/**
 * Get the container instance.
 *
 * @return \Isotop\Wx\Container
 */
function wx_container() {
	return Container::instance();
}

/**
 * Determine if a key exists in the container or not.
 *
 * @param  string $key
 *
 * @return bool
 */
function wx_container_exists( $key ) {
	return wx_container()->bound( $key );
}

/**
 * Get value from container by key.
 *
 * @param  string $key
 * @param  array  $parameters
 * @param  mixed  $default
 *
 * @return mixed
 */
function wx_container_get( $key, array $parameters = [], $default = null ) {
	$container = wx_container();

	if ( $container->bound( $key ) ) {
		return $container->make( $key, $parameters );
	}

	return $default;
}

/**
 * Set value in container by key.
 *
 * @param  string $key
 * @param  mixed  $default
 * @param  bool   $singleton
 *
 * @return mixed
 */
function wx_container_set( $key, $value, $singleton = false ) {
	return wx_container()->bind( $key, $value, $singleton );
}

/**
 * Delete value in container by key.
 *
 * @param  string $key
 */
function wx_container_delete( $key ) {
	wx_container()->remove( $key );
}
