<?php session_start() ?>
<?php require 'security.php'; ?>
<html lang="pt-br">

<?php

require 'conf/database.php';

$sql = "SELECT ID, NAME, EMAIL, MOTIVATION, MESSAGE FROM MESSAGES";

$items = select($sql);

?>

<head>
  <link rel="stylesheet" href="/css/style.css">
  <title>Mensagens</title>
  <meta charset="UTF-8">
</head>
<body>
<?php require 'header.php' ?>
<script>
  applyDatatable('#contact-list');
</script>
<div id="content">
  <div class="row">
    <div class="col col-sm-12 col-xs-12 col-lg-12 text-center">
      <div class="h3">Contatos</div>
    </div>
  </div>
  <div class="row" id="contact">
    <div class="col col-sm-12 col-xs-12 col-lg-12">
      <table id="contact-list" class="table table-striped table-bordered">
        <thead>
        <td>Nome</td>
        <td>Email</td>
        <td>Motivo</td>
        <td>Mensagem</td>
        </thead>
          <?php foreach ($items as $item) {
              echo "<tr>";
              echo "<td>" . $item['NAME'] . "</td>";
              echo "<td>" . $item["EMAIL"] . "</td>";
              echo "<td>" . $item["MOTIVATION"] . "</td>";
              echo "<td>" . $item["MESSAGE"] . "</td>";
              echo "</tr>";
          } ?>
      </table>
    </div>
  </div>
</div>
</body>
</html>