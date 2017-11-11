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

    $civilStates = array("Solteiro(a)", "Casado(a)", "Divorciado(a)", "Viúvo(a)");

    $addressTypes = array("Rua", "Avenida", "Praça");

    if($id != 0){
      $query = "SELECT C.NAME, C.BIRTHDATE, C.GENDER, C.FAMILLY, C.POSITION, C.SPECIALITY, C.RG, C.CPF, " .
          "C.RG, CA.CEP, CA.ADDRESS_TYPE, CA.ADDRESS, CA.NUMBER, CA.COMPLEMENT, CA.DISTRICT, CA.CITY, CA.STATE " .
          "FROM COLLABORATORS C, COLLABORATOR_ADDRESS CA " .
          "WHERE C.ID = CA.COLLABORATOR " .
          "AND C.ID = $id";
        $results = select($query);

        $employe = $results[0];

        $name = $employe["NAME"];
        $birthdate = $employe["BIRTHDATE"];
        $gender = $employe["GENDER"];
        $familly = $employe["FAMILLY"];
        $position = $employe["POSITION"];
        $speciality = $employe["SPECIALITY"];
        $cpf = $employe["CPF"];
        $rg = $employe["RG"];
        $cep = $employe["CEP"];
        $address_type = $employe["ADDRESS_TYPE"];
        $address = $employe["ADDRESS"];
        $number = $employe["NUMBER"];
        $complement = $employe["COMPLEMENT"];
        $district = $employe["DISTRICT"];
        $city = $employe["CITY"];
        $state = $employe["STATE"];
    }

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
            $sqlCollaborator = "UPDATE COLLABORATORS " .
                "SET NAME = ?, " .
                "BIRTHDATE = ?, " .
                "GENDER = ?, " .
                "FAMILLY = ?, " .
                "POSITION = ?, " .
                "SPECIALITY = ?, " .
                "CPF = ?, " .
                "RG = ? " .
                "WHERE ID = $id";

            $sqlCollaboratorAddress = "UPDATE COLLABORATOR_ADDRESS " .
                "SET CEP = ?, " .
                "ADDRESS_TYPE = ?," .
                "ADDRESS = ?," .
                "NUMBER = ?," .
                "COMPLEMENT = ?," .
                "DISTRICT = ?," .
                "CITY = ?," .
                "STATE = ? " .
                "WHERE COLLABORATOR = $id";
        }

        $collaboratorStatement = $conn->prepare($sqlCollaborator) or die("Falha a criar COLLABORATOR Statement: ".$conn->error);

        $collaboratorAddressStatement = $conn->prepare($sqlCollaboratorAddress) or die("Falha ao criar Address Statement".$conn->error);

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
          <input type="text" name="name" value="<? echo $name ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="birth-date">Data de Nascimento</label>
          <input type="date" name="birthdate" value="<? echo $birthdate ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="gender">Sexo</label>
          <input type="radio" name="gender" value="F" <? echo ($gender == "F") ? "checked" : ""?>/> Feminino
          <input type="radio" name="gender" value="M" <? echo ($gender == "M") ? "checked" : ""?>/> Masculino
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="familly">Estado Civil</label>
          <select name="familly">
              <?php foreach ($civilStates as $item) {
                  $selected = ($item == $familly) ?  'selected="selected"' : '';
                  echo "<option id=\"$item\" $selected>$item</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="position">Cargo</label>
          <select name="position">
              <?php foreach ($positions as $item) {
                  $selected = ($position == $item["ID"]) ?  'selected="selected"' : '';
                  echo "<option value=\"" . $item["ID"] . "\" $selected>" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="speciality">Especialidade Médica</label>
          <select name="speciality">
              <?php foreach ($specialities as $item) {
                  $selected = ($speciality == $item["ID"]) ?  'selected="selected"' : '';
                  echo "<option id=\"" . $item["ID"] . "\" $selected>" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="cpf">CPF</label>
          <input type="text" name="cpf" value="<? echo $cpf?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="rg">RG</label>
          <input type="text" name="rg" value="<? echo $rg?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="cep">CEP</label>
          <input type="text" name="cep" value="<? echo $cep?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address-type">Tipo de Logradouro</label>
          <select name="address-type">
              <?php foreach ($addressTypes as $index => $item) {
                  $selected = ($address_type == $item["ID"]) ?  'selected="selected"' : '';
                  echo "<option id=\"$item\" $selected>$item</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address">Logradouro</label>
          <input type="text" name="address" value="<? echo $address?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address-number">Número</label>
          <input type="number" name="address-number" value="<? echo $number?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="address-complement">Complemento</label>
          <input type="text" name="address-complement" value="<? echo  $complement?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="district">Bairro</label>
          <input type="text" name="district" value="<? echo $district?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="state">Estado</label>
          <input type="text" name="state" value="<? echo $state ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="city">Cidade</label>
          <input type="text" name="city" value="<? echo $city?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <button type="submit" name="submit">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>