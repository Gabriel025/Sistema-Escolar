<?php

  session_start();

  $divisao = $_SESSION['usuario-divisao'];

  if (isset($_GET['novo_aviso'])) 
  {
    $novo_aviso = $_GET['novo_aviso'];
  }


?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <link rel="stylesheet" href="styles/avisos.css">

  <script>
        $(document).ready(function() {
            <?php if ($novo_aviso): ?>
                $('#novoAvisoModal').modal('show');
            <?php endif; ?>
        });

  </script>

</head>
<main>
  <h1 class="avisos-title"> Avisos </h1>
  <div class="avisos-div">
    <?php

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
              <!-- <p>
                26/11/2024
              </p> -->
            </div>
          </div>
        </a>
      ";
    }
    
    ?>
    
  </div>


  <!-- Pop Up Criar Usuário -->
  <div class="modal" id="novoAvisoModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Novo Usuário</h4>
          
        </div>

        <!-- Modal body -->
        <div class="modal-body">
            <div class="logo-div">
              <img src="../imagens/logo-alt.png" alt="Logo">
            </div>
          <form method="POST">
            
          </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
          
        </div>

      </div>
    </div>
  </div>
</main>
  

