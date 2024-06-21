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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style/login.css">
</head>
<body id = "principal">
    <div class="logo">
        <a href="index.php">
            <img src="style/papoLogo.jfif" alt="imagem que representa o logo do PPR">
        </a>
    </div>
    <div id="login">
        <div class="pclogo">
            <img  src="img/PC logo.png" alt="">
        </div>

        <div class="caixa">
            <form action="" method="post">
                <fieldset>
                <h1>LOGIN MULTIPLICADOR</h1>
                <div class="email">
                    <input type="email" name="email_multiplicador" placeholder="informe seu e-mail" required>
                </div>
                <div class="senha">
                    <input type="password" name="senha_multiplicador" placeholder="insira sua senha" required>
                </div>
                <div class="entrar">
                    <input type="submit" name="acessar" value="Acessar">
                </div>
                <a href="CadastroMultiplicador.php">Cadastrar Multiplicador</a>
                </fieldset>
            </form>
           
        </div>
        <div class="caixa">
            <?php
            ?>
            <form action="" method="post">
                <fieldset>
                <h1>LOGIN SOLICITANTE</h1>
                <div class="email">
                    <input type="email" name="email_solicitante" placeholder="informe seu e-mail" required>
                </div>
                <div class="senha">
                    <input type="password" name="senha" placeholder="insira sua senha" required>
                </div>
                <div class="entrar">
                    <input type="submit" name="acessar" value="Acessar">
                </div>
                <a href="CadastroSolicitante.php">Cadastrar Solicitante</a>
                </fieldset>
            </form>
 
            
        </div>
    </div>
</body>
</html>