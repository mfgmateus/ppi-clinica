<?php session_start() ?>
<?php require 'message.php' ?>
<link rel="stylesheet" href="/css/header.css">
<div id="header">
  <ul id="menu">
    <li>
      <a href="index.php">Home</a>
    </li>
    <li>
      <a href="galery.php">Galeria</a>
    </li>
    <li>
      <a href="contact.php">Contato</a>
    </li>
    <li>
      <a href="schedule.php">Agendamento</a>
    </li>
    <li>
        <?php if (isset($_SESSION["USER"])) {
            echo "<a href=\"logout.php\">Logout</a>";
        } else {
            echo "<a href=\"login.php\">Login</a>";
        } ?>
    </li>
      <?php if (isset($_SESSION['USER'])) : ?>
        <li>
          <a href="#">Administração</a>
          <div class="adminstration-menu">
            <ul id="submenu">
              <li>
                <a href="employe_list.php">Funcionários</a>
              </li>
              <li>
                <a href="contact_list.php">Contatos</a>
              </li>
              <li>
                <a href="schedule_list.php">Agendamentos</a>
              </li>
            </ul>
          </div>
        </li>
      <?php endif; ?>
  </ul>
</div>
<div id="messages">
    <?php
    if (isset($_SESSION['MESSAGE'])) {
        $message = unserialize($_SESSION['MESSAGE']);
        echo $message;
        unset($_SESSION['MESSAGE']);
    }
    ?>
</div>