<?php session_start() ?>
<?php
require 'conf/database.php';

header('Content-Type: application/json');

if (isset($_GET["speciality"])) {
    $speciality = htmlspecialchars($_GET["speciality"]);


    $result = select("SELECT id, name FROM COLLABORATORS WHERE SPECIALITY = $speciality");

    if ($result == null) {
        echo json_encode(array());
    } else {
        echo json_encode($result);
    }

} else {
    echo json_encode(array());
}
?>