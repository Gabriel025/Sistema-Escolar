<?php

  session_start();

  if (isset($_GET ["mes"])) {
    $mes_selecionado = $_GET["mes"];
  }
  else {
    $mes_selecionado = "1";
  }

  $divisao = $_SESSION['usuario-divisao'];

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Período Letivo</title>

</head>
<main>
  <div class="main-content-div">
    <div class="periodo-imagem-div">
      <img src="../imagens/periodo-<?php echo "{$mes_selecionado}"?>.png" alt="periodo-letivo-imagem">
    </div>

    <div class="periodo-buttons-div">
      <div class="periodo-buttons">
        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=1"; ?>"> 
          <button>
            1
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=2"; ?>"> 
          <button>
            2
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=3"; ?>">  
          <button>
            3
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=4"; ?>">  
          <button>
            4
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=5"; ?>">  
          <button>
            5
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=6"; ?>">  
          <button>
            6
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=7"; ?>"> 
          <button>
            7
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=8"; ?>">  
          <button>
            8
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=9"; ?>">  
          <button>
            9
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=10"; ?>">  
          <button>
            10
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=11"; ?>">  
          <button>
            11
          </button>
        </a>

        <a href="<?php echo "{$divisao}.php?pagina=periodo-letivo&mes=12"; ?>">  
          <button>
            12
          </button>
        </a>
      </div>
    </div>
  </div>
</main>

