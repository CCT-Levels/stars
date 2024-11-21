<?php include 'includes/header.php'; ?>

<!DOCTYPE html>
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
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="age">Age:</label>
                        <input type="number" id="age" name="age" required>
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $surname = $_POST["surname"];
    $email_address = $_POST["email_address"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $phone = $_POST["phone"];

    // Database connection details
    $servername = "localhost";  
    $dbname = "Grant";          
    $dbemail_address = "phpmyadmin";    
    $dbpassword = "root";           

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbemail_address, $dbpassword);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare and execute the SQL statement to insert user data
        $stmt = $conn->prepare("INSERT INTO users (firstname, surname, email_address, password, age, phone) 
                                VALUES (:firstname, :surname, :email_address, MD5(:password), :age, :phone)");
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':surname', $surname);
        $stmt->bindParam(':email_address', $email_address);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':age', $age);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();

        echo "Registration successful!";
        header("Location: login.php"); // Redirect to login after registration
        exit(); // Ensure script stops after redirection
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    $conn = null;
}
?>