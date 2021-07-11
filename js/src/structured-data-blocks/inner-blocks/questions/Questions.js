/* External dependencies */
import { Component } from "@wordpress/element";
import { InnerBlocks } from "@wordpress/editor";

/* Internal dependencies */
import { NAME as QUESTION } from "../question";

/**
 * Represents the Questions block for a list of questions.
 */
export default class Questions extends Component {
	/**
	 * Renders the editing UI for the Questions block.
	 *
	 * @returns {ReactElement} The rendered UI.
	 */
	render() {
		return <InnerBlocks allowedBlocks={ [ QUESTION ] } />;
	}

	/**
	 * Renders the front end for the Questions block.
	 *
	 * @returns {ReactElement} The rendered HTML for the front end.
	 */
	static Content() {
		return <InnerBlocks.Content />;
	}
}

