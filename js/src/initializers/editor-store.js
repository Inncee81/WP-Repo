/* eslint-disable require-jsdoc */
import { pickBy } from "lodash";
import { combineReducers, registerStore } from "@wordpress/data";
import reducers from "../redux/reducers";
import * as selectors from "../redux/selectors";
import * as actions from "../redux/actions";
import { setSettings } from "../redux/actions/settings";
import { setSEMrushChangeCountry, setTwitterPreviewDescription } from "../redux/actions";
import { setSEMrushLoginStatus } from "../redux/actions";

const fakeApiRequest = ( input ) => {
	return new Promise( resolve => {
		setTimeout( () => { resolve( input + " whoop whoop" ); }, 5000 );
	} );
};

/**
 * Initializes the Yoast SEO editor store.
 *
 * @returns {object} The Yoast SEO editor store.
 */
export default function initEditorStore() {
	const store = registerStore( "yoast-seo/editor", {
		reducer: combineReducers( reducers ),
		selectors,
		actions: {
			...pickBy( actions, x => typeof x === "function" ),
			testAction: function * testAction( value ) {
				const result = yield { type: "TEST_ACTION", value: value };
				return { type: "RESULT", value: result };
			},
		},
		controls: {
			TEST_ACTION: ( action ) => {
				console.log( "IM A CONTROL: ", action );
				return fakeApiRequest( action.value );
			},
		},
		resolvers: {
			getTwitterDescription: function * () {
				const result = yield { type: "TEST_ACTION", value: "Resolvers are complicated, but " };
				console.log( "IM A RESOLVER: ", result );
				return setTwitterPreviewDescription( result );
			},
		},
	} );

	store.dispatch(
		setSettings( {
			socialPreviews: {
				sitewideImage: window.wpseoScriptData.metabox.sitewide_social_image,
				authorName: window.wpseoScriptData.metabox.author_name,
				siteName: window.wpseoScriptData.metabox.site_name,
				contentImage: window.wpseoScriptData.metabox.first_content_image,
				twitterCardType: window.wpseoScriptData.metabox.twitterCardType,
			},
			snippetEditor: {
				baseUrl: window.wpseoScriptData.metabox.base_url,
				date: window.wpseoScriptData.metabox.metaDescriptionDate,
				recommendedReplacementVariables: window.wpseoScriptData.analysis.plugins.replaceVars.recommended_replace_vars,
				siteIconUrl: window.wpseoScriptData.metabox.siteIconUrl,
			},
		} )
	);
	store.dispatch(
		setSEMrushChangeCountry( window.wpseoScriptData.metabox.countryCode )
	);
	store.dispatch(
		setSEMrushLoginStatus( window.wpseoScriptData.metabox.SEMrushLoginStatus )
	);

	return store;
}
