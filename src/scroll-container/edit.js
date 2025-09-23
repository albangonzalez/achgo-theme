import { useBlockProps, InnerBlocks } from '@wordpress/block-editor';
import './editor.scss';

export default function Edit() {
	return (
		<div {...useBlockProps()}>
			<InnerBlocks
				allowedBlocks={['core/list']}
				template={[
					['core/list', {
						placeholder: 'Add list items...',
						ordered: false,
						className: 'scroll-list'
					}]
				]}
				templateLock={false}
			/>
		</div>
	);
}
