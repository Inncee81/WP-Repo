/* External dependencies */
import { Component } from "react";
import PropTypes from "prop-types";
import { InnerBlocks, cleanForSlug } from "@wordpress/editor";
import { __ } from "@wordpress/i18n";

/* Internal dependencies */
import Title from "../../shared-components/Title";
import { NAME as DESCRIPTION } from "../description";

/**
 * Represents a Step block inside the block editor.
 */
export default class Step extends Component {
	/**
	 * Constructs a Step block component instance.
	 *
	 * @param {Object} props Props for the React component.
	 *
	 * @returns {void}
	 */
	constructor( props ) {
		super( props );

		this.setTitle = this.setTitle.bind( this );
		this.setDescription = this.setDescription.bind( this );
	}

	/**
	 * Sets the title in the attributes to a value.
	 *
	 * @param {string} title The value to set the title to.
	 *
	 * @returns {void}
	 */
	setTitle( title ) {
		this.props.setAttributes( {
			title,
			id: cleanForSlug( title ),
		} );
	}

	/**
	 * Sets the description in the attributes to a value.
	 *
	 * @param {string} description The value to set the description to.
	 *
	 * @returns {void}
	 */
	setDescription( description ) {
		this.props.setAttributes( { description } );
	}

	/**
	 * Renders a Step edit inside the block editor.
	 *
	 * @returns {ReactElement} The rendered UI.
	 */
	render() {
		const { attributes } = this.props;

		// Because setAttributes is quite slow right after a block has been added we fake having a single step.
		return <li style={ { margin: "0 10px" } }>
			<Title title={ attributes.title } setTitle={ this.setTitle } placeholder={ __( "Enter a step title", "wordpress-seo" ) } />
			<InnerBlocks
				allowedBlocks={ [ DESCRIPTION ] }
				template={ [
					[ DESCRIPTION, {}, [] ],
				] }
				templateLock="all"
			/>
		</li>;
	}

	/**
	 * Renders the content of the Step for the front end.
	 *
	 * @param {Object} attributes The set attributes for this Step.
	 *
	 * @returns {ReactElement} The rendered HTML for the frontend.
	 */
	static Content( { attributes } ) {
		return <li id={ attributes.id }>
			<Title.Content title={ attributes.title } />
			<InnerBlocks.Content />
		</li>;
	}
}

Step.propTypes = {
	attributes: PropTypes.object.isRequired,
	setAttributes: PropTypes.func.isRequired,
};


