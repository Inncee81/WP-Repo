<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a Yoast structured data block.
 */
interface WPSEO_Structured_Data_Block {

	/**
	 * Builds the JSON for the structured data block.
	 *
	 * @param array $context The context for this page/post that might be necessary for building the JSON.
	 *
	 * @return mixed The JSON data structure for this block.
	 */
	public function build_json( $context );

	/**
	 * Constructs an instance of the block from the saved properties of the block in the block tree.
	 *
	 * @param array $block The properties of the block.
	 *
	 * @return self
	 */
	public static function from_block( $block );
}
