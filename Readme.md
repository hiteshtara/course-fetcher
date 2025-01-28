Usage:
Add the shortcode [fetch_courses] to any post or page.

The plugin will fetch the courses from the API and display them with sections, instructor, course time, and semester.

How It Works:
Autoloading:

The spl_autoload_register function in course-fetcher.php automatically loads the required class files from the includes directory.

API Handler:

The API_Handler class fetches data from the API and creates Course and Section objects.

Rendering:

The Course and Section classes have render() methods to generate HTML for the courses and sections.

Shortcode:

The shortcode [fetch_courses] calls the fetch_courses_from_api() function to fetch and display the courses.

