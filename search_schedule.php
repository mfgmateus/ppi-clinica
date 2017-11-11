<?php
require 'conf/database.php';

header('Content-Type: application/json');

if (!isset($_GET["doctor"])) {
    echo json_encode(array());
    return;
}
if (!isset($_GET["date"])) {
    echo json_encode(array());
    return;
}

$doctor = htmlspecialchars($_GET["doctor"]);
$date = htmlspecialchars($_GET["date"]);

$query = "SELECT SCHEDULE_TIME time FROM SCHEDULE " .
    "WHERE SCHEDULE_DATE = '$date' " .
    "AND DOCTOR = $doctor";

$originalResult = select($query);

$result = array();

if($originalResult == null){
    echo json_encode(array());
    return;
}

foreach ($originalResult as $item) {
    $result[] = intval($item["time"]);
}

if ($result == null) {
    echo json_encode(array());
} else {
    echo json_encode($result);
}

?>