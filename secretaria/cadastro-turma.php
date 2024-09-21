<?php  
  // Conectando com o banco de dados.
  $mysqli = new mysqli("localhost","root","","sistema_academico");

  // Iniciando uma sessão para pegar o valor do úsuario que está sendo afetado.
  session_start();

  $usuario = $_SESSION['usuario-valor'];

  if(isset($_POST ["txt-turma"]) != '') {
    $turma = $_POST ["txt-turma"];
    $mysqli -> query("UPDATE tb_aluno SET turma = '$turma' WHERE usuario = '$usuario';");
    header("Location: cadastro.php");
    exit();
  }

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
    <p class="turma-titulo">
      Escolha a turma desse aluno:
    </p>
    <form name="form_turma" method="post">
      <div class="grid">
        <button name="txt-turma" type="submit" value="a1" class="button-a1">A1</button>
        <button name="txt-turma" type="submit" value="b2" class="button-b2">B2</button>
      
        <button name="txt-turma" type="submit" value="c3" class="button-c3">C3</button>
        <button name="txt-turma" type="submit" value="d4" class="button-d4">D4</button>
      </div>
    </form>
  </main>
</body>
</html>