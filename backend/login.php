<!-- <?php include 'includes/header.php'; ?> -->

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section class="login-section">
        <div class="container">
            <div class="login-container">
                <h2>Login</h2>
                <?php
                if(isset($_COOKIE["clientID"])) {
                    $servername = '86.145.13.112';     
                    $username = 'website';
                    $dbpass = 'website';
                    $dbname  = 'stars';
                    // echo $email_address;        
                    // echo $password;
                    // echo "SELECT firstname, surname, age, email_address, passwordbutbetter FROM users WHERE email_address = \"" . $email_address . "\" AND passwordbutbetter = \"" . $password . "\"";                                    
                    $conn = new mysqli($servername, $username, $dbpass, $dbname);
                                // Check connection
                                if ($conn->connect_error) { 
                                    die("Connection failed: " . $conn->connect_error);
                    }
                    $sql = "SELECT clientID, firstName, lastName, dateOfBirth, registrationDate, username, emailAddress, phoneNumber, password FROM clients WHERE clientID = \"" . $_COOKIE["clientID"] . "\"";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            echo "You're already logged in, " . $row["firstname"]; ?>
                        <a href="/account.php">Would you like to go to your account page instead?</a>
                        <?php
                    }
                        }
                    }
                    else{
                    ?>
                <?php
                }
                session_start();
                if (isset($_SESSION['error_message'])) {
                    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
                    unset($_SESSION['error_message']); 
                }
                ?>

                <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <div class="form-group">
                        <label for="email_address">Email Address:</label>
                        <input type="email" id="email_address" name="email_address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn">Login</button>
                    <br>
                    <a href="register.php" class="btn">Register</a>
                </form>
                    
            </div>
        </div>
    </section>
</body>
</html>
<?php
    $email_address = $_POST["email_address"];
    $password = $_POST["password"];
    // Database connection details
    $servername = '86.145.13.112';     
    $username = 'website';
    $dbpass = 'website';
    $dbname  = 'stars';
    // echo $email_address;        
    // echo $password;
    // echo "SELECT firstname, surname, age, email_address, passwordbutbetter FROM users WHERE email_address = \"" . $email_address . "\" AND passwordbutbetter = \"" . $password . "\"";                                    
        $conn = new mysqli($servername, $username, $dbpass, $dbname);
                    // Check connection
                    if ($conn->connect_error) { 
                        die("Connection failed: " . $conn->connect_error);
        }
        $sql = "SELECT clientID, firstName, lastName, dateOfBirth, registrationDate, username, emailAddress, phoneNumber, password FROM clients WHERE emailAddress = \"" . $email_address . "\" AND password = \"" . md5($password) . "\"";
        $result = $conn->query($sql);   
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              setcookie("clientID",$row["clientID"],  time() + (86400 * 30));
              echo "Hi, " . $row["firstName"]. " " . $row["lastName"]. "!";
              echo "Logged in successfully!";
            //   header("refresh: 1; url = account.php");
            }       
          } 
        else {
            echo "Email or password not correct 😧";
          }
?>


<?php
?>
<!-- // if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     try {
//         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbemail_address, $dbpassword);
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//         $stmt = $conn->prepare("SELECT * FROM users WHERE email_address = :email_address AND password = MD5(:password)");
//         $stmt->bindParam(':email_address', $email_address);
//         $stmt->bindParam(':password', $password);
//         $stmt->execute();
//         if ($stmt->rowCount() > 0) {
//             $_SESSION['logged_in'] = true;
//             $_SESSION['email_address'] = $email_address; 

//             $user = $stmt->fetch(PDO::FETCH_ASSOC);
//             $_SESSION['firstname'] = $user['firstname'];
//             $_SESSION['surname'] = $user['surname']; 
//             $_SESSION['age'] = $user['age']; 
//             $_SESSION['phone'] = $user['phone'];
//             $_SESSION['usersID'] = $user['usersID']; 

//             header("Location: index.php"); 
//             exit(); 
//         } else {
//             $_SESSION['error_message'] = "Invalid email or password."; 
//             header("Location: login.php");
//             exit();
//         }
//     } catch(PDOException $e) {
//         echo "Error: " . $e->getMessage(); 
//     }
//     $conn = null;
// }
// ?> -->