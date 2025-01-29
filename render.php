<?php

function render_latest_posts_block($attributes)
{
    $title = isset($attributes['title']) ? esc_html($attributes['title']) : 'Latest Posts';
    $number_of_posts = isset($attributes['numberOfPosts']) ? intval($attributes['numberOfPosts']) : 5;

    // Fetch latest posts
    $query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => $number_of_posts,
        'post_status'    => 'publish',
    );

    $posts = get_posts($query_args);

    // Start output buffering Uses get_posts() to fetch the latest posts.
    //Uses PHP output buffering (ob_start()) to capture the dynamic HTML output.
    //Returns a dynamically generated block that updates when the page reloads.
    ob_start();

    echo '<div class="latest-posts-block">';
    echo '<h2>' . esc_html($title) . '</h2>';

    if (!empty($posts)) {
        echo '<ul>';
        foreach ($posts as $post) {
            echo '<li><a href="' . esc_url(get_permalink($post->ID)) . '">' . esc_html($post->post_title) . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo '<p>No posts found.</p>';
    }

    echo '</div>';

    return ob_get_clean();
}

// Register block
register_block_type(__DIR__, array(
    'render_callback' => 'render_latest_posts_block',
));
