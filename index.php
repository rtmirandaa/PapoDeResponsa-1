<?php require_once "functions.php"; 
if(isset($_POST['acessar'])){
    login($connect);
    loginSolicitante($connect);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Acesso ao site</title>
</head>
<body>
    <form action="" method="post">
        <fieldset>
        <legend>Painel de login Multiplicador</legend>
        <input type="email" name="email_multiplicador" placeholder="informe seu e-mail" required>

        <input type="password" name="senha_multiplicador" placeholder="insira sua senha" required>

        <input type="submit" name="acessar" value="Acessar">
        </fieldset>
    </form>

    <?php

    ?>
    <form action="" method="post">
        <fieldset>
        <legend>Painel de login Solicitante</legend>
        
        <input type="email" name="email_solicitante" placeholder="informe seu e-mail" required>

        <input type="password" name="senha" placeholder="insira sua senha" required>

        <input type="submit" name="acessar" value="Acessar">
        </fieldset>
    </form>
    <a href="CadastroSolicitante.php">Cadastrar Solicitante</a>
    <a href="CadastroMultiplicador.php">Cadastrar Multiplicador</a>
</body>
</html>