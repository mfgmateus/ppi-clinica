<?php


    $servername = "mysql";
    $username = "root";
    $password = "password";
    $database = "CLINICA";

    $conn = new mysqli($servername, $username, $password, $database);

    $q = mysqli_set_charset($conn, 'utf8');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
