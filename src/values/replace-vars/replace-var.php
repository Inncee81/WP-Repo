<?php

namespace Yoast\WP\SEO\Values\Replace_Vars;

use Closure;

class Replace_Var {

	public $name;

	/**
	 * @var Closure
	 */
	public $replace_function;

	/**
	 * ReplaceVar constructor.
	 *
	 * @param string  $name
	 * @param Closure $replace_function
	 */
	public function __construct( $name, $replace_function ) {
		$this->name             = $name;
		$this->replace_function = $replace_function;
	}
}
