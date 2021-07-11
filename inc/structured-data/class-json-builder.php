<?php
/**
 * @package Yoast\Free\Structured_Data
 */

/**
 * JSON builder for a Gutenberg page.
 */
class JSON_Builder implements WPSEO_WordPress_Integration {
	/**
	 * Registers all hooks to WordPress
	 *
	 * @return void
	 */
	public function register_hooks() {
		add_action( 'wp_head', array( $this, 'render_json_ld' ) );
	}

	/**
	 * Returns the blocks that are handled in the root in the JSON builder.
	 *
	 * Should be a class constant when we drop PHP5.2 support.
	 *
	 * @returns string[] Names of the classes for the blocks.
	 */
	public function get_root_blocks() {
		return array(
			WPSEO_Structured_Data_Block_How_To::NAME => 'WPSEO_Structured_Data_Block_How_To',
			WPSEO_Structured_Data_FAQ::NAME => 'WPSEO_Structured_Data_FAQ',
		);
	}

	/**
	 * Renders the JSONLD for the frontend.
	 */
	public function render_json_ld() {
		if ( ! has_blocks() ) {
			return;
		}

		$json = $this->build_root_json();
		$json_options = ( WP_DEBUG ) ? JSON_PRETTY_PRINT : 0;
		echo '<script type="application/ld+json">' . wp_json_encode( $json, $json_options ) . '</script>' . PHP_EOL . PHP_EOL;
	}

	/**
	 * Creates a context that can be used during the building of the JSON.
	 *
	 * @return array
	 */
	public function create_context() {
		$post = get_post();

		$context = array();
		$context['post_title'] = $post->post_title;
		$context['post_content'] = $post->post_content;

		// The add_query_arg function called without arguments will return the current URL path.
		$context['current_url'] = home_url() . add_query_arg();

		return $context;
	}

	/**
	 * Builds the root JSON that should be rendered inside the ld+json block.
	 *
	 * @return array[] Data structure to turn into JSON.
	 */
	public function build_root_json() {
		$json = array(
			'@context' => 'https://schema.org',
		);

		$context = $this->create_context();
		$root_blocks = parse_blocks( $context['post_content'] );
		$graph = $this->build_graph( $root_blocks, $context );

		$json['@graph'] = $graph;

		return $json;
	}

	/**
	 * Builds the JSON structure based on the post content.
	 *
	 * @param array $blocks  The blocks of the page to build the graph for.
	 * @param array $context The context necessary to build the JSON graph.
	 *
	 * @return array Returns an array of objects that need to be added to the graph.
	 */
	public function build_graph( $blocks, $context ) {
		$graph = array();
		$types = array( 'WebPage' );
		$main_entity = array();

		foreach ( $blocks as $block ) {
			$block_instance = $this->get_block_instance( $block );

			if ( $block_instance === null ) {
				continue;
			}

			$result = $block_instance->build_json( $context );

			$graph = array_merge( $graph, $result->get_graph() );
			$main_entity = array_merge( $main_entity, $result->get_main_entity() );

			$add_to_type = $result->get_type();
			if ( $add_to_type !== '' ) {
				$types[] = $add_to_type;
			}
		}

		// If there is only one main entity we are should collapse it down to just that object in the JSON.
		if ( count( $main_entity ) === 1 ) {
			$main_entity = $main_entity[0];
		}

		$page = array(
			'@type' => $types,
			'mainEntity' => $main_entity,
		);

		if ( ! empty( $context['post_title'] ) ) {
			$page['name'] = $context['post_title'];
		}

		return array_merge( array( $page ), $graph );
	}

	/**
	 * Returns a block instance based on the known structured data blocks.
	 *
	 * @param array $block The block information inside the parsed blocks.
	 *
	 * @return WPSEO_Structured_Data_Root_Block A block that can build JSON.
	 */
	private function get_block_instance( $block ) {
		$blocks = $this->get_root_blocks();
		$block_name = $block['blockName'];

		if ( ! array_key_exists( $block_name, $blocks ) ) {
			return null;
		}

		$class_name = $blocks[ $block_name ];

		return call_user_func( array( $class_name, 'from_block' ), $block );
	}
}
