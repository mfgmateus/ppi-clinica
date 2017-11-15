<?php
session_start();
?>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Home</title>
  <meta charset="UTF-8">
  <script>
  </script>
</head>
<body>
<?php require 'header.php' ?>
<div id="content">
  <div class="row">
    <div class="col col-sm-10 offset-sm-1">
      <div class="block">
        <div>
          <div class="h3">Sobre a JAVADoctors</div>
          <div class="row">
            <div class="col col-sm-6 col-xs-6 col-lg-6">
              <p>Atuando principalmente na região do Triângulo Mineiro , a JAVADoctors
                é referência no ramo de clínicas especializadas. Contando com um corpo de mais de
                1000 colaboradores, sendo 65% formado por uma equipe própria de profissionais
                da área da saúde.
              <p>Conta com 10 unidades de atendimento equipadas com a mais nova tecnologia da medicina,
                preparadas para um pronto atendimento de qualidade , além de uma grande variedade de
                profissionais para consultas marcadas.</p>
              <p>Possui também centros de formação focados na preparação e especialização do corpo
                de profissionais .</p>
            </div>
            <div class="col col-sm-6 col-xs-6 col-lg-6">
              </p><img src="img/gallery-02.jpg" width="80%" height="50%"/>
            </div>
          </div>
        </div>
        <div>
          <span class="h3">Missão</span>
          <a href="#" id="missao-pointer" onclick="$('#missao').toggle('slow');">Mostrar/Ocultar</a>
          <div id="missao">
            <p>Procurar sempre realizar um atendimento profissional e humano,
              visando o bem estar e a saúde das pessoas, criando assim,
              uma vida com maior qualidade.</p>
          </div>
        </div>
        <div>
          <span class="h3">Valores</span>
          <a href="#" id="valores-pointer" onclick="$('#valores').toggle('slow');">Mostrar/Ocultar</a>
          <ul id="valores">
            <li>Responsabilidade com o social.</li>
            <li>Total transparência com o cliente.</li>
            <li>Qualidade nos serviços oferecidos.</li>
            <li>Valorização do ser humano.</li>
            <li>Respeito e Educação na formação de profissionais.</li>
            <li>Ética no mercado.</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>