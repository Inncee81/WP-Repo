/* External dependencies */
import { InnerBlocks } from "@wordpress/editor";
import { Component, Fragment } from "@wordpress/element";

/* Internal dependencies */
import { NAME as QUESTIONS } from "../inner-blocks/questions";
import { NAME as QUESTION } from "../inner-blocks/question";

/**
 * Represents the frequently asked questions block.
 */
export default class FAQ extends Component {
	/**
	 * Renders the FAQ block editing.
	 *
	 * @returns {ReactElement} The rendered UI.
	 */
	render() {
		return <Fragment>
			<InnerBlocks
				template={ [
					[ QUESTIONS, {}, [
						[ QUESTION, {}, [] ],
					] ],
				] }
				allowedBlocks={ [ QUESTIONS ] }
			/>
		</Fragment>;
	}

	/**
	 * Renders the content for the frontend for the FAQ block.
	 *
	 * @returns {ReactElement} The rendered frontend HTML.
	 */
	static Content() {
		return <InnerBlocks.Content />;
	}
}

