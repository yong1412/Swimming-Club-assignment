<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dropdown Menu Bar Example</title>
    <style>
        /* Basic styling for the menu bar */
        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: #fff;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        /* Change color on hover */
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        /* Dropdown menu container */
        .dropdown {
            float: left;
            overflow: hidden;
        }

        /* Dropdown button */
        .dropdown .dropbtn {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            background-color: inherit;
            padding: 14px 16px;
            cursor: pointer;
        }

        /* Dropdown content (hidden by default) */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Dropdown links */
        .dropdown-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        /* Change color on hover */
        .dropdown-content a:hover {
            background-color: #ddd;
        }

        /* Show dropdown on hover */
        .dropdown:hover .dropdown-content {
            display: block;
        }

        /* Change dropdown button color on hover */
        .dropdown:hover .dropbtn {
            background-color: #ddd;
            color: black;
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="#home">Home</a>
    <a href="#events">Events</a>

    <div class="dropdown">
        <button class="dropbtn">Categories
            <!-- Arrow symbol to indicate dropdown -->
            &#9660;
        </button>
        <div class="dropdown-content">
            <a href="?category=">Show All</a>
            <a href="?category=Day Event">Day Event</a>
            <a href="?category=Afternoon Event">Afternoon Event</a>
            <a href="?category=Evening Event">Evening Event</a>
            <a href="?category=Night Event">Night Event</a>
        </div>
        
    </div>
    <a href="#contact">Contact</a>
    <a> <form method="GET" action="">
    <input type="text" name="search" placeholder="Enter event name...">
    <button type="submit">Search</button>
</form></a>
    
</div>

<div>
    <h2>Welcome to Our Events Page!</h2>
    <p>Select a category from the menu bar to see specific events.</p>
</div>
<?php
// Database connection
$host = 'localhost'; // Database host, e.g., 'localhost'
$dbname = 'swimming_society'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handling category filter
$category = isset($_GET['category']) ? $_GET['category'] : null;
$search = isset($_GET['search']) ? $_GET['search'] : null;

if ($category) {
    // Fetch events based on the selected category
    $stmt = $pdo->prepare("SELECT * FROM society WHERE category = :category");
    $stmt->execute([':category' => $category]);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} elseif ($search) {
    // Fetch events based on the search term
    $stmt = $pdo->prepare("SELECT * FROM society WHERE event_name LIKE :search");
    $stmt->execute([':search' => '%' . $search . '%']);
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Default: fetch all events
    $stmt = $pdo->prepare("SELECT * FROM society");
    $stmt->execute();
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Display events
echo "<h2>Events</h2>";

if (empty($events)) {
    echo "<p>No events found.</p>";
} else {
    // Create the table header
    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>Event Name</th>";
    echo "<th>Date</th>";
    echo "<th>Location</th>";
    echo "<th>Start Time</th>";
    echo "<th>End Time</th>";
    echo "<th>Fare</th>";
    echo "<th>Category</th>";
    echo "<th>Description</th>";
    echo "</tr>";

    // Create table rows for each event
    foreach ($events as $event) {
        echo "<tr>";
        echo "<td>{$event['event_name']}</td>";
        echo "<td>{$event['event_date']}</td>";
        echo "<td>{$event['location']}</td>";
        echo "<td>{$event['start_time']}</td>";
        echo "<td>{$event['end_time']}</td>";
        echo "<td>{$event['fare']}</td>";
        echo "<td>{$event['category']}</td>";
        echo "<td>{$event['description']}</td>";
        echo "</tr>";
    }
    echo "</table>";
}

?>
</body>
</html>
