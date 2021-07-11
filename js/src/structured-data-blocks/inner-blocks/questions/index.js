/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import { NAME as FAQ } from "../../faq/block";
import { CATEGORY } from "../../constants";
import Questions from "./Questions";

export const NAME = "yoast/questions";

export default () => {
	registerBlockType( NAME, {
		title: __( "Questions", "wordpress-seo" ),
		description: __( "A list of questions", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "Questions", "wordpress-seo" ),
			__( "Question", "wordpress-seo" ),
		],
		parent: [ FAQ ],
		supports: {},
		edit: Questions,
		save: Questions.Content,
	} );
};
