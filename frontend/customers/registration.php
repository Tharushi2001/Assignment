<?php
require_once "../../backend/config/database.php"; 
require_once "../header.php";

// Fetch districts with id and name
$sql = "SELECT id, district FROM district WHERE active = 'yes' ORDER BY district ASC";
$result = $conn->query($sql);
?>


    <div>
        <form action="../../backend/customcontroller/submit_registration.php" method="post">
            <div class="container">
                
                <h2 class="mt-3 text-center">Customer Registration</h2>
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

                <input type="submit" value="Register" class="form-submit">
                </div>
            </div>
        </form>
    </div>

<style>




  .form-title {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
  }

  .form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #555;
  }

  .form-input,
  .form-select {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 20px;
    border: 1.5px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 15px;
    transition: border-color 0.3s;
  }

  .form-input:focus,
  .form-select:focus {
    border-color: #007BFF;
    outline: none;
  }

  .form-submit {
    width: 100%;
    background-color: #007BFF;
    border: none;
    padding: 12px 0;
    color: white;
    font-size: 18px;
    font-weight: bold;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
  }

  .form-submit:hover {
    background-color: #0056b3;
  }

  /* Responsive */
  @media (min-width: 600px) {
 
      .outer-box {
    max-width: 600px;
    background-color: #fff;
    margin: 28px auto;
    padding: 50px 100px;
    box-shadow: 0 0 15px rgba(27, 26, 26, 0.1);
    border-radius: 8px;
  } 
  }
</style>

</style>