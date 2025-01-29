import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { useSelect } from '@wordpress/data';
import { __ } from '@wordpress/i18n';

const Edit = ({ attributes, setAttributes }) => {
    const { title, numberOfPosts } = attributes;

    // Fetch posts dynamically using getEntityRecords
    const posts = useSelect((select) => {
        return select('core').getEntityRecords('postType', 'post', { per_page: numberOfPosts });
    }, [numberOfPosts]);

    return (
        <>
            <InspectorControls>
                <PanelBody title={__("Block Settings", "entity-latest-posts")}>
                    <TextControl
                        label={__("Title", "entity-latest-posts")}
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <RangeControl
                        label={__("Number of Posts", "entity-latest-posts")}
                        value={numberOfPosts}
                        onChange={(value) => setAttributes({ numberOfPosts: value })}
                        min={1}
                        max={10}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps()}>
                <h2>{title}</h2>
                {posts === undefined ? (
                    <p>Loading posts...</p>
                ) : (
                    <ul>
                        {posts.map((post) => (
                            <li key={post.id}>
                                <a href={post.link}>{post.title.rendered}</a>
                            </li>
                        ))}
                    </ul>
                )}
            </div>
        </>
    );
};

export default Edit;
