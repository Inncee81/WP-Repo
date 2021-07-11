<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a structured step.
 */
class WPSEO_Structured_Data_Step implements WPSEO_Structured_Data_Block {
	const NAME = 'yoast/step';

	/**
	 * @var string ID for this step.
	 */
	private $id;

	/**
	 * @var string Title for this step.
	 */
	private $title;

	/**
	 * @var string Description for this step.
	 */
	private $description;

	/**
	 * @param string $id ID for this step.
	 * @param string $title Title for this step.
	 * @param string $description Description for this step.
	 */
	public function __construct( $id, $title, $description ) {
		$this->id = $id;
		$this->title = $title;
		$this->description = $description;
	}

	/**
	 * Creates a new instance of this block based on the block data.
	 *
	 * @param array $block The block data.
	 *
	 * @return self Block instance.
	 */
	public static function from_block( $block ) {
		$attributes = isset( $block['attrs'] ) ? $block['attrs'] : array();
		$title = isset( $attributes['title'] ) ? $attributes['title'] : '';
		$id = isset( $attributes['id'] ) ? $attributes['id'] : '';

		$description = render_block( $block['innerBlocks'][0] );

		return new self( $id, $title, $description );
	}

	/**
	 * Builds the JSON for the structured data block.
	 *
	 * @param array $context Relevant context for building the JSON.
	 *
	 * @return mixed The JSON data structure for this block.
	 */
	public function build_json( $context ) {
		return array(
			'@type' => 'HowToSection',
			'itemListElement' => array(
				'@type' => 'HowToStep',
				'text' => $this->description,
			),
			'name' => $this->title,
		);
	}

	/**
	 * Returns the name for this block.
	 *
	 * @return string The name of this block.
	 */
	public static function get_name() {
		return 'yoast/step';
	}
}
