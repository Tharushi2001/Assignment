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
 

 // Check for duplicate customer by first and last name
$checkStmt = $conn->prepare("SELECT id FROM customer WHERE LOWER(first_name) = LOWER(?) AND LOWER(last_name) = LOWER(?)");
$checkStmt->bind_param("ss", $first, $last); 
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    echo "<script>
            alert(' A customer with the same first and last name already exists.');
            window.history.back();
          </script>";
    exit;
}
    $checkStmt->close();
    
    $stmt = $conn->prepare("INSERT INTO customer (title, first_name, middle_name, last_name, contact_no, district) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $title, $first, $middle, $last, $contact, $district_id);

if ($stmt->execute()) {
echo "<script>
        alert('Customer registered successfully!');
        window.location.href = 'registration.php'; 
      </script>";

} else {
    echo "<script>
            alert(' Error: " . addslashes($stmt->error) . "');
            window.history.back();
          </script>";
}


    $stmt->close();
    $conn->close();
} else {
 
    echo "Invalid request.";
}
?>
