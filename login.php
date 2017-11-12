<?php
if (isset($_POST['submit'])) {

    require 'message.php';
    require 'conf/database.php';

    $login = $_POST['login'];
    $password = $_POST['password'];

    $conn = get_connection();

    $query = "SELECT ID FROM USERS WHERE LOGIN = ? AND PASS = ?";

    $stmt = $conn->prepare($query);

    $stmt->bind_param("ss", $login, $password);

    $stmt->execute();
    $result = $stmt->get_result()->fetch_array();

    if (sizeof($result) > 0) {
        ob_start();
        session_start();
        $_SESSION['USER'] = $login;
        $_SESSION['MESSAGE'] = serialize(new Message('success', "Login realizado com sucesso!"));
        ob_flush();
        header('Location: index.php');
        exit();
    }

}
?>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Login</title>
  <meta charset="UTF-8">
</head>
<body>
<div id="content">
  <form name="employe-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <div class="row">
      <div class="col col-sm-12 col-xs-12 col-lg-12">
        <label for="login">Login</label>
        <input type="text" name="login"/>
      </div>
      <div class="col col-sm-12 col-xs-12 col-lg-12">
        <label for="password">Senha</label>
        <input type="password" name="password"/>
      </div>
    </div>
    <div class="row">
      <div class="col col-sm-12 col-xs-12 col-lg-12">
        <button type="submit" name="submit">Entrar</button>
      </div>
    </div>
  </form>
</div>
</body>
</html>