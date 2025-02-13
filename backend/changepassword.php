<?php
// echo $_GET["newpassword"];
$servername = '127.0.0.1';     
    $username = 'test';
    $dbpass = '12345678';
    $dbname  = 'newdatabase';
    // echo $email_address;        
    // echo $password;
    // echo "SELECT firstname, surname, age, email_address, passwordbutbetter FROM users WHERE email_address = \"" . $email_address . "\" AND passwordbutbetter = \"" . $password . "\"";                                    
    $conn = new mysqli($servername, $username, $dbpass, $dbname);
                // Check connection
                if ($conn->connect_error) { 
                    die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE users SET passwordbutbetter = \"" . $_GET["newpassword"] . "\"WHERE usersID = \"" . $_COOKIE["userid"] . "\"";
    $result = $conn->query($sql);
    if ($result) {
        echo "Password updated successfully";
        ?>
        <a href="/account.php">Would you like to go to your account page?</a>
<?php
    } else {
        echo "An error occured";
    }
session_start();
if (isset($_SESSION['error_message'])) {
    echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
    unset($_SESSION['error_message']); 
    }
?>