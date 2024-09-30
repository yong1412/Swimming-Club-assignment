<?php
// Step 1: Database connection details
$host = 'localhost'; // Database host, e.g., 'localhost'
$dbname = 'swimming_society'; // Your database name
$username = 'root'; // Your MySQL username
$password = ''; // Your MySQL password

// Create a PDO connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Step 2: Generate a random ticket ID with format "TKxxxx"
function generateTicketID() {
    $randomNumber = mt_rand(100, 999); // Generate a random 4-digit number
    return 'TK' . $randomNumber; // Return ticket ID in the required format
}

// Step 3: Check for unique ticket ID and insert into the database
function insertTicket($pdo) {
    $unique = false;
    $ticketID = null;

    while (!$unique) {
        $ticketID = generateTicketID(); // Generate a random ticket ID
        
        // Check if this ticket ID already exists in the database
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM ticket WHERE ticket_id = :ticket_id");
        $stmt->execute([':ticket_id' => $ticketID]);
        $count = $stmt->fetchColumn();
        
        if ($count == 0) {
            // If the ticket ID is unique, set unique to true and insert into the database
            $unique = true;
            $stmt = $pdo->prepare("INSERT INTO ticket (ticket_id) VALUES (:ticket_id)");
            $stmt->execute([':ticket_id' => $ticketID]);
        }
    }

    return $ticketID;
}

// Step 4: Insert a new ticket ID into the database
$newTicketID = insertTicket($pdo);

echo "New ticket ID generated and inserted: " . $newTicketID;

?>
