<?php
require_once "../../backend/config/database.php"; 
require_once "../header.php";

// Fetch districts with id and name
$sql = "SELECT id, district FROM district WHERE active = 'yes' ORDER BY district ASC";
$result = $conn->query($sql);
?>


    <div class="banner-img">
  
        <form action="../../backend/customcontroller/submit_registration.php" method="post">
            <div class="container ">
                
                <h2 class="mt-3 text-center text-white">Customer Registration</h2>
<div class="outer-box">
                <label for="title"><b>Title</b></label>
                <select name="title" class="form-input" required>
                    <option value="">-- Select Title --</option>
                    <option value="Mr">Mr</option>
                    <option value="Mrs">Mrs</option>
                    <option value="Miss">Miss</option>
                    <option value="Dr">Dr</option>
                </select>

                <label for="firstname"><b>First Name</b></label>
                <input type="text" name="firstname"class="form-input" required>

                <label for="middlename"><b>Middle Name</b></label>
                <input type="text" name="middlename" class="form-input" required>


                 <label for="lastname"><b>Last Name</b></label>
                <input type="text" name="lastname" class="form-input" required>

                <label for="phonenumber"><b>Phone Number</b></label>
                <input type="text" name="phonenumber"class="form-input" required pattern="\d{10}" title="Enter a valid phone number">

                <label for="district"><b>District</b></label>
                <select name="district" class="form-input" required>
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

           
           <div class="form-buttons d-flex justify-content-between gap-2">
  <input type="submit" value="Register" class="btn form-submit btn-sm">
  <a href="viewcustomers.php" class="btn btn-secondary btn-sm w-50">View</a>
</div>
                </div>
            </div>
        </form>
    </div>
                </div>




