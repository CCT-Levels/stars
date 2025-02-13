<h2>Create booking  </h2>
                <form id="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"; ?> 
                    <div class="form-group">
                        <label for="date">Date::</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="time">Time:</label>
                        <input type="time" id="time" name="time" required>
                    </div>
                    <label>Type of booking:</label>
                    <div class="form-group">
                        <input type="radio" id="body_treatments" value="1" name="typeofbooking" required>
                        <label for="Body Treatments">Body Treatments</label>
                        <input type="radio" id="spa_treatments" value="2" name="typeofbooking" required>
                        <label for="Spa Treatments">Spa Treatments</label>
                          <!-- <input type="radio" id="hair_treatments" value="3" name="typeofbooking" required>
                        <label for="Hair Treatments">Hair Treatments</label>
                        <input type="radio" id="beauty_treatments" value="4" name="typeofbooking" required>
                        <label for="Beauty Treatments">Beauty Treatments</label>
                        <input type="radio" id="facials" value="5" name="typeofbooking" required>
                        <label for="facials">Facials</label>
                        <input type="radio" id="male_grooming" value="6" name="typeofbooking" required>
                        <label for="male_grooming">Male Grooming</label>  -->
                    <br>
                    <label>Staff:</label>
                    <div class="form-group">
                        <input type="radio" id="spa_treatments" value="1" name="staffID" required>
                        <label for="Body Treatments">Staff 1</label>
                        <input type="radio" id="spa_treatments" value="2" name="staffID" required>
                        <label for="spa_treatments">Staff 2</label>
                        <!-- <input type="radio" id="hair_treatments" value="3" name="staffID" required>
                        <label for="Hair Treatments">Staff 3</label>
                        <input type="radio" id="beauty_treatments" value="4" name="staffID" required>
                        <label for="Beauty Treatments">Staff 4</label>
                        <input type="radio" id="facials" value="5" name="staffID" required>
                        <label for="facials">Staff 5</label>
                        <input type="radio" id="male_grooming" value="6" name="staffID" required>
                        <label for="male_grooming">Staff 6</label>  -->
                    <br>
                    <button type="submit" class="btn">Register</button>
                </form>     
<?php
    $servername = '86.145.13.112';     
    $username = 'website';
    $dbpass = 'website';
    $dbname  = 'stars';
    $dateandtimestamp = $_POST["date"] . " " . $_POST["time"] . ":00";
    $currentdateandtimestamp = date("Y-m-d-H-i-s");
    $staffID = $_POST["staffID"];
    $serviceID = $_POST["typeofbooking"];         
    // Create connection
    $conn = new mysqli($servername, $username, $dbpass, $dbname);
                // // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }
$sql = "SELECT clientID, firstName, lastName, dateOfBirth, registrationDate, username, emailAddress, phoneNumber, password FROM clients WHERE clientID = \"" . $_COOKIE["clientID"] . "\"";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              $userusername = $row["username"];
        }
        }
        session_start();
$bookingName = $userusername . "\'s appointment";
$sql = "INSERT INTO bookings (clientID, staffID, serviceID, date, bookingName, dateCreated)
VALUES (\"" . $_COOKIE["clientID"] . "\", \"$staffID\", \"$serviceID\", \"$dateandtimestamp\", \"$bookingName\", \"$currentdateandtimestamp\");";
// echo $sql;
if ($conn->query($sql) === TRUE) {
  echo "Booking created successfully!   ";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;    
}

$conn->close();
?> 