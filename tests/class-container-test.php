<?php

namespace Isotop\Tests\Wx;

use Isotop\Wx\Container;

class Container_Test extends \WP_UnitTestCase {

	public function test_wx_get_once() {
		$key = __FUNCTION__;

		$value = wx_get_once( $key, function () {
			return 'hello';
		} );

		$this->assertSame( 'hello', $value );
		$this->assertTrue( Container::instance()->bound( $key ) );

		$value = wx_get_once( $key, function () {
			$this->assertFalse( true );
		} );

		$this->assertSame( 'hello', $value );
	}

	public function test_wx_container_exists() {
		$key = __FUNCTION__;
		$this->assertFalse( wx_container_exists( $key ) );

		wx_container_set( $key, 'hello' );
		$this->assertTrue( wx_container_exists( $key ) );
	}

	public function test_wx_container_get() {
		$key = __FUNCTION__;
		$this->assertNull( wx_container_get( $key ) );

		wx_container_set( $key, 'hello' );
		$this->assertSame( 'hello', wx_container_get( $key ) );
	}

	public function test_wx_container_set() {
		$key = __FUNCTION__;
		$this->assertNull( wx_container_get( $key ) );

		wx_container_set( $key, 'hello' );
		$this->assertSame( 'hello', wx_container_get( $key ) );
	}

	public function test_wx_container_delete() {
		$key = __FUNCTION__;
		$this->assertNull( wx_container_get( $key ) );

		wx_container_set( $key, 'hello' );
		$this->assertSame( 'hello', wx_container_get( $key ) );

		wx_container_delete( $key );
		$this->assertNull( wx_container_get( $key ) );
	}
}
