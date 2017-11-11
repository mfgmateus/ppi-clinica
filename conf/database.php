<?php

function select($conn, $sql) {

    $result = $conn->query($sql) or die($conn->error);

    $items = array();

    while($row = $result->fetch_assoc()) {
        $items[] = $row;
    }

    $conn->close();

    return $items;
}

?>
