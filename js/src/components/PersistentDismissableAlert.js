/* global wpApiSettings */

import { useState } from "@wordpress/element";
import PropTypes from "prop-types";
import { Alert } from "@yoast/components";
import sendRequest from "@yoast/components";

const HEADERS = {
	"X-WP-NONCE": wpApiSettings.nonce,
};

const REST_ROUTE = wpApiSettings.root;

/**
 * Sets the dismissed flag in the database.
 * @param {string} id Id of the dismissable that needs to be set in the database.
 *
 * @returns {null}.
 */
function setDismissFlag( id ) {
	console.log( "Make " + id + " not appear again!" );
	// This is where the dismissable in the database needs to be set, still WiP.

	const data = id;

	// sendRequest( `${ REST_ROUTE }wp/v2/yoast_dismiss_notification`, {
	// 	data,
	// 	method: "POST",
	// 	headers: HEADERS,
	// 	dataType: "json",
	// } );
}

/**
 * Returns the dismissable Alert.
 *
 * @param {object} props Component props.
 *
 * @returns {ReactElement} the dismissable Alert.
 */
const PersistentDismissableAlert = ( props ) => {
	const [ display, setDisplay ] = useState( props.display );

	/**
	 * Handles the dismiss after the dismiss button is clicked.
	 * @returns {ReactElement} the dismissable Alert.
	 */
	function hideAlert() {
		setDismissFlag( props.id );
		setDisplay( false );
	}

	if ( display === true ) {
		return <Alert
			type="info"
			onDismissed={ hideAlert }
		>
			{ props.children }
		</Alert>;
	}
	return null;
};


PersistentDismissableAlert.propTypes = {
	children: PropTypes.string.isRequired,
	display: PropTypes.bool,
	id: PropTypes.string.isRequired,
};

PersistentDismissableAlert.defaultProps = {
	display: true,
};


export default PersistentDismissableAlert;
