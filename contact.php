<html lang="pt-br">
<?php
  if (isset($_POST['submit'])){
      require 'conf/connect.php';

      $sql = "INSERT INTO MESSAGES (NAME, EMAIL, MESSAGE) VALUES (?, ?, ?)";

      $stmt = $conn->prepare($sql);
      $stmt->bind_param("sss", $name, $email, $message);

      $name = $_POST["name"];
      $email = $_POST["email"];
      $message = $_POST["message"];

      $stmt->execute() or die("Falha ao inserir mensagem");

      echo "Nova mensagem inserida";

      $stmt->close();
      $conn->close();

  }
?>
<head>
  <link rel="stylesheet" href="/css/style.css">
  <title>Home</title>
  <meta charset="UTF-8">
</head>
<body>
  <?php require 'header.php' ?>
  <div id="content">
    <div class="contact">
      <div class="contact-title">
        <h1>Envie sua mensagem</h1>
      </div>
      <form name="contact-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <div class="row">
          <div class="col col-sm-12 col-xs-12 col-lg-12">
            <label for="name">Nome</label>
            <input type="text" name="name" />
          </div>
          <div class="col col-sm-12 col-xs-12 col-lg-12">
            <label for="email">Email</label>
            <input type="email" name="email" />
          </div>
          <div class="col col-sm-12 col-xs-12 col-lg-12">
            <label for="message">Mensagem</label>
            <textarea name="message"></textarea>
          </div>
          <div class="col col-sm-12 col-xs-12 col-lg-12">
            <button type="submit" name="submit">Enviar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
