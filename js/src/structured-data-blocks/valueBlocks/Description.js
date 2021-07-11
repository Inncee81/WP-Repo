/* External dependencies */
import { Component } from "react";
import PropTypes from "prop-types";
import { InnerBlocks } from "@wordpress/editor";

const ALLOWED_BLOCKS = [
	"core/paragraph",
	"core/heading",
	"core/shortcode",
	"core/list",
	"core/quote",
	"core/image",
	"core/gallery",
	"core/code",
	"core/table",
	"core/verse",
	"core/media-text",
	"core/button",
	"core/spacer",
];

/**
 * Represents a Description block within the schema blocks.
 */
export default class Description extends Component {
	/**
	 * Renders the description block for the block editor.
	 *
	 * @returns {ReactElement} The rendered description edit.
	 */
	render() {
		return (
			<InnerBlocks
				allowedBlocks={ ALLOWED_BLOCKS }
				templateLock={ false }
			/>
		);
	}

	/**
	 * Renders the description block for the front end.
	 *
	 * @param {Object} attributes The saved attributes for the description block.
	 *
	 * @returns {ReactElement} The rendered HTML for the frontend.
	 */
	static Content() {
		return <InnerBlocks.Content />;
	}
}

Description.propTypes = {
	setAttributes: PropTypes.func.isRequired,
};
