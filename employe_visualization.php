<?php session_start() ?>
<?php require 'security.php' ?>
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

    if ($id != 0) {
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

    ?>
  <script>
    function searchCep() {
      var cep = document.getElementById("cep").value;
      if (cep.length == 8) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var result = JSON.parse(xmlhttp.response);
            document.getElementById("address").value = result.address;
            document.getElementById("district").value = result.district;
            document.getElementById("city").value = result.city;
            document.getElementById("state").value = result.state;
          }
        }
        xmlhttp.open("GET", "search_cep.php?cep=" + cep, true);
        xmlhttp.send();
      }
    }
  </script>
</head>
<body>
<?php require 'header.php' ?>
<div class="row" id="content">
  <div class="col-sm-10 offset-sm-1 text-center">
    <div class="employe-title">
      <h1><?php echo $action; ?> Funcionário</h1>
    </div>
    <form name="employe-form" method="post" action="employe_save.php" id="form">
      <div class="row">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="col col-sm-12 col-xs-12 col-lg-12 form-group custom-label">
          <label for="name">Nome</label>
          <input type="text" name="name" class="form-control" value="<? echo $name ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-5 form-group custom-label">
          <label for="birth-date">Data de Nascimento</label>
          <input type="date" name="birthdate" class="form-control" value="<? echo $birthdate ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 form-group custom-label">
          <label for="gender">Sexo</label>
          <div class="row">
            <div class="col col-sm-6 col-xs-6 col-lg-6 form-group">
              <label class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="gender"
                       value="M" <? echo ($gender == "M") ? "checked" : "" ?>/>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">M</span>
              </label>
            </div>
            <div class="col col-sm-6 col-xs-6 col-lg-6 form-group">
              <label class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="gender"
                       value="F" <? echo ($gender == "F") ? "checked" : "" ?>/>
                <span class="custom-control-indicator"></span>
                <span class="custom-control-description">F</span>
              </label>
            </div>
          </div>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-5 form-group custom-label">
          <label for="familly">Estado Civil</label>
          <select name="familly" class="form-control">
              <?php foreach ($civilStates as $item) {
                  $selected = ($item == $familly) ? 'selected="selected"' : '';
                  echo "<option id=\"$item\" $selected>$item</option>";
              } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-6 form-group custom-label">
          <label for="position">Cargo</label>
          <select name="position" class="form-control">
              <option value="0">Selecione</option>
              <?php foreach ($positions as $item) {
                  $selected = ($position == $item["ID"]) ? 'selected="selected"' : '';
                  echo "<option value=\"" . $item["ID"] . "\" $selected>" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-6 form-group custom-label">
          <label for="speciality">Especialidade Médica</label>
          <select name="speciality" class="form-control">
              <option value="0">Selecione</option>
              <?php foreach ($specialities as $item) {
                  $selected = ($speciality == $item["ID"]) ? 'selected="selected"' : '';
                  echo "<option id=\"" . $item["ID"] . "\" $selected>" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-6 form-group custom-label">
          <label for="cpf">CPF</label>
          <input type="text" name="cpf" class="form-control" value="<? echo $cpf ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-6 form-group custom-label">
          <label for="rg">RG</label>
          <input type="text" name="rg" class="form-control" value="<? echo $rg ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <label for="cep">CEP</label>
          <input type="text" id="cep" name="cep" class="form-control" value="<? echo $cep ?>"
                 onkeyup="searchCep()"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 form-group custom-label">
          <label for="address-type">Tipo Logradouro</label>
          <input type="text" name="address-type" class="form-control" value="<? echo $address_type ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-5 form-group custom-label">
          <label for="address">Logradouro</label>
          <input type="text" id="address" class="form-control" name="address" value="<? echo $address ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 form-group custom-label">
          <label for="address-number">Número</label>
          <input type="number" name="address-number" class="form-control" value="<? echo $number ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <label for="address-complement">Complemento</label>
          <input type="text" name="address-complement" class="form-control" value="<? echo $complement ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <label for="district">Bairro</label>
          <input type="text" id="district" name="district" class="form-control" value="<? echo $district ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <label for="state">Estado</label>
          <input type="text" id="state" name="state" class="form-control" value="<? echo $state ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <label for="city">Cidade</label>
          <input type="text" id="city" name="city" class="form-control" value="<? echo $city ?>"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <button type="submit" name="submit" class="btn btn-primary">Salvar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>