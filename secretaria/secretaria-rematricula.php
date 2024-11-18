<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rematrícula</title>
  <link rel="stylesheet" href="styles/secretaria_rematricula.css">
</head>
<main>

<div>
	<form class="rematricula" name="formrematricula" method="post">

	<center>
	<h3><b><label>REMATRICULA</label></h3>
	</center>
	<p>

	<fieldset>
		<legend><h1>Rematricula</h1></legend>

		<label><h2>Data de início</h2></label>
		<input type="date" id="inicio_rematricula" name="txt_inicio" size="25" required='yes'>
	
		<label><h2>Data de fechamento da rematricula</h2></label>

		<input type='date' id="fechamento_rematricula" name="txt_fechamento" size='25' required='yes'><p></p>
		<input type="submit" value = "Enviar" onclick="document.formfuncionarios.action=''" class="enviar">

</div>
	</fieldset>
	</form>
</main>