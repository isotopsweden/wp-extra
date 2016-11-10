<?php

namespace Isotop\Tests\Wx;

use Isotop\Wx\Container;

class Container_Test extends \WP_UnitTestCase {

	public function test_wp_get_once() {
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

}
