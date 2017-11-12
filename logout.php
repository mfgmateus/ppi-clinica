<?php

require 'message.php';

ob_start();
session_start();
unset($_SESSION['USER']);
$_SESSION['MESSAGE'] = serialize(new Message('success', "Logout realizado com sucesso!"));
ob_flush();
header('Location: index.php');
exit();
?>
