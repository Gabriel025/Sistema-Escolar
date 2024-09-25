<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Estilos -->
  <link rel="stylesheet" href="../styles/normalize.css">
  <link rel="stylesheet" href="../styles/main.css">
  <link rel="stylesheet" href="../styles/sidebar.css">
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <!-- Icones -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php
    include "professor-sidebar.php";
    if($pagina == "avisos") {
      echo '<link rel="stylesheet" href="../styles/avisos.css">';
      include "../avisos.php";
    }
    else if($pagina == "periodo-letivo") {
      include "../periodo-letivo.php";
    }
    else if($pagina == "professor-nota") {
      include "professor-nota.php";
    }
    else if($pagina == "professor-atividades") {
      include "professor-atividades.php";
    }
    else if($pagina == "professor-chamada") {
      include "professor-chamada.php";
    }
    else {
      echo "Erro conectando com a outra página";
    }
  ?>
</body>
</html>