<?php

  include "database.php";

  date_default_timezone_set("America/Sao_Paulo");

  $data_atual = date("Y-m-d");

  session_start();

  $divisao = $_SESSION['usuario-divisao'];

  if (isset($_GET['novo_aviso'])) 
  {
    $novo_aviso = $_GET['novo_aviso'];
  }

  if (isset($_POST["titulo-txt"]) != "")
  {
    $titulo = $_POST["titulo-txt"];
    $conteudo = $_POST["conteudo-txt"];


    $sql = "INSERT INTO tb_avisos VALUES (NULL, '$titulo', '$conteudo', '$data_atual')";
    $result = mysqli_query($conn, $sql);

    header("Location: {$divisao}.php?pagina=avisos");

  }

  if (isset($_GET['shard'])) 
  {
    $shard_content = $_GET['shard'];
  }

  if (isset($_GET['delete'])) 
  {
    $shard_selected = $_GET['delete'];

    $sql = "DELETE FROM tb_avisos WHERE id_aviso = '$shard_selected'";
    $result = mysqli_query($conn, $sql);

    header("Location: secretaria.php?pagina=avisos");
  }


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Avisos</title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="styles/avisos.css">

  <script>
        $(document).ready(function() {
            <?php if ($novo_aviso): ?>
                $('#novoAvisoModal').modal('show');
            <?php endif; ?>
        });

        $(document).ready(function() {
            <?php if ($shard_content): ?>
                $('#shardModal').modal('show');
            <?php endif; ?>
        });

  </script>

</head>
<main>
  <h1 class="avisos-title"> Avisos </h1>
  <div class="avisos-div">
    <?php

      $sql = "SELECT * FROM tb_avisos ORDER BY data_aviso DESC";
      $result = mysqli_query($conn, $sql);

      if ($divisao == "secretaria")
      {
        echo 
        "
          <a href='secretaria.php?pagina=avisos&novo_aviso=true'>
            <div class='aviso-shard'>
              <div class='aviso-shard-title'>
                <p>
                  Criar Novo Aviso
                </p>
              </div>

              <div class='aviso-shard-date'>
              </div>
            </div>
          </a>
        ";
      }

      while ($row = mysqli_fetch_assoc($result))
      {

        $conversao = strtotime($row["data_aviso"]);

        $data_display = date('d/m/Y',$conversao);


        echo 
        "
          <a href='{$divisao}.php?pagina=avisos&shard={$row["id_aviso"]}'>
            <div class='aviso-shard'>
              <div class='aviso-shard-title'>
                <p>
                  {$row["titulo_aviso"]}
                </p>
              </div>

              <div class='aviso-shard-date'>
                <p>
                  {$data_display}
                </p>
              </div>
            </div>
          </a>
        ";
      }
    
    ?>
    
  </div>


  <!-- Pop Up Criar Aviso -->
  <div class="modal" id="novoAvisoModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Novo Aviso</h4>
          <a href="<?php echo "{$divisao}"; ?>.php?pagina=avisos" class="btn-close"></a>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="logo-div">
            <img src="../imagens/logo-alt.png" alt="Logo">
          </div>

          <div class="form-div">

            <form method="POST" class="aviso-form">
              <div class="titulo-input-div">
                <label>
                  Título
                </label>
                <input type="text" name="titulo-txt" maxlength="60" required="yes">
              </div>

              <div class="conteudo-input-div">
                <label>
                  Conteúdo
                </label>
                <textarea name="conteudo-txt" cols="40" rows="8" maxlength="600"></textarea>
              </div>

              <button type="submit" class="btn btn-success">
                Confirmar
              </button>
            </form>
          </div>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <a href="<?php echo "{$divisao}"; ?>.php?pagina=avisos" class="btn btn-danger">Cancelar</a>
        </div>

      </div>
    </div>
  </div>

  <div class="modal" id="shardModal">
    <div class="modal-dialog">
      <div class="modal-content">

      <?php
        $sql = "SELECT * FROM tb_avisos WHERE id_aviso = '{$_GET["shard"]}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0)
          {
            while ($row = mysqli_fetch_assoc($result))
            {
              $titulo = $row["titulo_aviso"];
              $conteudo = $row["texto_aviso"];
              $id_aviso = $row["id_aviso"];

              $conversao = strtotime($row["data_aviso"]);

              $data_display = date('d/m/Y',$conversao);
            }
          }
           
      ?>

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title"></h4>
          <a href="<?php echo "{$divisao}"; ?>.php?pagina=avisos" class="btn-close"></a>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <div class="logo-div">
            <img src="../imagens/logo-alt.png" alt="Logo">
          </div>

          <div class="titulo-aviso">
            <p>
              <?php echo "{$titulo}"; ?>
            </p>
          </div>

          <div class="conteudo-aviso">
            <p>
              <?php echo "{$conteudo}"; ?>
            </p>
          </div>

          <div class="data-aviso">
            <p>
              <?php echo "{$data_display}"; ?>
            </p>
          </div>

        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          <?php
          
            if ($divisao == "secretaria") {
              echo 
              "
                <a href='secretaria.php?pagina=avisos&delete={$id_aviso}' class='btn btn-danger'><i class='fa-solid fa-trash'></i></a>
              ";
            }
          ?>
          <a href="<?php echo "{$divisao}"; ?>.php?pagina=avisos" class="btn btn-danger">Fechar</a>
        </div>

      </div>
    </div>
  </div>
</main>
  

