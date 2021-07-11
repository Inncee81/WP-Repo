/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import { NAME as HOW_TO } from "../../inner-blocks-how-to/block";
import { NAME as STEP } from "../../inner-blocks/step";
import Description from "./Description";
import { CATEGORY } from "../../constants";

const attributes = {
	description: {
		type: "string",
	},
};

export const NAME = "yoast/description";

export default () => {
	registerBlockType( NAME, {
		title: __( "Description", "wordpress-seo" ),
		description: __( "", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "Description", "wordpress-seo" ),
		],
		parent: [ HOW_TO, STEP ],
		// Allow only one How-To block per post.
		supports: {},
		// Block attributes - decides what to save and how to parse it from and to HTML.
		attributes,

		edit: Description,
		save: Description.Content,
	} );
};
