<html lang="pt-br">
<?php

require 'conf/database.php';

$sql = "SELECT C.ID, C.NAME, C.GENDER, P.NAME AS POSITION, " .
    "C.RG, CA.ADDRESS_TYPE, CA.ADDRESS, CA.NUMBER, CA.COMPLEMENT, CA.CITY " .
    "FROM COLLABORATORS C, COLLABORATOR_ADDRESS CA, POSITIONS P " .
    "WHERE P.ID = C.POSITION " .
    "AND C.ID = CA.COLLABORATOR ";

$items = select($sql);

?>
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Funcionários</title>
  <meta charset="UTF-8">
</head>
<body>
<?php require 'header.php' ?>
<div id="content">
  <a href ="employe_visualization.php">Cadastrar Funcionário</a>
  <div class="employe-table">
    <table>
      <thead>
      <td>Nome</td>
      <td>Sexo</td>
      <td>Cargo</td>
      <td>RG</td>
      <td>Logradouro</td>
      <td>Cidade</td>
      <td colspan="2">Ações</td>
      </thead>
        <?php foreach ($items as $item) {
            echo "<tr >";
            echo "<td >" . $item["NAME"] . "</td >";
            echo "<td >" . $item["GENDER"] . "</td >";
            echo "<td >" . $item["POSITION"] . "</td >";
            echo "<td >" . $item["RG"] . "</td >";
            echo "<td >" . $item["ADDRESS_TYPE"] . " " . $item["ADDRESS"] . ", " . $item["NUMBER"] . " " . $item["COMPLEMENT"] . "</td >";
            echo "<td >" . $item["CITY"] . "</td >";
            echo "<td ><a href = \"employe_visualization.php?id=" . $item["ID"] . "\" > Editar</a ></td >";
            echo "<td ><a href = \"employe_delete.php?id=" . $item["ID"] . "\" > Excluir</a ></td >";
            echo "</tr >";
        } ?>
    </table>
  </div>
</div>
</body>
</html>