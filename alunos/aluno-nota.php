<?php
// Conectando ao banco de dados
$mysqli = new mysqli("localhost","root","","sistema_academico");
session_start(); // Para salvar o nome do úsuario que está logando

$usuario = $_SESSION['usuario-nome'];

$query = "SELECT turma FROM tb_aluno WHERE usuario = '$usuario'";
$result = mysqli_query($mysqli, $query);

$row = mysqli_fetch_row($result);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="../estilos/style.css">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <main>
  </main>
  <nav class="sidebar">
    <div class="sidebar-content">
      <div class="user">
        <img src="../imagens/perfil_vazio.png" class="user-avatar" alt="Avatar">
        
        <p class="user-infos">
          <span class="item-description">
            <?php
              echo "Usuário: {$usuario}";
            ?>
          </span>
          
          <span class="item-description">
            <?php
              echo "Turma: {$row[0]}";
            ?>   
          </span>
        </p>
      </div>
  
      <ul class="side-items">
        <li class="side-item">
          <a href="aluno-avisos.php" target="_parent">
            <i class="fa-solid fa-house"></i>
            <span class="item-description">
              Avisos
            </span>
          </a>
        </li>
  
        <li class="side-item">
          <a href="aluno-periodo.php">
            <i class="fa-solid fa-calendar"></i>
            <span class="item-description">
              Período Letivo
            </span>
          </a>
        </li>
  
        <li class="side-item">
          <a href="aluno-rematricula.php">
            <i class="fa-solid fa-school"></i>
            <span class="item-description">
              Rematrícula
            </span>
          </a>
        </li>
  
        <li class="side-item active">
          <a href="#">
            <i class="fa-solid fa-bars-progress"></i>
            <span class="item-description">
              Nota/Falta
            </span>
          </a>
        </li>
  
        <li class="side-item">
          <a href="aluno-atividades.php">
            <i class="fa-solid fa-clipboard-check"></i>
            <span class="item-description">
              Atividades
            </span>
          </a>
        </li>
      </ul>
    </div>
    
    <div class="logout">
      <a href="../login.php" target="_parent">
      <button class="btn-logout">
        <i class="fa-solid fa-right-from-bracket"></i>
        Sair
      </button>
      </a>
    </div>
  </nav>
</body>
</html>