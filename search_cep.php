<?php session_start() ?>
<?php require 'security.php';?>
<?php
require 'conf/database.php';

header('Content-Type: application/json');
$cep = htmlspecialchars($_GET["cep"]);

$result = select("SELECT address, district, city, state FROM LOCATIONS WHERE CEP = $cep");

if (sizeof($result) > 0) {
    echo json_encode($result[0]);
} else {
    echo "{}";
}
?>