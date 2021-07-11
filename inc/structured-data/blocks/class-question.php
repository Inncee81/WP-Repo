<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a structured data question.
 */
class WPSEO_Structured_Data_Question implements WPSEO_Structured_Data_Block {
	const NAME = 'yoast/question';

	/**
	 * @var string ID for this question.
	 */
	private $id;

	/**
	 * @var string The question.
	 */
	private $question;

	/**
	 * @var string The answer to the question.
	 */
	private $answer;

	/**
	 * @param string $id The ID for this specific question.
	 * @param string $question The actual question.
	 * @param string $answer The answer to the question.
	 */
	public function __construct( $id, $question, $answer ) {
		$this->id = $id;
		$this->question = $question;
		$this->answer = $answer;
	}

	/**
	 * Transforms the data for the block into a block instance.
	 *
	 * @param array $block The block data.
	 *
	 * @return self
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
	 * @param array $context Context required to build the JSON.
	 *
	 * @return mixed The JSON data structure for this block.
	 */
	public function build_json( $context ) {
		return array(
			'@type' => 'Question',
			'name' => $this->question,
			'@id' => $context['current_url'] . '#' . rawurlencode( $this->id ),
			'url' => $context['current_url'] . '#' . rawurlencode( $this->id ),
			'answerCount' => 1,
			'acceptedAnswer' => array(
				'@type' => 'Answer',
				'text' => $this->answer,
			),
		);
	}
}
