<?php  
  // Conectando com o banco de dados.
  $mysqli = new mysqli("localhost","root","","sistema_academico");

  // Iniciando uma sessão, para salvar temporariamente o ultimo úsuario (aluno) criado, possibilitando editar a coluna turma dele..
  session_start();

  $error = false;
  $usuario_error = false;

  if(isset($_POST ["txt-usuario"]) != '') {
    // Declarando Variáveis.
    $usuario = $_POST ["txt-usuario"];
    $senha = $_POST ["txt-senha"];
    $nome = $_POST ["txt-nome"];
    $divisao = $_POST ["txt-divisao"];
    
    $sql = $mysqli -> query("SELECT * FROM tb_usuarios WHERE usuario = '$usuario'");

    if ("$usuario" == "$senha") {
        $usuario_error = true;
    }

    if (mysqli_num_rows($sql) > 0) {  
        $error = true;
    }
    else {
        if ($divisao == "aluno" && $error == false && $usuario_error == false) {
          $_SESSION['usuario-valor'] = $usuario;
          $mysqli -> query ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao')");
          $mysqli -> query ("INSERT INTO tb_aluno VALUES ('$usuario','$nome','')");
          header("Location: cadastro-turma.php");
          exit();
        }
        else if($divisao == "professor" && $error == false && $usuario_error == false) {
          $mysqli -> query ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao')");
          $mysqli -> query ("INSERT INTO tb_professor VALUES ('$usuario','$nome','')");
        }
        else if($divisao == "secretaria" && $error == false && $usuario_error == false) {
          $mysqli -> query ("INSERT INTO tb_usuarios VALUES ('$usuario','$senha','$divisao')");
          $mysqli -> query ("INSERT INTO tb_secretaria VALUES ('$usuario','$nome','')");
        }
    }
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novo usuário</title>
  <link rel="stylesheet" href="../estilos/cadastro.css">
  <!-- FONTS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <main>
    <div class="div-logo">
      <img src="../imagens/logo.png" alt="Logo" class="logo">
    </div>
    <form name="form_cadastro" method="post">
      <label>Nome Completo</label>
      <input type="text" name="txt-nome" value="" size="35" maxlength="50" required="yes">

      <label>Usuário</label>
      <?php 
          if($error == false && $usuario_error == false) {
            echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes">';
          }
          else {
            echo '<input type="text" name="txt-usuario" value="" size="35" maxlength="30" required="yes" class="input-erro">';
          }
      ?>
  
      <label>Senha</label>
      <?php 
          // Dependendo se houver um erro ou não, isso vai mudar a cor da borda do input.
          if($usuario_error == false) {
            echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes">';
          }
          else if($error == true) {
            echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes">';
          }
          else {
            echo '<input type="password" name="txt-senha" value="" size="35" maxlength="30" required="yes" class="input-erro">';
          }
      ?>

      <label>Função</label>
      <div class="div-select">
        <select name="txt-divisao">
          <option value="aluno">Aluno</option>
          <option value="professor">Professor</option>
          <option value="secretaria">Secretaria</option>
        </select>
      </div>

      <div class="div-error">
        <?php 
          if($error == true) {
            echo "<p> Esse usuário já existe </p>";
          }
          else if($usuario_error == true) {
            echo "<p> O usuário e a senha não podem ser iguais </p>";
          }
        ?>
      </div>

      <div class="button">
        <input type="submit" value="Cadastrar">
      </div>
    </form>
  </main>
</body>
</html>