<?php
session_start();
require 'conf/database.php';
require_once 'message.php';

$conn = get_connection();

$id = $_POST["id"];

$sqlCollaborator = "";
$sqlCollaboratorAddress = "";

if ($id == 0) {

    $sqlCollaborator = "INSERT INTO COLLABORATORS(NAME, BIRTHDATE, GENDER, FAMILLY, POSITION, SPECIALITY, CPF, RG)" .
        "VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

    $sqlCollaboratorAddress = "INSERT INTO COLLABORATOR_ADDRESS(COLLABORATOR, CEP, ADDRESS_TYPE, ADDRESS, NUMBER, COMPLEMENT, DISTRICT, CITY, STATE)" .
        "VALUES((SELECT MAX(ID) FROM COLLABORATORS), ?, ?, ?, ?, ?, ?, ?, ?)";

} else {
    $sqlCollaborator = "UPDATE COLLABORATORS " .
        "SET NAME = ?, " .
        "BIRTHDATE = ?, " .
        "GENDER = ?, " .
        "FAMILLY = ?, " .
        "POSITION = ?, " .
        "SPECIALITY = ?, " .
        "CPF = ?, " .
        "RG = ? " .
        "WHERE ID = $id";

    $sqlCollaboratorAddress = "UPDATE COLLABORATOR_ADDRESS " .
        "SET CEP = ?, " .
        "ADDRESS_TYPE = ?," .
        "ADDRESS = ?," .
        "NUMBER = ?," .
        "COMPLEMENT = ?," .
        "DISTRICT = ?," .
        "CITY = ?," .
        "STATE = ? " .
        "WHERE COLLABORATOR = $id";
}

$collaboratorStatement = $conn->prepare($sqlCollaborator) or die("Falha a criar COLLABORATOR Statement: " . $conn->error);

$collaboratorAddressStatement = $conn->prepare($sqlCollaboratorAddress) or die("Falha ao criar Address Statement" . $conn->error);

$collaboratorStatement->bind_param("ssssiiss", $name, $birthdate, $gender, $familly, $position, $speciality, $rg, $cpf);
$collaboratorAddressStatement->bind_param("sssissss", $cep, $address_type, $address, $number, $complement, $district, $city, $state);

$name = $_POST["name"];
$birthdate = $_POST["birthdate"];
$gender = $_POST["gender"];
$familly = $_POST["familly"];
$position = $_POST["position"];
$speciality = $_POST["speciality"];
$cpf = $_POST["cpf"];
$rg = $_POST["rg"];
$cep = $_POST["cep"];
$address_type = $_POST["address-type"];
$address = $_POST["address"];
$number = $_POST["address-number"];
$complement = $_POST["address-complement"];
$district = $_POST["district"];
$city = $_POST["city"];
$state = $_POST["state"];

$conn->begin_transaction();

$errorMessage =  serialize(new Message('danger', "Não foi possível cadastrar o funcionário!"));

$collaboratorStatement->execute() or $_SESSION['MESSAGE'] = $errorMessage;
$collaboratorAddressStatement->execute() or $_SESSION['MESSAGE'] = $errorMessage;

$conn->commit() or $_SESSION['MESSAGE'] = $errorMessage;

$collaboratorStatement->close();
$collaboratorAddressStatement->close();

$conn->close();

$_SESSION['MESSAGE'] = serialize(new Message('success', "Funcionário salvo com sucesso!"));

header('Location: employe_list.php');

?>