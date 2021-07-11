/* External dependencies */
import { InnerBlocks } from "@wordpress/editor";
import { Component, Fragment } from "@wordpress/element";
import { Notice } from "@wordpress/components";

/* Internal dependencies */
import { NAME as DURATION } from "../inner-blocks/duration";
import { NAME as DESCRIPTION } from "../inner-blocks/description";
import { NAME as STEPS } from "../inner-blocks/steps";
import { NAME as STEP } from "../inner-blocks/step";

import styled from "styled-components";

const RequiredFields = styled.ul`
	&&&&&& {
		padding-left: 20px;
	}
`;

/**
 * Represents the HowTo block.
 */
export default class HowTo extends Component {
	/**
	 * Renders the HowTo block editing.
	 *
	 * @returns {ReactElement} The rendered UI.
	 */
	render() {
		return <Fragment>
			<Notice status="info" isDismissible={ false }>
				The following blocks are required:
				<RequiredFields>
					<li>Description</li>
					<li>Steps</li>
				</RequiredFields>
			</Notice>

			<InnerBlocks
				template={ [
					[ DURATION, {}, [] ],
					[ DESCRIPTION, {}, [] ],
					[ STEPS, {}, [
						[ STEP, {}, [] ],
					] ],
				] }
				allowedBlocks={ [ STEPS, DURATION, DESCRIPTION ] }
			/>
		</Fragment>;
	}

	/**
	 * Renders the content for the frontend for the HowTo block.
	 *
	 * @returns {ReactElement} The rendered frontend HTML.
	 */
	static Content() {
		return <InnerBlocks.Content />;
	}
}

