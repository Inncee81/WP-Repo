/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import Duration from "./Duration";
import { NAME as HOW_TO } from "../../inner-blocks-how-to/block";
import { CATEGORY } from "../../constants";

const attributes = {
	days: {
		type: "string",
	},
	hours: {
		type: "string",
	},
	minutes: {
		type: "string",
	},
	legend: {
		type: "string",
	},
};

export const NAME = "yoast/duration";

export default () => {
	registerBlockType( NAME, {
		title: __( "Duration", "wordpress-seo" ),
		description: __( "", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "Duration", "wordpress-seo" ),
		],
		parent: [ HOW_TO ],

		// Block attributes - decides what to save and how to parse it from and to HTML.
		attributes,

		edit: Duration,
		save: Duration.Content,
	} );
};
