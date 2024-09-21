<?php  
  // Conectando com o banco de dados.
  $mysqli = new mysqli("localhost","root","","sistema_academico");

  session_start();

  $usuario = $_SESSION['usuario-valor'];
    
  echo $usuario;
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Turma</title>
  <link rel="stylesheet" href="../estilos/cadastro.css">
</head>
<body>
  <main>
    <div class="div-logo">
      <img src="../imagens/logo.png" alt="Logo" class="logo">
    </div>
  </main>
</body>
</html>