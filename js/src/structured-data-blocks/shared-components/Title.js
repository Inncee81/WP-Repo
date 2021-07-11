/* External dependencies */
import { __ } from "@wordpress/i18n";
import PropTypes from "prop-types";
import { RichText } from "@wordpress/editor";

/**
 * Renders the editing UI for a step description.
 *
 * @param {string} description The current description.
 * @param {Function} setTitle The method to set a new description.
 * @param {string} placeholder The placeholder to show in the editing field.
 *
 * @returns {ReactElement} The rendered UI.
 */
const Title = ( { title, setTitle, placeholder }  ) => {
	if ( placeholder === "" ) {
		placeholder = __( "Enter a title", "wordpress-seo" );
	}

	return <RichText
		className="yoast-block-title"
		tagName="p"
		value={ title }
		onChange={ setTitle }
		placeholder={ placeholder }
		formattingControls={ [ "italic", "strikethrough", "link" ] }
	/>;
};

/**
 * StepTitleContent renders the front end content for the step title.
 *
 * @param {string} title The title value to render.
 *
 * @returns {ReactElement} The rendered HTML for the content.
 */
const TitleContent = ( { title } ) => {
	return <RichText.Content value={ title } />;
};

TitleContent.propTypes = {
	title: PropTypes.string,
};

TitleContent.defaultProps = {
	title: "",
};

Title.Content = TitleContent;

Title.propTypes = {
	title: PropTypes.string,
	setTitle: PropTypes.func.isRequired,
	placeholder: PropTypes.string,
};

Title.defaultProps = {
	title: "",
	placeholder: "",
};

export default Title;
