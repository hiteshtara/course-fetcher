import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';

const Edit = ({ attributes, setAttributes }) => {
    const { title, numberOfPosts } = attributes;
    const [posts, setPosts] = useState([]);
    const [loading, setLoading] = useState(true);
    const [page, setPage] = useState(1);

    useEffect(() => {
        setLoading(true);
        fetch(`/wp-json/wp/v2/posts?per_page=${numberOfPosts}&page=${page}`)
            .then((res) => res.json())
            .then((data) => {
                setPosts(data);
                setLoading(false);
            })
            .catch(() => setLoading(false));
    }, [numberOfPosts, page]);

    return (
        <>
            <InspectorControls>
                <PanelBody title={__("Block Settings", "hybrid-latest-posts")}>
                    <TextControl
                        label={__("Title", "hybrid-latest-posts")}
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <RangeControl
                        label={__("Number of Posts", "hybrid-latest-posts")}
                        value={numberOfPosts}
                        onChange={(value) => setAttributes({ numberOfPosts: value })}
                        min={1}
                        max={10}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps()}>
                <h2>{title}</h2>
                {loading ? <p>Loading posts...</p> : (
                    <ul>
                        {posts.map((post) => (
                            <li key={post.id}>
                                <a href={post.link}>{post.title.rendered}</a>
                            </li>
                        ))}
                    </ul>
                )}
                <button onClick={() => setPage(page + 1)}>Load More</button>
            </div>
        </>
    );
};

export default Edit;
