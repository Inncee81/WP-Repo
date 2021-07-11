<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a structured FAQ.
 */
class WPSEO_Structured_Data_FAQ implements WPSEO_Structured_Data_Root_Block {
	const NAME = 'yoast/faq-block';

	/**
	 * @var array The blocks inside this block.
	 */
	private $inner_blocks;

	/**
	 * Constructs an FAQ block to be rendered.
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
		$graph = array();
		$main_entity = array();
		$questions = array();

		foreach ( $this->inner_blocks as $inner_block ) {
			$questions_block = WPSEO_Structured_Data_Questions::from_block( $inner_block );

			$questions = array_merge( $questions, $questions_block->build_json( $context ) );
		}

		foreach ( $questions as $question ) {
			$main_entity[] = array(
				'@id' => $question['@id'],
			);

			$graph[] = $question;
		}

		return new WPSEO_Structured_Data_Graph_Part(
			$graph,
			$main_entity,
			'FAQPage'
		);
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
