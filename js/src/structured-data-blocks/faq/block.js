/* External dependencies */
import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";

/* Internal dependencies */
import FAQ from "./FAQ";
import { CATEGORY } from "../constants";
import {
	attributes as attributesBeforeInnerBlocks,
	Content as ContentBeforeInnerBlocks,
	migrate as migrateFromBeforeInnerBlocks,
} from "./legacy/beforeInnerBlocks";

export const NAME = "yoast/faq-block";

export default () => {
	registerBlockType( NAME, {
		title: __( "FAQ", "wordpress-seo" ),
		description: __( "List your Frequently Asked Questions in an SEO-friendly way. You can only use one FAQ block per post.", "wordpress-seo" ),
		icon: "editor-ul",
		category: CATEGORY,
		keywords: [
			__( "FAQ", "wordpress-seo" ),
			__( "Frequently Asked Questions", "wordpress-seo" ),
		],
		// Allow only one FAQ block per post.
		supports: {
			multiple: false,
		},
		edit: FAQ,
		save: FAQ.Content,

		attributes: {
			/*
			 * Gutenberg has a bug where you cannot remove an old attribute and have
			 * it migrate using the `deprecated` array. The relevant issue is: https://github.com/WordPress/gutenberg/issues/10406.
			 */
			...attributesBeforeInnerBlocks,
		},

		deprecated: [
			{
				attributes: attributesBeforeInnerBlocks,
				save: ContentBeforeInnerBlocks,
				migrate: migrateFromBeforeInnerBlocks,
			},
		],
	} );
};
