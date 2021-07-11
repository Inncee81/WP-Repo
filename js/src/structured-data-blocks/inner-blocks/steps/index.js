/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import { NAME as HOW_TO } from "../../inner-blocks-how-to/block";
import { CATEGORY } from "../../constants";
import Steps from "./Steps";

export const NAME = "yoast/steps";

export default () => {
	registerBlockType( NAME, {
		title: __( "Steps", "wordpress-seo" ),
		description: __( "", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "Steps", "wordpress-seo" ),
			__( "Step", "wordpress-seo" ),
		],
		parent: [ HOW_TO ],
		// Allow only one How-To block per post.
		supports: {},

		edit: Steps,
		save: Steps.Content,
	} );
};
