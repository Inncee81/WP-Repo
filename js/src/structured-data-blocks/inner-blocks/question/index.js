/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import { NAME as QUESTIONS } from "../questions";
import { CATEGORY } from "../../constants";
import Question from "./Question";

const attributes = {
	title: {
		type: "string",
	},
	id: {
		type: "string",
	},
};

export const NAME = "yoast/question";

export default () => {
	registerBlockType( NAME, {
		title: __( "Question", "wordpress-seo" ),
		description: __( "", "wordpress-seo" ),
		icon: "editor-ol",
		category: CATEGORY,
		keywords: [
			__( "Question", "wordpress-seo" ),
		],
		parent: [ QUESTIONS ],
		supports: {},
		attributes,
		edit: Question,
		save: Question.Content,
	} );
};
