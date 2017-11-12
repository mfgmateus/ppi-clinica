<?php session_start() ?>
<?php require 'security.php'; ?>
<html lang="pt-br">
<?php
require 'conf/database.php';

$sql = "SELECT C.NAME DOCTOR, CS.NAME SPECIALITY, S.SCHEDULE_DATE, S.SCHEDULE_TIME, " .
    "P.NAME PATIENT, P.PHONE PATIENT_PHONE " .
    "FROM COLLABORATORS C, SPECIALITIES CS, PATIENTS P, SCHEDULE S " .
    "WHERE C.SPECIALITY = CS.ID " .
    "AND P.ID = S.PATIENT " .
    "AND C.ID = S.DOCTOR ";

$items = select($sql);

?>
<head>
  <title>Agendamentos</title>
  <link rel="stylesheet" href="css/style.css">
  <meta charset="UTF-8">
</head>
<body>
<?php require 'header.php' ?>
<script>
  applyDatatable('#schedule-list');
</script>
<div class="row" id="contact">
  <div class="col-sm-12 col-xs-12 col-lg-12 text-center">
    <table id="schedule-list" class="table table-striped table-bordered">
      <thead>
      <td>Médico</td>
      <td>Especialiade</td>
      <td>Data</td>
      <td>Hora</td>
      <td>Paciente</td>
      <td>Telefone Paciente</td>
      </thead>
        <?php foreach ($items as $item) {
            echo "<tr>";
            echo "<td>" . $item['DOCTOR'] . "</td>";
            echo "<td>" . $item['SPECIALITY'] . "</td>";
            echo "<td>" . $item["SCHEDULE_DATE"] . "</td>";
            echo "<td>" . $item["SCHEDULE_TIME"] . "</td>";
            echo "<td>" . $item["PATIENT"] . "</td>";
            echo "<td>" . $item["PATIENT_PHONE"] . "</td>";
            echo "</tr>";
        } ?>
    </table>
  </div>
</div>
</body>
</html>