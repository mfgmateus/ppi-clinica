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
  <div id="content">
      <div class="contact-table">
        <table>
          <thead>
            <td>Nome</td>
            <td>Email</td>
            <td>Motivo</td>
            <td>Mensagem</td>
          </thead>
          <?php foreach ($items as $item){
            echo "<tr>";
            echo "<td>" . $item['NAME'] . "</td>";
            echo"<td>" . $item["EMAIL"] . "</td>";
            echo"<td>" . $item["MOTIVATION"] . "</td>";
            echo"<td>" . $item["MESSAGE"] . "</td>";
            echo "</tr>";
          } ?>
        </table>
      </div>
  </div>
</body>
</html>