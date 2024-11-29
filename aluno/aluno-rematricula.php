<?php
  include "../database.php";

  date_default_timezone_set("America/Sao_Paulo");

  $data_atual_str = date("Y-m-d");

  $data_atual = DateTime::createFromFormat('Y-m-d', $data_atual_str);

  $usuario_rematriculado = $_SESSION['usuario-rematriculado'];

  $usuario_logado = $_SESSION['usuario-login'];

  $sql = "SELECT * FROM tb_rematricula";
  $result = mysqli_query($conn, $sql);

  while ($row = mysqli_fetch_assoc($result)) 
  {
    $abertura = DateTime::createFromFormat('Y-m-d', $row["data_abertura"]);
		$fechamento = DateTime::createFromFormat('Y-m-d', $row["data_fechamento"]);

    if ($data_atual < $abertura || $data_atual > $fechamento || $usuario_rematriculado == $usuario_logado) {
      header("Location: aluno.php?pagina=aluno-rematricula-erro");
    }
  }

  if (isset($_POST["txt-usuario"]))
  {

    $nome = $_POST["txt-nome"];
    $usuario = $_POST["txt-usuario"];

    if ($usuario == $usuario_logado)
    {
      $sql = "SELECT * FROM tb_usuarios WHERE usuario = '$usuario'";

      $result = mysqli_query($conn, $sql);

      while ($row = mysqli_fetch_assoc($result))
      {
        if ($row["nome"] == $nome)
        {
          $_SESSION['usuario-rematriculado'] = $usuario;
          header("Location: aluno.php?pagina=avisos");
        }
        else
        {
          $nome_error = true;
        }
      }
    }
    else {
      $usuario_error = true;
    }
  }

?>


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rematrícula</title>
  <link rel="stylesheet" href="styles/aluno-rematricula.css">
</head>
<main>
  <form class="rematricula-form" name="rematricula-aluno-form" method="POST">
    <div class="input-div">
      <label>
        Nome Completo
      </label>
      <input type="text" maxlength="60" required="yes" name="txt-nome">
    </div>
    
    <div class="input-div">
      <label>
        Usuario
      </label>
      <input type="text" maxlength="30" required="yes" name="txt-usuario">
    </div>

    <p>
      Ao confirmar, você estará aceitando os termos de condição da escola. 
    </p>

    <div class="button-div">
      <button type="submit">
        Confirmar
      </button>
      <?php 
      if ($usuario_error == true) {echo "<p>Nome de usuário incorreto</p>";} 
      else if ($nome_error == true) {echo "<p>Nome incorreto</p>";} 
      ?>
    </div>

  </form>
</main>
