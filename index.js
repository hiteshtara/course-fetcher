import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextControl, RangeControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
//The editor interface allows users to configure the block settings.
//Uses InspectorControls to allow users to set the title and number of posts in the block settings.
//Displays a preview of the settings in the editor.
//The actual post list is rendered server-side (render.php), ensuring real-time updatestouch init.php

const Edit = ({ attributes, setAttributes }) => {
    const { title, numberOfPosts } = attributes;

    return (
        <>
            <InspectorControls>
                <PanelBody title={__("Block Settings", "server-render-block")}>
                    <TextControl
                        label={__("Title", "server-render-block")}
                        value={title}
                        onChange={(value) => setAttributes({ title: value })}
                    />
                    <RangeControl
                        label={__("Number of Posts", "server-render-block")}
                        value={numberOfPosts}
                        onChange={(value) => setAttributes({ numberOfPosts: value })}
                        min={1}
                        max={10}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...useBlockProps()}>
                <h2>{title}</h2>
                <p>Displaying {numberOfPosts} latest posts...</p>
            </div>
        </>
    );
};

export default Edit;
