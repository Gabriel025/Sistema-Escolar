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
      <div class="user-info-div">
        <p>
            <?php
            echo "Usuário: ";
              // Caso o nome do úsuario for maior que 12 caracteres, será printado somente as 12 primeiras letras de seu nome de usuário.
              if(strlen($usuario) > 12) {
                for ($i = 0; $i < 10; $i++) {
                  echo "{$usuario[$i]}";
                }
                echo "...";
              }
              else {
                echo "{$usuario}";
              }
            ?>
        </p>
      </div>
    </div>

    <ul class="side-items">
      <!-- Caso a página for a ativa, dar echo no "active" para mostrar isso visualmente. -->
      <li class="side-item <?php if ($pagina == "avisos") {echo "active";} ?>">
        <a href="secretaria.php?pagina=avisos">
          <i class="fa-solid fa-house"></i>
          <span class="item-description">
            Avisos
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "periodo-letivo") {echo "active";} ?>">
        <a href="secretaria.php?pagina=periodo-letivo">
          <i class="fa-solid fa-calendar"></i>
          <span class="item-description">
            Período Letivo
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "secretaria-avisos") {echo "active";} ?>">
        <a href="secretaria.php?pagina=secretaria-avisos">
          <i class="fa-solid fa-school"></i>
          <span class="item-description">
            Lançar Avisos
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "secretaria-rematricula") {echo "active";} ?>">
        <a href="secretaria.php?pagina=secretaria-rematricula">
          <i class="fa-solid fa-bars-progress"></i>
          <span class="item-description">
            Definir Rematrícula
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "secretaria-listagem") {echo "active";} ?>">
        <a href="secretaria.php?pagina=secretaria-listagem">
          <i class="fa-solid fa-clipboard-check"></i>
          <span class="item-description">
            Lista de Úsuarios
          </span>
        </a>
      </li>

      <li class="side-item <?php if ($pagina == "secretaria-cadastro") {echo "active";} ?>">
        <a href="secretaria.php?pagina=secretaria-cadastro">
          <i class="fa-solid fa-clipboard-check"></i>
          <span class="item-description">
            Novo Úsuario
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