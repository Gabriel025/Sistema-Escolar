<?php
  // Conectando ao banco de dados
  include "../database.php"; 

  // Iniciando uma sessão local para salvar dados temporariamente.
  session_start();

  // Atribuindo $usuario o valor que foi inserido no login.
  $usuario = $_SESSION['usuario-login'];

  // O sistema de roteação de páginas através do método GET.
  if (isset($_GET['pagina'])) {
    $pagina = $_GET['pagina'];
  }
  else {
    $pagina = "avisos";
  }
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<nav class="sidebar">
  <div class="sidebar-content">
    <div class="sidebar-user">
      <img src="../imagens/perfil_vazio.png" class="sidebar-avatar" alt="Avatar">
      <p>
        <span class="item-description">
          <?php
          echo "Usuário: ";
            // Caso o nome do úsuario for maior que 7, será printado somente as 7 primeiras letras de seu nome.
            if(strlen($usuario) > 9) {
              for ($i = 0; $i < 7; $i++) {
                echo "{$usuario[$i]}";
              }
              echo "...";
            }
            else {
              echo "{$usuario}";
            }
          ?>
        </span>
      </p>
    </div>

    <ul class="side-items">
      <!-- Caso a página for a ativa, dar echo no "active" para mostrar isso visualmente. -->
      <li class="side-item <?php if ($pagina == "avisos") {echo "active";} ?>">
        <a href="professor.php?pagina=avisos">
          <i class="fa-solid fa-house"></i>
          <span class="item-description">
            Avisos
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "periodo-letivo") {echo "active";} ?>">
        <a href="professor.php?pagina=periodo-letivo">
          <i class="fa-solid fa-calendar"></i>
          <span class="item-description">
            Período Letivo
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "professor-nota") {echo "active";} ?>">
        <a href="professor.php?pagina=professor-nota">
          <i class="fa-solid fa-school"></i>
          <span class="item-description">
            Alocar Nota
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "professor-atividades") {echo "active";} ?>">
        <a href="professor.php?pagina=professor-atividades">
          <i class="fa-solid fa-bars-progress"></i>
          <span class="item-description">
            Lançar Atividades
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "professor-chamada") {echo "active";} ?>">
        <a href="professor.php?pagina=professor-chamada">
          <i class="fa-solid fa-clipboard-check"></i>
          <span class="item-description">
            Chamada Online
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