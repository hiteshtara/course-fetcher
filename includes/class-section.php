<?php
if (!defined('ABSPATH')) {
    exit;
}

class Section
{
    public $instructor;
    public $time;
    public $semester;

    public function __construct($instructor, $time, $semester)
    {
        $this->instructor = $instructor;
        $this->time = $time;
        $this->semester = $semester;
    }

    public function render()
    {
        return sprintf(
            '<div class="section">
                <p><strong>Instructor:</strong> %s</p>
                <p><strong>Time:</strong> %s</p>
                <p><strong>Semester:</strong> %s</p>
            </div>',
            esc_html($this->instructor),
            esc_html($this->time),
            esc_html($this->semester)
        );
    }
}
