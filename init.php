<?php

/**
 * Plugin Name: Server-Side Render Block
 * Description: A dynamic block that fetches and displays the latest posts.
 * Version: 1.0.0
 * Author: Your Name
 */

if (!defined('ABSPATH')) {
    exit;
}

// Register the block
function register_server_render_block()
{
    register_block_type(__DIR__ . '/server-render-block');
}
add_action('init', 'register_server_render_block');
