<?php session_start(); 
// Verifica se a sessão está ativa. 
// Se 'ativa' está definida na sessão, $seguranca é TRUE, caso contrário, redireciona para 'index.php'
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:index.php");
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="style.css">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel admin - multiplicadores</title>
</head>
<body>
    <!-- Se $seguranca é TRUE, exibe o conteúdo protegido -->
    <?php if ($seguranca) { ?>
        <h1>
            <?php echo $_SESSION['nome_multiplicador']; ?> : Painel de Solicitantes
        </h1>

        <?php include "layout/menuMultiplicador.php"; ?>

    <?php }  ?>



</body>
</html>