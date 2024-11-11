# Traffic Tracker

A PHP-based web application to track page visits on a website. 
This app uses MySQL for data storage, tracks user visits with JavaScript, and provides an API endpoint for logging visits.

## Features

- Logs page URL and visitor's IP address for each visit.
- Tracks the timestamp for each entry.
- Stores data in a MySQL database.
- Displays visit history in a simple HTML table format.
- Option to add Redis caching for faster data retrieval (the redis branch in the repository).

## Requirements

- PHP (>= 7.4)
- MySQL
- Apache or similar web server (XAMPP recommended for local development)
- JavaScript-enabled browser

## Setup

1. **Clone the Repository**  
   Clone this repository to your local machine.

   ```bash
   git clone https://github.com/alintentu/traffic-tracker.git
   cd traffic-tracker

2. **Configurate Database**  

    CREATE DATABASE traffic_tracker;
    USE traffic_tracker;

    CREATE TABLE visits (
        id INT AUTO_INCREMENT PRIMARY KEY,
        page_url VARCHAR(255) NOT NULL,
        ip_address VARCHAR(255) NOT NULL,
        timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

3. **Database Connection**

    private $host = 'localhost';
    private $dbname = 'traffic_tracker';
    private $username = 'root';
    private $password = ''; 

4. **Add Tracker Script to Page**

    <script src="http://localhost/traffic-tracker/tracker.js"></script>

5. **Run App**

    Open index.php to view visit data. 
    This page will display a table with each visit’s URL, IP address, and timestamp.

    - Usage:
        The tracker.js file sends page visit data to track.php using the Fetch API.
        track.php processes and stores this data in the MySQL database.
        index.php retrieves and displays visit data.

    