/* global wp */
import { Component, createRef } from "@wordpress/element";
import PropTypes from "prop-types";
import RaisedButton from "material-ui/RaisedButton";
import { localize } from "yoast-components";

/**
 * @summary Media upload component.
 */
class MediaUpload extends Component {
	/**
	 * The constructor.
	 * @param {object} props The props.
	 */
	constructor( props ) {
		super( props );

		this.state = {
			currentUpload: props.value,
			mediaUpload: wp.media( {
				title: this.props.translate( "Choose an image" ),
				button: { text: this.props.translate( "Choose an image" ) },
				multiple: false,
				library: {
					type: "image",
				},
			} ),
		};

		this.state.mediaUpload.on( "select", this.selectUpload.bind( this ) );
		this.chooseButton = createRef();
	}

	/**
	 * Sends the change event, because the component is updated.
	 *
	 * @param {Object} prevProps The previous props.
	 * @param {Object} prevState The previous state.
	 *
	 * @returns {void}
	 */
	componentDidUpdate( prevProps, prevState ) {
		const currentUploadChange = this.state.currentUpload !== prevState.currentUpload;

		if ( currentUploadChange ) {
			this.sendChangeEvent();
		}

		// When the image gets removed, move focus back to the Choose Image button.
		if ( currentUploadChange && this.state.currentUpload === "" ) {
			this.chooseButton.current.refs.container.button.focus();
		}
	}

	/**
	 * Opens the media upload.
	 *
	 * @param {Event} evt The event that is triggered.
	 *
	 * @returns {void}
	 */
	chooseUpload( evt ) {
		evt.preventDefault();

		this.state.mediaUpload.open();
	}

	/**
	 * Selects the image and put the value of it to the state.
	 *
	 * @returns {void}
	 */
	selectUpload() {
		var attachment = this.state.mediaUpload.state().get( "selection" ).first().toJSON();

		this.setState( {
			currentUpload: attachment.url,
		} );
	}

	/**
	 * Clears the current upload.
	 *
	 * @returns {void}
	 */
	removeUpload() {
		this.setState( {
			currentUpload: "",
		} );
	}

	/**
	 * Renders a remove button when an image is set.
	 *
	 * @returns {wp.Element} The button element.
	 */
	renderRemoveButton() {
		if ( ! this.state.currentUpload ) {
			return null;
		}

		return (
			<RaisedButton
				label={ this.props.translate( "Remove the image" ) }
				onClick={ this.removeUpload.bind( this ) }
				className="yoast-wizard-image-upload-container-buttons__remove"
				type="button"
			/>
		);
	}

	/**
	 * Renders the image when available.
	 *
	 * @returns {wp.Element} The image element.
	 */
	renderImage() {
		if ( ! this.state.currentUpload ) {
			return null;
		}

		return (
			<img
				className="yoast-wizard-image-upload-container__image"
				src={ this.state.currentUpload }
				alt={ this.props.translate( "image preview" ) }
			/>
		);
	}

	/**
	 * Renders the output.
	 *
	 * @returns {wp.Element} The rendered HTML.
	 */
	render() {
		return (
			<div className="yoast-wizard-image-upload-container">
				<p className="yoast-wizard-image-upload-container-description">
					{ this.props.properties.label }
				</p>
				{ this.renderImage() }
				<div className="yoast-wizard-image-upload-container-buttons">
					<RaisedButton
						label={ this.props.translate( "Choose an image" ) }
						onClick={ this.chooseUpload.bind( this ) }
						type="button"
						className="yoast-wizard-image-upload-container-buttons__choose"
						ref={ this.chooseButton }
					/>
					{ this.renderRemoveButton() }
				</div>
			</div>
		);
	}

	/**
	 * Sends the data to the step component.
	 *
	 * @returns {void}
	 */
	sendChangeEvent() {
		const changeEvent = {
			target: {
				name: this.props.name,
				value: this.state.currentUpload,
			},
		};

		this.props.onChange( changeEvent );
	}
}

/**
 * Adds validation for the properties.
 */
MediaUpload.propTypes = {
	translate: PropTypes.func.isRequired,
	name: PropTypes.string.isRequired,
	value: PropTypes.any,
	onChange: PropTypes.func,
	properties: PropTypes.shape( {
		label: PropTypes.string,
	} ),
};

export default localize( MediaUpload );
