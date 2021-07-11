<?php

namespace Yoast\WP\Free\Tests\Inc\Options;

namespace StaticMock\Classes\Message;

use WPSEO_Options;

/**
 * Class Options_Test
 *
 * @coversDefaultClass \WPSEO_Options
 * @package Yoast\WP\Free\Tests\Inc\Options
 *
 * @group options
 */
class Options_Test extends \Yoast\WP\Free\Tests\TestCase {

	public function setUp() {
		\Brain\Monkey\Functions\expect( 'get_option' )->andReturn( [] );
		\Brain\Monkey\Functions\expect( 'is_multisite' )->andReturn( true );

		parent::setUp();
	}

	/**
	 * @covers ::register_option
	 */
	public function test_register_option() {
		\Brain\Monkey\Functions\expect( 'is_multisite' )->andReturn( false );

		$option_instance = \Mockery::mock( '\WPSEO_Option' );
		$option_instance
			->expects( 'get_option_name' )
			->once()
			->andReturn( 'test_option' );

		WPSEO_Options::register_option( $option_instance );

		$this->assertEquals( WPSEO_Options::get_option_instance( 'test_option' ), $option_instance );
		$this->assertContains( 'test_option', WPSEO_Options::get_option_names() );
		$this->assertArrayHasKey( 'test_option', WPSEO_Options::$options );
	}

	/**
	 * @covers ::get_group_name
	 */
	public function test_get_group_name() {

		$option_instance = \Mockery::mock( '\WPSEO_Option' );
		$option_instance->group_name = 'test_option_group_name';
		$option_instance
			->expects( 'get_option_name' )
			->once()
			->andReturn( 'test_option' );

		WPSEO_Options::register_option( $option_instance );

		$this->assertEquals( 'test_option_group_name', WPSEO_Options::get_group_name( 'test_option' ) );
	}

	/**
	 * @covers ::get_group_name
	 */
	public function test_get_group_name_non_existing_option() {
		$this->assertFalse( WPSEO_Options::get_group_name( 'non_existing_option' ) );
	}

	/**
	 * @covers ::update_site_option
	 *
	 */
	public function test_update_site_option() {

		$option_instance = \Mockery::mock( '\WPSEO_Option' );
		$option_instance
			->expects( 'get_option_name' )
			->once()
			->andReturn( 'test_option' );

		$option_instance
			->expects( 'update_site_option' )
			->once()
			->with( 'new_value' )
			->andReturnTrue();

		WPSEO_Options::register_option( $option_instance );

		$this->assertTrue( WPSEO_Options::update_site_option( 'the_option', 'new_value' ) );
	}

}
