<?php session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:index.php")
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel admin</title>
</head>
<body>
    <?php if ($seguranca) { ?>

        <h1>Bem vindo,
            <?php echo $_SESSION['email_solicitante']; ?> ao painel do site!
        </h1>

        <?php include "layout/menuMultiplicador.php"; ?>

    <?php }  ?>
    <a href="logout.php">Sair</a>
</body>
</html>