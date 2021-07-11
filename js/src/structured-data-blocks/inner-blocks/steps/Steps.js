/* External dependencies */
import { Component } from "@wordpress/element";
import { InnerBlocks } from "@wordpress/editor";

/* Internal dependencies */
import { NAME as STEP } from "../step";

/**
 * Represents the Steps block for a list of steps.
 */
export default class Steps extends Component {
	/**
	 * Renders the editing UI fro the Steps block.
	 *
	 * @returns {ReactElement} The rendered UI.
	 */
	render() {
		return <ul style={ { padding: "0 10px" } }><InnerBlocks allowedBlocks={ [ STEP ] } /></ul>;
	}

	/**
	 * Renders the front end for the Steps block.
	 *
	 * @returns {ReactElement} The rendered HTML for the front end.
	 */
	static Content() {
		return <ul><InnerBlocks.Content /></ul>;
	}
}

