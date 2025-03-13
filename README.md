# Restaurant Rating Website

## Project Overview
A comprehensive web application for restaurant reviews and ratings built with HTML, CSS, PHP, and SQL. This platform allows users to discover, rate, and share their experiences with restaurants, creating a community-driven guide to dining options.

## Features
- **User Accounts**: Register, login, and manage personal profiles
- **Restaurant Database**: Extensive collection of restaurants with detailed information
- **Rating System**: Rate restaurants on multiple criteria (food quality, service, ambiance, value)
- **Review Management**: Write, edit, and delete personal reviews
- **Search Functionality**: Find restaurants by location, cuisine type, or rating
- **Responsive Design**: Optimized for both desktop and mobile viewing
- **Admin Panel**: Moderation tools for content management

## Tech Stack
- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP
- **Database**: MySQL/SQL
- **Server**: Apache

## Setup Instructions

### Prerequisites
- Web server with PHP support (Apache recommended)
- MySQL database
- PHP 7.0 or higher

### Installation
1. Clone the repository:
   ```bash
   git clone https://github.com/EpsilonOF/Rating-website.git
   ```
2. Import the database structure from the SQL files in the `database` directory
3. Configure the database connection in `config.php`
4. Place the files on your web server
5. Access the website through your web browser

### Database Configuration
Edit the `config.php` file with your database credentials:
```php
$db_host = "localhost";
$db_user = "username";
$db_pass = "password";
$db_name = "restaurant_ratings";
```

## Project Structure
- `index.php` - Homepage and entry point
- `assets/` - CSS, JavaScript, and image files
- `includes/` - Reusable PHP components
- `admin/` - Administrator interface
- `database/` - SQL structure and sample data
- `user/` - User account management
- `restaurant/` - Restaurant listings and details
- `reviews/` - Review submission and display

## Screenshots
(Add screenshots of key pages: homepage, restaurant listing, review form, user profile)

## Future Enhancements
- Geolocation-based restaurant suggestions
- Integration with reservation systems
- Mobile application version
- Social media sharing functionality
- Enhanced analytics for restaurant owners

## Contributing
Contributions to improve the website are welcome! Please feel free to fork the repository, make changes, and submit pull requests.

## License
This project is licensed under the MIT License - see the LICENSE file for details.

## Contact
For questions or suggestions regarding this project, please open an issue on GitHub.
