<?php session_start() ?>
<?php require 'message.php' ?>
<link rel="stylesheet" href="/css/header.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
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