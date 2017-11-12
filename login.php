<?php
if (isset($_POST['submit'])) {

    require_once 'message.php';
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
      <form name="employe-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
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