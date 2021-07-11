/* External dependencies */
import { __ } from "@wordpress/i18n";
import { RichText } from "@wordpress/editor";
import PropTypes from "prop-types";

/**
 * Renders the editing UI for a step description.
 *
 * @param {string} description The current description.
 * @param {Function} setDescription The method to set a new description.
 *
 * @returns {ReactElement} The rendered UI.
 */
const StepDescription = ( { description, setDescription } ) => {
	return <RichText
		className="yoast-step-description"
		tagName="p"
		value={ description }
		onChange={ setDescription }
		placeholder={ __( "Enter a step description", "wordpress-seo" ) }
		formattingControls={ [ "italic", "strikethrough", "link" ] }
	/>;
};

/**
 * StepDescriptionContent renders the front end content for the step description.
 *
 * @param {string} description The description value to render.
 *
 * @returns {ReactElement} The rendered HTML for the content.
 */
const StepDescriptionContent = ( { description } ) => {
	return <RichText.Content value={ description } />;
};

StepDescriptionContent.propTypes = {
	description: PropTypes.string,
};

StepDescriptionContent.defaultProps = {
	description: "",
};

StepDescription.Content = StepDescriptionContent;

StepDescription.propTypes = {
	description: PropTypes.string,
	setDescription: PropTypes.func.isRequired,
};

StepDescription.defaultProps = {
	description: "",
};


export default StepDescription;
