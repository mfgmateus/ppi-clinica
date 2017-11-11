<html lang="pt-br">
<?php

require 'conf/database.php';

$sqlSpecialities = "SELECT ID, NAME FROM SPECIALITIES ORDER BY NAME";
$specialities = select($sqlSpecialities);

$times = array(8, 9, 10, 11, 13, 14, 15, 16, 17);
?>
<script>

  function removeOptions(selectbox) {
    var i;
    for (i = selectbox.options.length - 1; i >= 0; i--) {
      selectbox.remove(i);
    }
  }

  function addOption(element, id, text){
    var option = document.createElement("option");
    option.text = text;
    option.value = id;
    element.add(option);
  }

  function searchDoctor() {

    var specialityElement = document.getElementById("speciality");
    var speciality = specialityElement.value;

    var doctorElement = document.getElementById("doctor");
    removeOptions(doctorElement);

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var result = JSON.parse(xmlhttp.response);
        addOption(doctorElement, 0, 'Selecione');
        result.map(function(item){
          addOption(doctorElement, item.id, item.name);
        });

      }
    }
    xmlhttp.open("GET", "search_doctor.php?speciality=" + speciality, true);
    xmlhttp.send();
  }

  function searchTime() {

    var timeElement = document.getElementById("hour");

    var doctor = document.getElementById("doctor").value;
    var date = document.getElementById("date").value;

    removeOptions(timeElement);

    var times = [8, 9, 10, 11, 13, 14, 15, 16, 17];

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
      if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
        var result = JSON.parse(xmlhttp.response);
        result.map(function(item){
          times = times.filter(function (value) { return value != item });
        });
        addOption(timeElement, 0, 'Selecione');
        times.map(function (item) { addOption(timeElement, item, item) });
      }
    }
    xmlhttp.open("GET", "search_schedule.php?doctor=" + doctor + "&date=" + date, true);
    xmlhttp.send();
  }
</script>
<head>
  <link rel="stylesheet" href="css/style.css">
  <meta charset="UTF-8">
  <title>Agendamento</title>
</head>
<body>
<?php require 'header.php' ?>
<div id="content">
  <div class="schedule">
    <div class="schedule-title">
      <h1>Agende sua consulta</h1>
    </div>
    <form name="schedule-form" method="post" action="schedule_send.php">
      <div class="row">
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="medical-type">Especiliadade Médica</label>
          <select name="speciality" id="speciality" oninput="searchDoctor()">
            <option value="0">Selecione</option>
              <?php foreach ($specialities as $item) {
                  echo "<option value=\"" . $item["ID"] . "\">" . $item["NAME"] . "</option>";
              } ?>
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="doctor">Médico</label>
          <select name="doctor" id="doctor">
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="date">Data</label>
          <input type="date" name="date" id="date" onchange="searchTime()"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="hour">Hora</label>
          <select name="hour" id="hour">
          </select>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="pacient">Paciente</label>
          <input type="text" name="pacient"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <label for="phone-pacient">Telefone (Paciente)</label>
          <input type="text" name="phone-pacient"/>
        </div>
        <div class="col col-sm-12 col-xs-12 col-lg-12">
          <button type="submit" name="submit">Agendar</button>
        </div>
      </div>
    </form>
  </div>
</div>
</body>
</html>