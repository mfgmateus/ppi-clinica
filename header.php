<?php session_start() ?>
<?php require_once 'message.php' ?>
<link rel="stylesheet" href="/css/header.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
      integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
        integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
        integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
        crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript" charset="utf8" src="js/datatable.js"></script>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <? echo ($_SERVER["PHP_SELF"] == '/index.php') ? 'active' : '' ?>">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item <? echo ($_SERVER["PHP_SELF"] == '/galery.php') ? 'active' : '' ?>">
        <a class="nav-link" href="galery.php">Galeria</a>
      </li>
      <li class="nav-item <? echo ($_SERVER["PHP_SELF"] == '/contact.php') ? 'active' : '' ?>">
        <a class="nav-link" href="contact.php">Contato</a>
      </li>
      <li class="nav-item <? echo ($_SERVER["PHP_SELF"] == '/schedule.php') ? 'active' : '' ?>">
        <a class="nav-link" href="schedule.php">Agendamento</a>
      </li>
        <?php if (isset($_SESSION['USER'])) : ?>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
               aria-haspopup="true" aria-expanded="false">
              Administração
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="schedule_list.php">Agendamentos</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="contact_list.php">Contatos</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="employe_list.php">Funcionários</a>
            </div>
          </li>
        <?php endif; ?>
    </ul>
    <div class="my-2 my-lg-0">
        <?php if (isset($_SESSION["USER"])) {
            echo "<a href=\"logout.php\"><button type='button' class='btn'>Logout</button></a>";
        } else {
            echo "<button type=\"button\" class=\"btn\" data-toggle=\"modal\" data-target=\"#login\">Login</button>";
        } ?>
    </div>
  </div>
</nav>
<div id="messages" style="padding-bottom: 5px">
    <?php
    $message = unserialize($_SESSION['MESSAGE']);
    echo $message;
    unset($_SESSION['MESSAGE']);
    ?>
</div>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form name="employe-form" method="post" action="login.php">
        <div class="modal-body">
          <div class="row">
            <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
              <label for="login">Usuário</label>
              <input type="text" name="login" class="form-control"/>
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
              <label for="password">Senha</label>
              <input type="password" name="password" class="form-control"/>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row">
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="submit" class="btn btn-primary">Entrar</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
