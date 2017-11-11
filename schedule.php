<html lang="pt-br">
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
                    <select name="medical-type">
                      <option id="0">Selecione</option>
                    </select>
                </div>
                <div class="col col-sm-12 col-xs-12 col-lg-12">
                    <label for="doctor">Médico</label>
                    <select name="doctor">
                      <option id="0">Selecione</option>
                    </select>
                </div>
                <div class="col col-sm-12 col-xs-12 col-lg-12">
                    <label for="date">Data</label>
                    <input type="date" name="date" />
                </div>
                <div class="col col-sm-12 col-xs-12 col-lg-12">
                    <label for="hour">Hora</label>
                    <select name="hour">
                      <option id="0">Selecione</option>
                    </select>
                </div>
                <div class="col col-sm-12 col-xs-12 col-lg-12">
                  <label for="pacient">Paciente</label>
                  <input type="text" name="pacient" />
                </div>
                <div class="col col-sm-12 col-xs-12 col-lg-12">
                  <label for="phone-pacient">Telefone (Paciente)</label>
                  <input type="text" name="phone-pacient" />
                </div>
                <div class="col col-sm-12 col-xs-12 col-lg-12">
                    <button type="submit" name="send">Agendar</button>
                </div>
            </div>
          </form>
        </div>
    </div>
  </body>
</html>