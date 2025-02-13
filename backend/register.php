<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <h2>Register</h2>
                <form id="register-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="firstname">First Name:</label>
                        <input type="text" id="firstname" name="firstname" required>
                    </div>
                    <div class="form-group">
                        <label for="surname">Surname:</label>
                        <input type="text" id="surname" name="surname" required>
                    </div>
                    <div class="form-group">
                        <label for="email_address">Email Address:</label>
                        <input type="email" id="email_address" name="email_address" required>
                    </div>
                    <div class="form-group">
                        <label for="date_of_birth">Date Of Birth::</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="usernameinput">Username:</label>
                        <input type="text" id="usernameinput" name="usernameinput" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number:</label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                    <button type="submit" class="btn">Register</button>
                </form>     
            </div>
        </div>
    </section>
</body>
</html> 
<?php
    $servername = '86.145.13.112';
    $username = 'website';
    $dbpass = 'website';
    $dbname  = 'stars';
    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $email_address = $_POST["email_address"];
    $date_of_birth = $_POST["date_of_birth"];
    $registration_date = date("Y-m-d");
    $usernameinput = $_POST["usernameinput"];
    $password = $_POST["password"];
    $phone = $_POST["phone"];
    // Create connection
    $conn = new mysqli($servername, $username, $dbpass, $dbname);
                // // Check connection
                if ($conn->connect_error) {
                  die("Connection failed: " . $conn->connect_error);
                }

$sql = "INSERT INTO clients(firstName, lastName, dateOfBirth, registrationDate, username, emailAddress, phoneNumber, password)    
VALUES (\"$firstname\", \"$surname\", \"$date_of_birth\", \"$registration_date\", \"$usernameinput\", \"$email_address\", \"$phone\", \"" . md5($password) . "\") ;";
// echo $sql;
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;    
}

$conn->close();
?> 


<!-- <?php
// if ($_SERVER["REQUEST_METHOD"] == "POST") {


//     // Database connection details
//     $servername = "127.0.0.1:3306"; 
//     $dbname = "newdatabase";         
//     $dbemail_address = "root";    
//     $dbpassword = "newnewnewpass123";
    // try {
    //     $conn = new PDO("mysql://root:$servername;dbname=$dbname", $dbemail_address, $dbpassword);
    //     // Prepare and execute the SQL statement to insert user data    
    //     $stmt = $conn->prepare("INSERT INTO users (firstname, surname, email_address, password, age, phone) 
    //                             VALUES (:firstname, :surname, :email_address, MD5(:password), :age, :phone)");
    //     $stmt->bindParam(':firstname', $firstname);
    //     $stmt->bindParam(':surname', $surname);
    //     $stmt->bindParam(':email_address', $email_address);
    //     $stmt->bindParam(':password', $password);
    //     $stmt->bindParam(':age', $age);
    //     $stmt->bindParam(':phone', $phone);
    //     $stmt->execute();

    //     echo "Registration successful!";
    //     header("Location: login.php"); // Redirect to login after registration
    //     exit(); // Ensure script stops after redirection
    // } catch(PDOException $e) {
    //     echo "Error: " . $e->getMessage();
    // }
            //     $conn = null;
            // }
            // ?> -->