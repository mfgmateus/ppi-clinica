<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Funcionários</title>
  <meta charset="UTF-8">
  <?php
    $id = $_GET['id'] || 0;
    $action = $id == 0 ? "Cadastrar" : "Editar";

    $civilStates = array("Solteiro (a)", "Casado (a)", "Divorciado (a)", "Viúvo (a)");
    $positions = array("Atendente", "Médico (a)", "Enfermeiro (a)", "Secretário (a)");
    $specialities = array("Clínico Geral", "Ortodontista", "Pediatra", "Psiquiatra");
    $addressTypes = array("Rua", "Avenida", "Praça");
  ?>
</head>
  <body>
    <?php require 'header.php' ?>
    <div id="content">
      <div class="employe">
        <div class="employe-title">
          <h1><?php echo $action;?> Funcionário</h1>
        </div>
        <form name="employe-form" method="post" action="employe_send.php">
          <div class="row">
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="name">Nome</label>
              <input type="text" name="name" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="birth-date">Data de Nascimento</label>
              <input type="date" name="birth-date" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="sex">Sexo</label>
              <input type="radio" name="sex" value="Masculino"  /> Masculino
              <input type="radio" name="sex" value="Feminino" /> Feminino
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="civil-state">Estado Civil</label>
              <select name="civil-state">
                  <?php foreach ($civilStates as $index => $item) {
                      echo "<option id=\"$index\">$item</option>";
                  }?>
              </select>
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="position">Cargo</label>
              <select name="position">
                  <?php foreach ($positions as $index => $item) {
                      echo "<option id=\"$index\">$item</option>";
                  }?>
              </select>
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="medical-speciality">Especialidade Médica</label>
              <select name="speciality">
                  <?php foreach ($specialities as $index => $item) {
                      echo "<option id=\"$index\">$item</option>";
                  }?>
              </select>
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="cpf">CPF</label>
              <input type="text" name="cpf" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="rg">RG</label>
              <input type="text" name="rg" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="cpf">CPF</label>
              <input type="text" name="cpf" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="cep">CEP</label>
              <input type="text" name="cep" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="address-type">Tipo de Logradouro</label>
              <select name="address-type">
                  <?php foreach ($addressTypes as $index => $item) {
                      echo "<option id=\"$index\">$item</option>";
                  }?>
              </select>
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="address">Logradouro</label>
              <input type="text" name="address" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="address-number">Número</label>
              <input type="number" name="address-number" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="address-complement">Complemento</label>
              <input type="text" name="address-complement" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="district">Bairro</label>
              <input type="text" name="district" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="state">Estado</label>
              <input type="text" name="state" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <label for="city">Cidade</label>
              <input type="text" name="city" />
            </div>
            <div class="col col-sm-12 col-xs-12 col-lg-12">
              <button type="submit" name="send">Enviar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>