import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { useEffect, useState } from '@wordpress/element';
import { __ } from '@wordpress/i18n';
//Instead of rendering posts in PHP, we use useEffect and fetch() to get posts dynamically.Uses the WordPress REST API (/wp-json/wp/v2/posts) to fetch posts.Uses React state (useState) to store and update data dynamically.
//Uses useEffect to fetch posts whenever numberOfPosts changes.
//Supports customizable settings (title & post count) via InspectorControls.
touch hybrid-render.php

const Edit = ({ attributes, setAttributes }) => {
    const { title, numberOfPosts } = attributes;
    const [posts, setPosts] = useState([]);
    const [loading, setLoading] = useState(true);

    useEffect(() => {
        setLoading(true);
        fetch(`/wp-json/wp/v2/posts?per_page=${numberOfPosts}`)
            .then((res) => res.json())
            .then((data) => {
                setPosts(data);
                setLoading(false);
            })
            .catch(() => setLoading(false));
    }, [numberOfPosts]);

    return (
        <>
            <InspectorControls>
                <PanelBody title={__("Block Settings", "rest-api-latest-posts")}>
                    <TextControl
                        label={__("Title", "rest-api-latest-posts")}
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <RangeControl
                        label={__("Number of Posts", "rest-api-latest-posts")}
                        value={numberOfPosts}
                        onChange={(value) => setAttributes({ numberOfPosts: value })}
                        min={1}
                        max={10}
                    />
                </PanelBody>
            </InspectorControls>

            <div {...useBlockProps()}>
                <h2>{title}</h2>
                {loading ? (
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
