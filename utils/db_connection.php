<?php
function OpenCon()
{
    $dbhost = "86.145.13.112";
    $dbuser = "website";
    $dbpass = "website";
    $db = "stars";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
    return $conn;
}
function CloseCon($conn)
{
    $conn->close();
}