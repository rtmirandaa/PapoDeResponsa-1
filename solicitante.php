<?php 
// Inicia a sessão
session_start();

// Verifica se a sessão está ativa. 
// Se 'ativa' está definida na sessão, $seguranca é TRUE, caso contrário, redireciona para 'index.php'
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel admin</title>
</head>
<body>
    <?php 
    // Se $seguranca é TRUE, exibe o conteúdo protegido
    if ($seguranca) { 
    ?>
        <h1>Bem vindo,
            <?php 
            // Exibe o email do solicitante armazenado na sessão
            echo $_SESSION['email_solicitante']; 
            ?> ao painel do site!
        </h1>
        <?php 
        // Inclui o menu do multiplicador
        include "layout/menuMultiplicador.php"; 
        ?>
    <?php 
    }  
    ?>
    <!-- Link para sair (logout) -->
    <a href="logout.php">Sair</a>
</body>
</html>
