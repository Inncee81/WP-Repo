<?php
/**
 * @package Yoast\Free\Structured_Data
 */

/**
 * Represents a piece of data that needs to be added to the JSON graph.
 */
class WPSEO_Structured_Data_Graph_Part {

	/**
	 * @var array Pieces to add to the graph.
	 */
	private $graph;

	/**
	 * @var array Pieces to add to the main entity.
	 */
	private $main_entity;

	/**
	 * @var string Pieces to add to the type.
	 */
	private $type;

	/**
	 * Constructs a graph part value object.
	 *
	 * @param array  $graph       Pieces of data to add to the graph.
	 * @param array  $main_entity Pieces of data to add to the main entity.
	 * @param string $type        Type to add to the page structured data type attribute.
	 */
	public function __construct( $graph = array(), $main_entity = array(), $type = '' ) {
		$this->graph = $graph;
		$this->main_entity = $main_entity;
		$this->type = $type;
	}

	/**
	 * @return array
	 */
	public function get_graph() {
		return $this->graph;
	}

	/**
	 * @return array
	 */
	public function get_main_entity() {
		return $this->main_entity;
	}

	/**
	 * @return string
	 */
	public function get_type() {
		return $this->type;
	}
}
