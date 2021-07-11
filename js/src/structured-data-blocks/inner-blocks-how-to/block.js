/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import HowTo from "./HowTo";
import { CATEGORY } from "../constants";

export const NAME = "yoast/how-to-block-inner-blocks";

export default () => {
	registerBlockType( NAME, {
		title: __( "How-to using inner blocks", "wordpress-seo" ),
		description: __( "Create a How-to guide in an SEO-friendly way. You can only use one How-to block per post.", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "How-to", "wordpress-seo" ),
			__( "How to", "wordpress-seo" ),
		],
		// Allow only one How-To block per post.
		supports: {
			multiple: false,
		},

		edit: HowTo,
		save: HowTo.Content,
	} );
};
