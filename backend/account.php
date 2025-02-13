<?php
try {
    if ($_GET["logout"]=="True"){
        setcookie("userid", "", time() - 3600);
        echo "Logged out hopefully";
        header("Location: account.php");
    }
}   
catch(Exception $e) {
    echo " ";
}
?>
<!DOCTYPE html>
<html>
<head>
    <h1>Account</h1>
</head>
<body>
    <script>
    function delete_booking(idinnit){
        console.log(idinnit)
    }
    </script>
    <section class="account-secction">
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
        $sql = "SELECT clientID, firstName,  lastName, dateOfBirth, registrationDate, username, emailAddress, phoneNumber, password FROM clients WHERE clientID = \"" . $_COOKIE["clientID"] . "\"";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row 
            while($row = $result->fetch_assoc()) {
                echo "First name: " . $row["firstName"] . "<br>";
                echo "Last name: " . $row["lastName"] . "<br>";
                echo "Date of birth: " . $row["dateOfBirth"] . "<br>";
                echo "Registration date: " . $row["registrationDate"] . "<br>";
                echo "Username: " . $row["username"] . "<br>";
                echo "Email address: " . $row["emailAddress"] . "<br>";
                echo "Phone number: " . $row["phoneNumber"] . "<br>";
        }
        }
        session_start();
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); 
        }
        // ?><h1>Your Bookings:</h1><?php
        $sql = "SELECT bookingID, clientID, staffID, serviceID, date, bookingName, dateCreated FROM bookings WHERE clientID = \"" . $_COOKIE["clientID"] . "\"";
        $result = $conn->query($sql);
        $current_booking = 0;
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()){
                $current_booking = $current_booking+1;
                echo "<h3>Booking Number " . $current_booking . "</h3>";
                echo "Booking ID: " . $row["bookingID"] . "<br>";
                echo "Date Of Booking: " . $row["date"] . "<br>";
                echo "Booking Name: " . $row["bookingName"] . "<br>";
                $sql2 = "SELECT serviceID, name FROM services WHERE serviceID = \"" .$row["serviceID"] . "\"";
                $result2 = $conn->query($sql2);
                if ($result2->num_rows > 0) {
                    while($row = $result2->fetch_assoc()) {
                        $servicename = $row["name"];}
                echo "Type Of Booking: " . $servicename . "<br>";
                // echo "<button onclick=\"delete_booking(\$row[\"bookingID\"])>Remove Booking</button>";
                }        
        }
        }       else {
            echo "No Bookings Found😧";
        }
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']); 
        }
        ?>
        <h1>Change Password:</h1>
        <form id="password-reset-form" method="GET" action="changepassword.php"; ?>
            <div class="form-group">
                <label for="password">New password:</label>
                <input type="password" id="newpassword" name="newpassword" required>
            </div>
            <button type="submit" class="btn">Change password</button>
        </form>
        <!-- <script>
            function set_post_variable() {
                const xhttp = new XMLHttpRequest();
                xhttp.open("GET", "account.php");
                xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                // xhttp.onload = function() {
                //     document.getElementById("demo").innerHTML = this.responseText;
                // }
                xhttp.send("logout=True");
                location.reload();
            }
        </script> -->
        <script>
            function set_get_variable(){
                window.open("account.php?logout=True");
            }
        </script>
        <button type="button" onclick="set_get_variable()">Log Out</button>
        <?php
        }
    else{
    ?><p>You're not logged in 😧🫨.</p>
    <a href="/login.php"> Click to go to the login page.</a>
    <?php } ?>