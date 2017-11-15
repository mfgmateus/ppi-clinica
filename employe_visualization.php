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

    if (isset($_GET['id']) && $_GET['id'] != 0) {
        $id = htmlspecialchars($_GET['id']);
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
            document.getElementById("address").value = result.address || '';
            document.getElementById("district").value = result.district || '';
            document.getElementById("city").value = result.city || '';
            document.getElementById("state").value = result.state || '';
          }
        }
        xmlhttp.open("GET", "search_cep.php?cep=" + cep, true);
        xmlhttp.send();
      }
    }

    function toggleSpeciality(elem) {
      if (elem.value == 1) {
        $('.speciality-block').show();
      } else {
        $('.speciality-block').hide();
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      if($('#position').val() !== "1") {
        $('.speciality-block').hide();
      }
    }, false);

    function validateForm() {
      if(Date.parse(document.getElementById('birthdate').value) >= Date.now()){
        alert("A Data de Nascimento não pode ser menor que o dia de hoje!");
        return false;
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
    <form name="employe-form" method="post" action="employe_save.php" id="form" onsubmit="return validateForm()">
      <div class="row" style="padding-bottom: 20px">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label class="col-form-label" for="name">Nome</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-11">
          <input type="text" name="name" class="form-control" value="<? echo $name ?>" required minlength="5"
                 maxlength="50"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="birth-date">Data de Nascimento</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <input type="date" name="birthdate" id=birthdate" class="form-control" value="<? echo $birthdate ?>" required/>
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
        <div class="col col-sm-12 col-xs-12 col-lg-2 custom-label col-form-label">
          <label for="familly">Estado Civil</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <select name="familly" class="form-control" required>
              <?php foreach ($civilStates as $item) {
                  $selected = ($item == $familly) ? 'selected="selected"' : '';
                  echo "<option id=\"$item\" $selected>$item</option>";
              } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="position">Cargo</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-5 form-group custom-label">
          <select name="position" id="position" class="form-control" onchange="toggleSpeciality(this)" required>
            <option value="">Selecione</option>
              <?php foreach ($positions as $item) {
                  $selected = ($position == $item["ID"]) ? 'selected="selected"' : '';
                  echo "<option value=\"" . $item["ID"] . "\" $selected>" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 custom-label col-form-label speciality-block">
          <label for="speciality">Espec. Médica</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-4 form-group custom-label speciality-block">
          <select name="speciality" class="form-control">
            <option value="0">Selecione</option>
              <?php foreach ($specialities as $item) {
                  $selected = ($speciality == $item["ID"]) ? 'selected="selected"' : '';
                  echo "<option value=\"" . $item["ID"] . "\" $selected>" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="cpf">CPF</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-5 form-group custom-label">
          <input type="text" name="cpf" class="form-control" value="<? echo $cpf ?>" required minlength="11"
                 maxlength="11"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="rg">RG</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-5 form-group custom-label">
          <input type="text" name="rg" class="form-control" value="<? echo $rg ?>" required minlength="5"
                 maxlength="15"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="cep">CEP</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 form-group custom-label">
          <input type="number" id="cep" name="cep" class="form-control" value="<? echo $cep ?>"
                 onkeyup="searchCep()" required minlength="8" maxlength="8"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 custom-label col-form-label">
          <label for="address-type">Tipo Logradouro</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 form-group custom-label">
          <input type="text" name="address-type" class="form-control" value="<? echo $address_type ?>"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="address">Logradouro</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-4 form-group custom-label">
          <input type="text" id="address" class="form-control" name="address" value="<? echo $address ?>" required
                 minlength="3" maxlength="50"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="address-number">Número</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <input type="number" name="address-number" class="form-control" value="<? echo $number ?>" maxlength="6"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-2 custom-label col-form-label">
          <label for="address-complement">Complemento</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-6 form-group custom-label">
          <input type="text" name="address-complement" class="form-control" value="<? echo $complement ?>"
                 maxlength="20"/>
        </div>
      </div>
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="district">Bairro</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <input type="text" id="district" name="district" class="form-control" value="<? echo $district ?>"
                 maxlength="30"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="state">Estado</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <input type="text" id="state" name="state" class="form-control" value="<? echo $state ?>" required
                 minlength="3" maxlength="40"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-1 custom-label col-form-label">
          <label for="city">Cidade</label>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-3 form-group custom-label">
          <input type="text" id="city" name="city" class="form-control" value="<? echo $city ?>" required minlength="3"
                 maxlength="40"/>
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