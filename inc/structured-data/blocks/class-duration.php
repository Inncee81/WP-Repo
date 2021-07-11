<?php
/**
 * @package Yoast\Free\Structured_Data\Block
 */

/**
 * Represents a structured duration.
 */
class WPSEO_Structured_Data_Duration implements WPSEO_Structured_Data_Block {
	const NAME = 'yoast/duration';

	/**
	 * @var int The days for this duration.
	 */
	private $days;

	/**
	 * @var int The hours for this duration.
	 */
	private $hours;

	/**
	 * @var int The minutes for this duration.
	 */
	private $minutes;

	/**
	 * @param int $days The days for this duration.
	 * @param int $hours The hours for this duration.
	 * @param int $minutes The minutes for this duration.
	 */
	public function __construct( $days, $hours, $minutes ) {
		$this->days = $days;
		$this->hours = $hours;
		$this->minutes = $minutes;
	}

	/**
	 * Creates a duration block instance.
	 *
	 * @param array $block Saved properties for a duration block.
	 *
	 * @return self A duration block instance.
	 */
	public static function from_block( $block ) {
		$attributes = isset( $block['attrs'] ) ? $block['attrs'] : array();

		$days = isset( $attributes['days'] ) ? $attributes['days'] : 0;
		$hours = isset( $attributes['hours'] ) ? $attributes['hours'] : 0;
		$minutes = isset( $attributes['minutes'] ) ? $attributes['minutes'] : 0;

		return new self( $days, $hours, $minutes );
	}

	/**
	 * Builds the JSON for the structured data block.
	 *
	 * @param array $context Relevant context to construct JSON.
	 *
	 * @return string The JSON data structure for this block.
	 */
	public function build_json( $context ) {
		if ( ( $this->days + $this->hours + $this->minutes ) > 0 ) {
			return 'P' . $this->days . 'DT' . $this->hours . 'H' . $this->minutes . 'M';
		}

		return '';
	}
}
