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
        <h1>Bem vindo,
            <?php echo $_SESSION['nome_multiplicador']; ?> ao painel do site!
        </h1>

        <?php include "layout/menuMultiplicador.php"; ?>

        <?php
         // Define a tabela e a ordem para a consulta
            $tabela = "usuarios";
            $order = "nome_multiplicador";
            // Busca os usuários no banco de dados
            $usuarios = buscar($connect, $tabela, $where = 1, $order);
            // Insere um novo multiplicador
            inserirMultiplicador($connect);
           // Verifica se um ID de multiplicador foi fornecido via GET
            if (isset($_GET['id_multiplicador'])){ ?>
                <h2>Tem certeza que deseja deletar o Multiplicador 
                <?php echo $_GET['nome_multiplicador'];?></h2>
                <form action="" method="post">
                    <input type="hidden" name="id_multiplicador" value="<?php echo $_GET['id_multiplicador']?>">
                    <input type="submit" name="deletar" value="Deletar">
                </form>
            <?php } ?>
            <?php 
                if(isset($_POST['deletar'])){
                    if ($_SESSION['id_multiplicador'] != $_POST['id_multiplicador']){
                    deletar($connect, "multiplicador",$_POST['id_multiplicador']);
                    } else{
                        echo "Vocee não pode deletar seu próprio usário!";
                    }
                }
            
            ?>
            
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
                        <th>Ações</th>
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
                            <td>
                                <a href="multiplicadores.php?id_multiplicador=<?php echo $usuario['id_multiplicador']; ?>&nome_multiplicador=<?php echo $usuario['nome_multiplicador']; ?>">Excluir</a>
                                |
                                <a href="editarMultiplicador.php?id_multiplicador=<?php echo $usuario['id_multiplicador']; ?>&nome_multiplicador=<?php echo $usuario['nome_multiplicador']; ?>">Atualizar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php }  ?>

         <!-- Formulário para Cadastrar novo Multiplicador -->
         <form id="signup-form" action="" method="post">
            <h2>Cadastro do Multiplicador</h2>
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" id="name" name="nome_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="matricula">Matrícula:</label>
                <input type="text" id="matricula" name="matricula" required>
            </div>
            <div class="form-group">
                <label for="cpf_multiplicador">CPF:</label>
                <input type="text" id="cpf_multiplicador" name="cpf_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="endereco_multiplicador">Endereco:</label>
                <input type="text" id="endereco_multiplicador" name="endereco_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="senha_multiplicador">Senha:</label>
                <input type="password" id="senha_multiplicador" name="senha_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="repete_senha">Repita a Senha:</label>
                <input type="password" id="repete_senha" name="repete_senha" required>
            </div>

            <button type="submit" name="cadastrar" value="Cadastrar">Cadastrar</button>
        </form>

</body>
</html>