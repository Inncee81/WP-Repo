import { withSelect } from "@wordpress/data";
import { compose } from "@wordpress/compose";
import PostPublish from "../components/post-publish";

export default compose( [
	withSelect( ( select ) => {
		const data = select( "core/editor" );
		const permalink = data.getPermalink();

		return {
			permalink,
		};
	} ),
] )( PostPublish );
