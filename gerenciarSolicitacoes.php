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
            <?php echo $_SESSION['nome_multiplicador']; ?> : Painel de Solicitações
        </h1>

        <?php include "layout/menuMultiplicador.php"; ?>

        <?php
         // Define a tabela e a ordem para a consulta
            $tabela = "solicitacao";
            $order = "id_solicitacao";
            // Busca os usuários no banco de dados
            $usuarios = buscarSolicitacao($connect, $tabela, $where = 1, $order);
            // Insere um novo multiplicador
            inserirMultiplicador($connect);
           // Verifica se um ID de multiplicador foi fornecido via GET
           if (isset($_GET['id_solicitacao']) && $_SESSION['nivel_hierarquia'] == 'administrador'){ ?>
                <h2>Tem certeza que deseja deletar a Solicitação numero 
                <?php echo $_GET['id_solicitacao'];?></h2>
                <form action="" method="post">
                    <input type="hidden" name="id_solicitacao" value="<?php echo $_GET['id_solicitacao']?>">
                    <input type="submit" name="deletarSolicitacao" value="Deletar">
                </form>
            <?php } ?>
            <?php 
                if(isset($_POST['deletarSolicitacao']) && $_SESSION['nivel_hierarquia'] == 'administrador'){
                    if ($_SESSION['id_multiplicador'] != $_POST['id_multiplicador']){
                        deletarSolicitacao($connect, "solicitacao",$_POST['id_solicitacao']);
                    } else{
                        echo "Você não pode deletar seu próprio usuário!";
                    }
                }
            
            ?>
            
        <!-- Tabela de usuários -->
        <div class="container">
            <table border="1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome da Instituição</th>
                        <th>Multiplicador</th>
                        <th>Data de Criação</th>
                        <th>Descrição</th>
                        <th>Status solicitação</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    <?php foreach ($usuarios as $usuario) : ?>
                        <tr>
                            <td  data-tooltip="<?php echo $usuario['id_solicitacao'];?>"></td>
                            <td><?php echo $usuario['nome_instituicao']; ?></td>
                            <td><?php echo $usuario['nome_multiplicador']; ?></td>
                            <td><?php echo date('d/m/y', strtotime($usuario['data_criacao'])); ?></td>
                            <td><?php echo $usuario['descricao']; ?></td>
                            <td><?php echo $usuario['status_solicitacao']; ?></td>
                            <td>
                                <?php if ($_SESSION['nivel_hierarquia'] == 'administrador') : ?>
                                        <a href="gerenciarSolicitacoes.php?id_solicitacao=<?php echo $usuario['id_solicitacao']; ?>&descricao=<?php echo $usuario['descricao']; ?>">Excluir</a>
                    
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    <?php }  ?>

</body>
</html>