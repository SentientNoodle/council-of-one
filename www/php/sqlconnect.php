<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "council";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("<p>Connection failed: " . $conn->connect_error . "</p>");
    }
?>