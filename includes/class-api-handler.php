<?php
if (!defined('ABSPATH')) {
    exit;
}

class API_Handler
{
    public function fetch_courses()
    {
        // Dummy data for testing purposes
        $dummy_courses_data = [
            [
                'title' => 'Introduction to Computer Science',
                'description' => 'Learn the basics of computer science.',
                'sections' => [
                    [
                        'instructor' => 'Dr. John Smith',
                        'time' => 'Monday, 10 AM - 12 PM',
                        'semester' => 'Fall 2025',
                    ],
                    [
                        'instructor' => 'Dr. Jane Doe',
                        'time' => 'Wednesday, 2 PM - 4 PM',
                        'semester' => 'Spring 2025',
                    ],
                ],
            ],
            [
                'title' => 'Advanced Mathematics',
                'description' => 'A deep dive into calculus and algebra.',
                'sections' => [
                    [
                        'instructor' => 'Prof. Alan Turing',
                        'time' => 'Tuesday, 9 AM - 11 AM',
                        'semester' => 'Fall 2025',
                    ],
                    [
                        'instructor' => 'Prof. Emmy Noether',
                        'time' => 'Thursday, 1 PM - 3 PM',
                        'semester' => 'Spring 2025',
                    ],
                ],
            ],
        ];

        // Create Course objects from the dummy data
        $courses = [];
        foreach ($dummy_courses_data as $course_data) {
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
