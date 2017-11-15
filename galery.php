<?php session_start() ?>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="css/style.css">
  <title>Galeria</title>
  <meta charset="UTF-8">
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      var elems = Array.from(document.getElementsByTagName('img'));
      elems.map(function (elem) {
        elem.onmouseenter = function () {
          elem.style.outline =  'solid 4px rgba(255, 0, 0, 0.7)';
          elem.style['outline-offset'] = '-10px';
        };
        elem.onmouseleave = function () {
          elem.style.outline =  '';
        };
      });
    }, false);

  </script>
</head>
<body>
<?php require 'header.php' ?>
<div id="content">
  <div class="row">
    <div class="col col-sm-10 offset-sm-1 text-center">
      <div class="h3 text-center">Galeria</div>
      <div class="gallery-table">
        <table>
          <tr>
            <td><img src="img/gallery-01.jpg"></td>
            <td><img src="img/gallery-02.jpg"></td>
            <td><img src="img/gallery-03.jpg"></td>
          </tr>
          <tr>
            <td><img src="img/gallery-04.jpg"></td>
            <td><img src="img/gallery-05.jpg"></td>
            <td><img src="img/gallery-06.jpg"></td>
          </tr>
        </table>
      </div>
      <div class="gallery-video">
        <iframe width="640" height="360"
                src="https://www.youtube.com/embed/eqBzAHTYb7c"
                frameborder="0" gesture="media" allowfullscreen>
        </iframe>
      </div>
    </div>
  </div>
</div>
</body>
</html>