<?php
require_once "../../backend/config/database.php"; 

// Fetch districts with id and name
$sql = "SELECT id, district FROM district WHERE active = 'yes' ORDER BY district ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Customer Registration</title>
</head>
<body>
    <div>
        <form action="../../backend/customcontroller/submit_registration.php" method="post">
            <div class="container">
                <h1>Customer Registration</h1>

                <label for="title"><b>Title</b></label>
                <select name="title" required>
                    <option value="">-- Select Title --</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                    <option value="Dr">Dr</option>
                </select>

                <label for="firstname"><b>First Name</b></label>
                <input type="text" name="firstname" required>

                <label for="middlename"><b>Middle Name</b></label>
                <input type="text" name="middlename" required>


                 <label for="lastname"><b>Last Name</b></label>
                <input type="text" name="lastname" required>

                <label for="phonenumber"><b>Phone Number</b></label>
                <input type="text" name="phonenumber" required pattern="\d{10}" title="Enter a valid phone number">

                <label for="district"><b>District</b></label>
                <select name="district" required>
                    <option value="">-- Select District --</option>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            $id = htmlspecialchars($row['id']);
                            $district = htmlspecialchars($row['district']);
                            echo "<option value=\"$id\">$district</option>";
                        }
                    } else {
                        echo "<option disabled>No districts available</option>";
                    }
                    ?>
                </select>

                <input type="submit" value="Register">
            </div>
        </form>
    </div>
</body>
</html>
