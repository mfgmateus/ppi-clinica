<?php

function select($conn, $sql) {

    $result = $conn->query($sql) or die($conn->error);

    while($row = $result->fetch_assoc()) {
        $items[] = array_merge(array(), $row);
    }

    $conn->close();


    return $items;
}

?>
