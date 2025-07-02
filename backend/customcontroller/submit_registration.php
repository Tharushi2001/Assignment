<?php
require_once "../config/database.php"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Get and sanitize inputs
    $title = $_POST['title'];
    $first = $_POST['firstname'];
    $middle = $_POST['middlename'] ?? '';
    $last = $_POST['lastname'];
    $contact = $_POST['phonenumber'];
    $district_id = $_POST['district'];

    // Validate phone number (10 digits)
    if (!preg_match('/^[0-9]{10}$/', $contact)) {
        die("Invalid phone number.");
    }
    
    $stmt = $conn->prepare("INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $first, $middle, $last, $contact, $district_id);

    if ($stmt->execute()) {
        echo "Customer registered successfully!";
        // optionally redirect or clear form
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
 
    echo "Invalid request.";
}
?>
