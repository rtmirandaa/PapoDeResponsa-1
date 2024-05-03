<?php session_start(); 
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:login.php");
require_once "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel admin - multiplicadores</title>
</head>
<body>
    <?php if ($seguranca) { ?>

        <h1>Bem vindo,
            <?php echo $_SESSION['nome_multiplicador']; ?> ao painel do site!
        </h1>

        <?php include "layout/menu.php"; ?>

        <?php
            $tabela = "usuarios";
            $order = "nome_multiplicador";
            $usuarios = buscar($connect, $tabela, $where = 1, $order);
            inserirMultiplicador($connect);
        ?>

          <!-- Formulário para Cadastrar novo Multiplicador -->
        <form action="" method="post">
            <fieldset>
                <legend>Cadastrar Multiplicador</legend>
                <input type="text" name="nome_multiplicador" placeholder="nome">
                <input type="email" name="email_multiplicador" placeholder="email">
                <input type="text" name="matricula" placeholder="Matricula">
                <input type="text" name="cpf_multiplicador" placeholder="CPF">
                <input type="text" name="endereco_multiplicador" placeholder="Endereço">
                <input type="password" name="senha_multiplicador" placeholder="senha">
                <input type="password" name="repete_senha" placeholder="Confirme sua senha">
                <input type="submit" name="cadastrar" value="Cadastrar">
            </fieldset>
        </form>

        <!-- Tabela de usuários -->
        <div class="container">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Matricula</th>
                        <th>CPF</th>
                        <th>Endereço</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td><?php echo $usuario['id_multiplicador']; ?></td>
                            <td><?php echo $usuario['nome_multiplicador']; ?></td>
                            <td><?php echo $usuario['email_multiplicador']; ?></td>
                            <td><?php echo $usuario['matricula']; ?></td>
                            <td><?php echo $usuario['cpf_multiplicador']; ?></td>
                            <td><?php echo $usuario['endereco_multiplicador']; ?></td>
                            <td><?php echo $usuario['status_multiplicador']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php }  ?>
</body>
</html>