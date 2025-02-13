<body>
<form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="dateandtime">Date and time:</label>
                        <input type="date" id="dateandtime" name="dateandtime" required>
                    </div>
                    <div class="form-group">
                        <label>Type of booking:</label>
                        <input type="radio" id="body_treatments" value="body_treatments" name="type_of_booking" required>
                        <label for="body_treatments">Body Treatments</label>
                        <input type="radio" id="spa_treatments" value="spa_treatments" name="type_of_booking" required>
                        <label for="spa_treatments">Spa Treatments</label>
                        <input type="radio" id="hair_treatments" value="hair_treatments" name="type_of_booking" required>
                        <label for="hair_treatments">Hair Treatments</label>
                        <input type="radio" id="beauty_treatments" value="beauty_treatments" name="type_of_booking" required>
                        <label for="beauty_treatments">Beauty Treatments</label>
                        <input type="radio" id="facials" value="facials" name="type_of_booking" required>
                        <label for="facials">Facials</label>
                        <input type="radio" id="male_grooming" value="male_grooming" name="type_of_booking" required>
                        <label for="male_grooming">Male Grooming</label>        
                    </div>
                    <button type="submit" class="btn">Create Booking</button> 
                    <!-- <a href="register.php" class="btn">Register</a> -->
</form>
</body>
<?php
    $servername = '127.0.0.1';
    $username = 'test';
    $dbpass = '12345678';
    $dbname  = 'newdatabase';
    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $email_address = $_POST["email_address"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];
    // Create connection
    $conn = new mysqli($servername, $username, $dbpass, $dbname);
                // // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

$sql = "INSERT INTO users (firstname, surname, email_address, passwordbutbetter, age, phone)
VALUES (\"$firstname\", \"$surname\", \"$email_address\", \"$password\", \"$age\", \"$phone\");";
// echo $sql;
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;    
}

$conn->close();
?> 