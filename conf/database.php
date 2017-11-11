<?php

require 'credentials.php';

function get_connection()
{
    $connection = new mysqli(Credentials::getServer(), Credentials::getUser(), Credentials::getPass(), Credentials::getDatabase());

    mysqli_set_charset($connection, 'utf8');

    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    return $connection;
}

function select($sql) {

    $conn = get_connection();

    $result = $conn->query($sql) or die($conn->error);

    while($row = $result->fetch_assoc()) {
        $items[] = array_merge(array(), $row);
    }

    $conn->close();

    return $items;
}

?>
