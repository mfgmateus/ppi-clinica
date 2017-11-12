<?php

session_start();

require_once 'message.php';

if (!isset($_SESSION['USER'])) {
    $_SESSION['MESSAGE'] = serialize(new Message('danger', 'Area restrita. Você precisa estar logado para acessar esta página.'));
    header("Location: index.php");
    exit;
}

?>
