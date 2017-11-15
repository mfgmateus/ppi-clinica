<?php session_start() ?>
<html lang="pt-br">
<?php

require_once 'message.php';

$motivations = array("Reclamação", "Sugestão", "Elogio", "Dúvida", "Outro");

if (isset($_POST['submit'])) {
    require 'conf/database.php';

    $conn = get_connection();

    $sql = "INSERT INTO MESSAGES (NAME, EMAIL, MOTIVATION, MESSAGE) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $motivation, $message);

    $name = $_POST["name"];
    $email = $_POST["email"];
    $motivation = $_POST["motivation"];
    $message = $_POST["message"];

    $stmt->execute() or $_SESSION['MESSAGE'] = serialize(new Message('danger', "Não foi possível inserir mensagem"));

    $_SESSION['MESSAGE'] = serialize(new Message('success', "Contato realizado com sucesso!"));

    $stmt->close();
    $conn->close();

}
?>
<head>
  <link rel="stylesheet" href="/css/style.css">
  <title>Contato</title>
  <meta charset="UTF-8">
</head>
<body>
<?php require 'header.php' ?>
<div class="row" id="contact">
  <div class="col-sm-6 offset-sm-3 text-center">
    <div class="h2">Envie sua mensagem</div>
    <form name="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
          <label for="name">Nome</label>
          <input type="text" name="name" class="form-control" required minlength="3" maxlength="40"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
          <label for="email">Email</label>
          <input type="email" name="email" class="form-control" required minlength="5" maxlength="40"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
          <label for="motivation">Motivação</label>
          <select name="motivation" class="form-control" required>
              <?php foreach ($motivations as $item) {
                  echo "<option id=\"$item\">$item</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
          <label for="message">Mensagem</label>
          <textarea rows="4" name="message" class="form-control" required minlength="10" maxlength="300"></textarea>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12 form-group">
          <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>