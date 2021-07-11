<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a structured steps block.
 */
class WPSEO_Structured_Data_Steps implements WPSEO_Structured_Data_Block {
	const NAME = 'yoast/steps';

	/**
	 * @var array Blocks inside this block.
	 */
	private $inner_blocks;

	/**
	 * WPSEO_Structured_Data_Steps constructor.
	 *
	 * @param array $inner_blocks The blocks inside this block.
	 */
	public function __construct( $inner_blocks ) {
		$this->inner_blocks = $inner_blocks;
	}

	/**
	 * Builds the JSON for the structured data block.
	 *
	 * @param array $context The context for this page/post that might be necessary for building the JSON.
	 *
	 * @return mixed The JSON data structure for this block.
	 */
	public function build_json( $context ) {
		$json = array();

		foreach ( $this->inner_blocks as $inner_block ) {
			$step = WPSEO_Structured_Data_Step::from_block( $inner_block );

			$json[] = $step->build_json( $context );
		}

		return $json;
	}

	/**
	 * Constructs an instance of the block from the saved properties of the block in the block tree.
	 *
	 * @param array $block The properties of the block.
	 *
	 * @return self
	 */
	public static function from_block( $block ) {
		return new self( $block['innerBlocks'] );
	}
}
