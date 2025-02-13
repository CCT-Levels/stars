<?php
    $email_address = $_GET["email_address"];
    $password = $_GET["password"];
    // Database connection details
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
        $sql = "SELECT usersID, firstname, surname, age, email_address, passwordbutbetter FROM users WHERE email_address = \"" . $email_address . "\" AND passwordbutbetter = \"" . $password . "\"";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
              setcookie("userid",$row["usersID"],  time() + (86400 * 30));
              // echo "Hi, " . $row["firstname"]. " " . $row["surname"]. "!";
              header("refresh: 1; url = account.php");
            }       
          } else {
            echo "Email or password not correct 😧";
          }
?>