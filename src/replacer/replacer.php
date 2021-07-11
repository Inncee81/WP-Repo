<?php

namespace Yoast\WP\SEO\Replacer;

use Yoast\WP\SEO\Values\Replace_Vars\Replace_Var;

class Replacer {

	/**
	 * The registered replacement variables.
	 *
	 * @var Replace_Var[]
	 */
	private $registered_replace_vars = [];

	public function replace( $text ) {
		foreach ( $this->registered_replace_vars as $name => $replacer ) {
			$replacement = call_user_func( $replacer->replace_function );
			$text        = \str_replace( $this->wrap_name( $name ), $replacement, $text );
		}
		return $text;
	}

	private function wrap_name( $name ) {
		return '%%' . $name . '%%';
	}

	public function register_replace_var( Replace_Var $replace_var ) {
		$this->registered_replace_vars[ $replace_var->name ] = $replace_var;
	}
}
