<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Funcionários</title>
  <meta charset="UTF-8">
    <?php
    require 'conf/database.php';

    $id = $_GET['id'] || 0;
    $action = $id == 0 ? "Cadastrar" : "Editar";

    $sqlPositions = "SELECT ID, NAME FROM POSITIONS ORDER BY NAME";
    $positions = select($sqlPositions);

    $sqlSpecialities = "SELECT ID, NAME FROM SPECIALITIES ORDER BY NAME";
    $specialities = select($sqlSpecialities);

    $civilStates = array("Solteiro (a)", "Casado (a)", "Divorciado (a)", "Viúvo (a)");

    $addressTypes = array("Rua", "Avenida", "Praça");

    if (isset($_POST['submit'])) {

        $conn = get_connection();

        $id = $_POST["id"];

        $sqlCollaborator = "";
        $sqlCollaboratorAddress = "";

        if ($id == 0) {

            $sqlCollaborator = "INSERT INTO COLLABORATORS(NAME, BIRTHDATE, GENDER, FAMILLY, POSITION, SPECIALITY, CPF, RG)" .
                "VALUES(?, ?, ?, ?, ?, ?, ?, ?)";

            $sqlCollaboratorAddress = "INSERT INTO COLLABORATOR_ADDRESS(COLLABORATOR, CEP, ADDRESS_TYPE, ADDRESS, NUMBER, COMPLEMENT, DISTRICT, CITY, STATE)" .
                "VALUES((SELECT MAX(ID) FROM COLLABORATORS), ?, ?, ?, ?, ?, ?, ?, ?)";

        } else {
            $sqlCollaborator = "UPDATE COLLABORATORS" .
                "SET NAME = ?, " .
                "BIRTHDATE = ?, " .
                "GENDER = ?, " .
                "FAMILLY = ?, " .
                "POSITION = ?, " .
                "SPECIALITY = ?, " .
                "CPF = ?, " .
                "RG = ?) " .
                "WHERE ID = $id";

            $sqlCollaboratorAddress = "UPDATE COLLABORATOR_ADDRESS" .
                "SET CEP = ?, " .
                "CEP = ?," .
                "ADDRESS_TYPE = ?," .
                "ADDRESS, NUMBER = ?," .
                "COMPLEMENT = ?," .
                "DISTRICT = ?," .
                "CITY = ?," .
                "STATE = ?)" .
                "WHERE ID = $id";
        }

        $collaboratorStatement = $conn->prepare($sqlCollaborator) or die("Falha a criar COLLABORATOR Statement: ".$conn->error);

        $collaboratorAddressStatement = $conn->prepare($sqlCollaboratorAddress) or die("Falha ao criar Address Statement");

        $collaboratorStatement->bind_param("ssssiiss", $name, $birthdate, $gender, $familly, $position, $speciality, $rg, $cpf);
        $collaboratorAddressStatement->bind_param("sssissss", $cep, $address_type, $address, $number, $complement, $district, $city, $state);

        $name = $_POST["name"];
        $birthdate = $_POST["birthdate"];
        $gender = $_POST["gender"];
        $familly = $_POST["familly"];
        $position = $_POST["position"];
        $speciality = $_POST["speciality"];
        $cpf = $_POST["cpf"];
        $rg = $_POST["rg"];
        $cep = $_POST["cep"];
        $address_type = $_POST["address-type"];
        $address = $_POST["address"];
        $number = $_POST["address-number"];
        $complement = $_POST["address-complement"];
        $district = $_POST["district"];
        $city = $_POST["city"];
        $state = $_POST["state"];

        $conn->begin_transaction();

        $collaboratorStatement->execute() or die("Falha ao cadastrar funcionario (funcionario)".$conn->error);
        $collaboratorAddressStatement->execute() or die("Falha a cadastrar funcionario (endereco)".$conn->error);

        $conn->commit() or die("Falha ao cadastrar  funcionario");

        $collaboratorStatement->close();
        $collaboratorAddressStatement->close();

        $conn->close();

        echo "Novo funcionário cadastrado!";
    }

    ?>
</head>
<body>
<?php require 'header.php' ?>
<div id="content">
  <div class="employe">
    <div class="employe-title">
      <h1><?php echo $action; ?> Funcionário</h1>
    </div>
    <form name="employe-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
      <div class="row">
        <input type="hidden" name="id" value="<?php echo $id;?>">
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="name">Nome</label>
          <input type="text" name="name"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="birth-date">Data de Nascimento</label>
          <input type="date" name="birthdate"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="gender">Sexo</label>
          <input type="radio" name="gender" value="F"/> Masculino
          <input type="radio" name="gender" value="M"/> Feminino
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="familly">Estado Civil</label>
          <select name="familly">
              <?php foreach ($civilStates as $item) {
                  echo "<option id=\"$item\">$item</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="position">Cargo</label>
          <select name="position">
              <?php foreach ($positions as $item) {
                  echo "<option value=\"" . $item["ID"] . "\">" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="speciality">Especialidade Médica</label>
          <select name="speciality">
              <?php foreach ($specialities as $item) {
                  echo "<option id=\"" . $item["ID"] . "\">" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="cpf">CPF</label>
          <input type="text" name="cpf"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="rg">RG</label>
          <input type="text" name="rg"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="cep">CEP</label>
          <input type="text" name="cep"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address-type">Tipo de Logradouro</label>
          <select name="address-type">
              <?php foreach ($addressTypes as $index => $item) {
                  echo "<option id=\"$index\">$item</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address">Logradouro</label>
          <input type="text" name="address"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address-number">Número</label>
          <input type="number" name="address-number"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address-complement">Complemento</label>
          <input type="text" name="address-complement"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="district">Bairro</label>
          <input type="text" name="district"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="state">Estado</label>
          <input type="text" name="state"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="city">Cidade</label>
          <input type="text" name="city"/>
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