<?php
/*
Plugin Name: Course Fetcher
Description: A plugin to fetch courses from an API and display them with sections, instructor, course time, and semester using a shortcode.
Version: 1.0
Author: Your Name
*/

// Prevent direct access to the file
if (!defined('ABSPATH')) {
    exit;
}

// Autoload classes
spl_autoload_register(function ($class_name) {
    $file = plugin_dir_path(__FILE__) . 'includes/class-' . strtolower(str_replace('_', '-', $class_name)) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// Register the shortcode
function register_course_fetcher_shortcode()
{
    add_shortcode('fetch_courses', 'fetch_courses_from_api');
}
add_action('init', 'register_course_fetcher_shortcode');

// Function to fetch courses from the API
function fetch_courses_from_api()
{
    $api_handler = new API_Handler();
    $courses = $api_handler->fetch_courses();

    if (empty($courses)) {
        return 'No courses found.';
    }

    // Build the HTML to display the courses
    $output = '<div class="course-list">';
    foreach ($courses as $course) {
        $output .= $course->render();
    }
    $output .= '</div>';

    return $output;
}
