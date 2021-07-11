/* External dependencies */
import React from "react";
import PropTypes from "prop-types";
import { createBlock } from "@wordpress/blocks";
import { RichText } from "@wordpress/editor";

/* Internal dependencies */
import appendSpace from "../../../components/higherorder/appendSpace";
import { NAME as QUESTIONS } from "../../inner-blocks/questions";
import { NAME as QUESTION } from "../../inner-blocks/question";

const RichTextWithAppendedSpace = appendSpace( RichText.Content );

/**
 * Returns the component of the given question and answer to be rendered in a WordPress post
 * (e.g. not in the editor).
 *
 * @param {object} question The question and its answer.
 *
 * @returns {Component} The component to be rendered.
 */
function QuestionContent( question ) {
	return (
		<div className={ "schema-faq-section" } key={ question.id }>
			<RichTextWithAppendedSpace
				tagName="strong"
				className="schema-faq-question"
				key={ question.id + "-question" }
				value={ question.question }
			/>
			<RichTextWithAppendedSpace
				tagName="p"
				className="schema-faq-answer"
				key={ question.id + "-answer" }
				value={ question.answer }
			/>
		</div>
	);
}

const QuestionContentWithAppendedSpace = appendSpace( QuestionContent );

/**
 * Save rendering of the previous block version.
 *
 * @param {Object} previousAttributes The attributes of the previous version of the blocks.
 *
 * @returns {ReactElement} The rendered HTML for the frontend.
 */
export const Content = ( { attributes: previousAttributes } ) => {
	const { questions, className } = previousAttributes;

	const questionList = questions ? questions.map( ( question, index ) =>
		<QuestionContentWithAppendedSpace key={ index } { ...question } />
	) : null;

	const classNames = [ "schema-faq", className ].filter( ( i ) => i ).join( " " );

	return (
		<div className={ classNames }>
			{ questionList }
		</div>
	);
};

Content.propTypes = {
	attributes: PropTypes.object.isRequired,
};

export const attributes = {
	questions: {
		type: "array",
	},
	additionalListCssClasses: {
		type: "string",
	},
};

/**
 * Migrates the block attributes for the previous block to the current block.
 *
 * @param {Object} previousAttributes The previous attributes for the block.
 *
 * @returns {Array} The new attributes and inner blocks.
 */
export const migrate = function( previousAttributes ) {
	const newAttributes = {};
	const questionsInnerBlocks = previousAttributes.questions.map( ( question ) => {
		return createBlock(
			QUESTION,
			{
				id: question.id,
				title: question.jsonQuestion,
			},
		);
	} );
	const newInnerBlocks = [];

	if ( questionsInnerBlocks.length > 0 ) {
		newInnerBlocks.push( createBlock( QUESTIONS, {}, questionsInnerBlocks ) );
	}

	return [
		newAttributes,
		newInnerBlocks,
	];
};
