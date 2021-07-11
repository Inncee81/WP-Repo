/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import { NAME as STEPS } from "../steps";
import { CATEGORY } from "../../constants";
import Step from "./Step";

const attributes = {
	title: {
		type: "string",
	},
	description: {
		type: "string",
	},
};

export const NAME = "yoast/step";

export default () => {
	registerBlockType( NAME, {
		title: __( "Step", "wordpress-seo" ),
		description: __( "", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "Step", "wordpress-seo" ),
		],
		parent: [ STEPS ],
		// Allow only one How-To block per post.
		supports: {},
		// Block attributes - decides what to save and how to parse it from and to HTML.
		attributes,

		edit: Step,
		save: Step.Content,
	} );
};
