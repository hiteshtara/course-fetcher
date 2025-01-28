<?php
if (!defined('ABSPATH')) {
    exit;
}

class Course
{
    public $title;
    public $description;
    public $sections;

    public function __construct($title, $description, $sections)
    {
        $this->title = $title;
        $this->description = $description;
        $this->sections = $sections;
    }

    public function render()
    {
        $output = sprintf(
            '<div class="course-item">
                <h3>%s</h3>
                <p><strong>Description:</strong> %s</p>',
            esc_html($this->title),
            esc_html($this->description)
        );

        foreach ($this->sections as $section) {
            $output .= $section->render();
        }

        $output .= '</div>';
        return $output;
    }
}
