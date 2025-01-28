<?php
if (!defined('ABSPATH')) {
    exit;
}

class API_Handler
{
    public function fetch_courses()
    {
        $api_url = 'https://api.example.com/courses'; // Replace with your API endpoint

        // Make a GET request to the API
        $response = wp_remote_get($api_url);

        // Check if the request was successful
        if (is_wp_error($response)) {
            return [];
        }

        // Decode the JSON response
        $courses_data = json_decode(wp_remote_retrieve_body($response), true);

        // Check if courses were returned
        if (empty($courses_data)) {
            return [];
        }

        // Create Course objects from the API data
        $courses = [];
        foreach ($courses_data as $course_data) {
            $sections = [];
            foreach ($course_data['sections'] as $section_data) {
                $sections[] = new Section(
                    $section_data['instructor'],
                    $section_data['time'],
                    $section_data['semester']
                );
            }
            $courses[] = new Course(
                $course_data['title'],
                $course_data['description'],
                $sections
            );
        }

        return $courses;
    }
}
