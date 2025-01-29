<?php

function render_hybrid_latest_posts_block($attributes)
{
    $title = isset($attributes['title']) ? esc_html($attributes['title']) : 'Latest Posts';
    $number_of_posts = isset($attributes['numberOfPosts']) ? intval($attributes['numberOfPosts']) : 5;

    // Fetch initial posts (server-rendered for SEO)
    $query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => $number_of_posts,
        'post_status'    => 'publish',
    );

    $posts = get_posts($query_args);

    ob_start();
    echo '<div class="hybrid-latest-posts-block">';
    echo '<h2>' . esc_html($title) . '</h2>';

    if (!empty($posts)) {
        echo '<ul id="hybrid-posts-list">';
        foreach ($posts as $post) {
            echo '<li><a href="' . esc_url(get_permalink($post->ID)) . '">' . esc_html($post->post_title) . '</a></li>';
        }
        echo '</ul>';
        echo '<button id="load-more-posts">Load More</button>';
    } else {
        echo '<p>No posts found.</p>';
    }

    echo '</div>';

    return ob_get_clean();
}

// Register block
register_block_type(__DIR__, array(
    'render_callback' => 'render_hybrid_latest_posts_block',
));
