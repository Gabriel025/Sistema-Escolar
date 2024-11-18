<?php 
  $db_server = "127.0.0.1";
  $db_user = "root";
  $db_pass = "usbw";
  $db_name = "db_sistema_academico";
  $conn = "";

  try {
    $conn = mysqli_connect($db_server, $db_user, $db_pass, $db_name);
  }
  catch(mysqli_sql_exception) {
    echo "Erro na Conexão <br>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
  
</body>
</html>