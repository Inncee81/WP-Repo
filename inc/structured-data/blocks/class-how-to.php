<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a structured how-to.
 */
class WPSEO_Structured_Data_Block_How_To implements WPSEO_Structured_Data_Root_Block {

	const NAME = 'yoast/how-to-block-inner-blocks';

	/**
	 * @var array Blocks inside this block.
	 */
	private $inner_blocks;

	/**
	 * Constructs a structured data how to block.
	 *
	 * @param array $inner_blocks The blocks inside this block.
	 */
	public function __construct( $inner_blocks ) {
		$this->inner_blocks = $inner_blocks;
	}

	/**
	 * Generates a unique ID if the how to has no description to use as an ID.
	 *
	 * @return string The ID to use.
	 */
	private function generate_unique_id() {
		static $id_counter = 0;
		$prefix = 'how-to-';

		return $prefix . (string) ++$id_counter;
	}

	/**
	 * Builds the JSON for the structured data block.
	 *
	 * @param array $context The context necessary to render some JSON.
	 *
	 * @return mixed The JSON data structure for this block.
	 */
	public function build_json( $context ) {
		$id = $context['current_url'] . '#how-to';

		$how_to = array(
			'@type' => 'HowTo',
		);

		if ( isset( $context['post_title'] ) ) {
			$how_to['name'] = $context['post_title'];
		}

		foreach ( $this->inner_blocks as $inner_block ) {
			switch ( $inner_block['blockName'] ) {
				case WPSEO_Structured_Data_Duration::NAME:
					$duration = WPSEO_Structured_Data_Duration::from_block( $inner_block );

					$how_to['totalTime'] = $duration->build_json( $context );
					break;

				case 'yoast/description':
					$description = render_block( $inner_block );

					$how_to['description'] = $description;
					$id = wp_trim_words( $description, 8 );
					break;

				case WPSEO_Structured_Data_Steps::NAME:
					$steps = WPSEO_Structured_Data_Steps::from_block( $inner_block );

					$how_to['step'] = $steps->build_json( $context );
					break;
			}
		}

		if ( $id === '' ) {
			$id = $this->generate_unique_id();
		}

		$id = $context['current_url'] . '#' . rawurlencode( $id );
		$how_to['@id'] = $id;
		$main_entity = array(
			'@id' => $id,
		);

		return new WPSEO_Structured_Data_Graph_Part(
			array( $how_to ),
			array( $main_entity )
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
