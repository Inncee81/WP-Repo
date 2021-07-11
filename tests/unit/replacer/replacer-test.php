<?php

namespace Yoast\WP\SEO\Tests\Unit\Replacer;

use Yoast\WP\SEO\Context\Meta_Tags_Context;
use Yoast\WP\SEO\Helpers\Schema\ID_Helper;
use Yoast\WP\SEO\Tests\Unit\Doubles\Models\Indexable_Mock;
use Yoast\WP\SEO\Tests\Unit\TestCase;

use Brain\Monkey;
use Mockery;

use Yoast\WP\SEO\Replacer\Replacer;
use Yoast\WP\SEO\Values\Replace_Vars\Replace_Var;

/**
 * Class Replacer_Test.
 *
 * @group replacer
 *
 * @coversDefaultClass \Yoast\WP\SEO\Replacer\Replacer
 */
class Replacer_Test extends TestCase {

	/**
	 * The instance under test.
	 *
	 * @var Replacer
	 */
	protected $instance;

	/**
	 * Sets up the class under test and mock objects.
	 */
	public function set_up() {
		parent::set_up();

		$this->instance = new Replacer();
	}

	public function test_replace() {
		$replace_var = new Replace_Var(
			'replace_var',
			function() {
				return 'replaced variable';
			}
		);
		$this->instance->register_replace_var( $replace_var );

		$text = 'This is a text with a %%replace_var%%.';

		self::assertEquals(
			'This is a text with a replaced variable.',
			$this->instance->replace( $text )
		);
	}

	public function test_replace_with_context() {
		$context = Mockery::mock( Meta_Tags_Context::class );

		$context->indexable            = Mockery::mock( Indexable_Mock::class );
		$context->indexable->author_id = '123';

		$id_helper = Mockery::mock( ID_Helper::class );
		$id_helper
			->expects( 'get_user_schema_id' )
			->with( $context->indexable->author_id, $context )
			->andReturn( '#author_id' );

		$replace_var = new Replace_Var(
			'replace_var',
			function() use ( $id_helper, $context ) {
				return $id_helper->get_user_schema_id( $context->indexable->author_id, $context );
			}
		);
		$this->instance->register_replace_var( $replace_var );

		$text = 'This is a text with a %%replace_var%%.';

		self::assertEquals(
			'This is a text with a #author_id.',
			$this->instance->replace( $text )
		);
	}
}
