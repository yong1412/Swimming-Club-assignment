<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Constants for fee structure
    $BASE_PRICE_PER_TICKET = 50.00; // Base price for a single ticket
    $SERVICE_FEE = 10.00; // Service fee per booking
    $TAX_RATE = 0.07; // 7% tax rate
    
    // Connect to a database
    $conn = new mysqli('localhost', 'root', '', 'dbtest');
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Get main booking details
    $event = $_POST['event'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    
    // Calculate the base price
    $ticketCount = 1; // Main ticket
    foreach ($_POST as $key => $value) {
        if (preg_match('/^name[0-9]+$/', $key)) {
            $ticketCount++; // Additional tickets
        }
    }
    
    $basePrice = $BASE_PRICE_PER_TICKET * $ticketCount;
    $tax = $basePrice * $TAX_RATE;
    $total = $basePrice + $SERVICE_FEE + $tax;
    
    // Store the main booking with fee details
    // Assuming you have a valid database connection in $conn
$stmt = $conn->prepare("INSERT INTO bookings (event, date, time, base_price, service_fee, tax, total) 
VALUES (?, ?, ?, ?, ?, ?, ?)");
if ($stmt) {
$stmt->bind_param("sssdddd", $event, $date, $time, $basePrice, $serviceFee, $tax, $total);
if ($stmt->execute()) {
echo "Booking inserted successfully.";
} else {
echo "Error inserting booking: " . $stmt->error;
}
$stmt->close();
} else {
echo "Error preparing statement: " . $conn->error;
}

    
    if ($conn->query($sql) === TRUE) {
        $bookingId = $conn->insert_id;
        
        // Store additional tickets if any
        foreach ($_POST as $key => $value) {
            if (preg_match('/^name[0-9]+$/', $key)) {
                $ticketNumber = substr($key, 4);
                $name = $_POST["name$ticketNumber"];
                $contact = $_POST["contact$ticketNumber"];
                
                $sql = "INSERT INTO additional_tickets (booking_id, name, contact) 
                        VALUES ($bookingId, '$name', '$contact')";
                
                if ($conn->query($sql) !== TRUE) {
                    echo "Error adding additional tickets: " . $conn->error;
                }
            }
        }
        
        echo "Booking and additional tickets added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}
?>
