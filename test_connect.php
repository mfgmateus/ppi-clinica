<?php session_start() ?>
<html lang="pt-br">
<?php

  require 'conf/database.php';
  $conn = get_connection();

  if($conn){
    echo "connectado com sucesso!";
  }

?>
