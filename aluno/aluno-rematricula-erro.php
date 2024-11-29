<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rematrícula</title>

  <link rel="stylesheet" href="styles/aluno-rematricula-erro.css">
</head>
<main>
  <div class="text-div"> 
    <p>
      <?php
        $usuario_rematriculado = $_SESSION['usuario-rematriculado'];

        $usuario_logado = $_SESSION['usuario-login'];

        if ($usuario_rematriculado == $usuario_logado)
        {
          echo "Sua Rematrícula Já Foi Realizada";
        }
        else 
        {
          echo "Não estamos em período de rematrícula";
        }
      
      ?>
      
    </p>
  </div>
</main>
