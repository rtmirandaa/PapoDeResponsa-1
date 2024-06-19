<?php
// Inicia a sessão para lidar com a autenticação
session_start();

// Verifica se a sessão está ativa; se não estiver, redireciona para a página de login
//$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location: login.php");

// Inclui o arquivo de funções
require_once "functions.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Página admin-Multiplicadores</title>
</head>
<body>
    <?php if (isset($_SESSION['ativa'])) { ?>
        <!-- Se a sessão estiver ativa, exibe o conteúdo -->
        <h1>Gerenciar Multiplicadores</h1>
        <!-- Inclui o menu -->
        <?php include "layout/menuMultiplicador.php"; ?>
        <?php
        // Busca usuários no banco de dados
        $tabela = "multiplicador";
        $usuarios = buscar($connect, $tabela, $where = 1, $order = "");
        ?>
        <?php if (isset($_GET['id_multiplicador'])) {
            // Se um ID de usuário é fornecido, busca o usuário específico
            $id = $_GET['id_multiplicador'];
            $usuario = buscaUnica($connect, $tabela, $id);
            updateMultiplicador($connect);
            ?>
            <!-- Título para indicar que está editando um usuário específico -->
            <h2>Editando o usuário <?php echo $_GET['nome_multiplicador']; ?> </h2>
        <?php } ?>

        <!-- Formulário para editar um usuário existente ou adicionar um novo usuário -->
        <form action="" method="post">
            <fieldset>
                <legend>Editar Usuário</legend>
                <input value="<?php echo $usuario['id_multiplicador']; ?>" type="hidden" name="id_multiplicador">
                <input value="<?php echo $usuario['nome_multiplicador']; ?>" type="text" name="nome_multiplicador" placeholder="nome">
                <input value="<?php echo $usuario['email_multiplicador']; ?>" type="email" name="email_multiplicador" placeholder="email">
                <input value="<?php echo $usuario['matricula']; ?>" type="text" name="matricula" placeholder="matricula">
                <input type="password" name="senha_multiplicador" placeholder="senha">
                <input type="password" name="repetesenha" placeholder="Confirme sua senha">
                <!-- Campo para nível hierárquico -->
                <select id="nivel_hierarquia" name="nivel_hierarquia">
                    <option value="padrao" <?php echo ($usuario['nivel_hierarquia'] == 'padrao') ? 'selected' : ''; ?>>Padrão</option>
                    <option value="administrador" <?php echo ($usuario['nivel_hierarquia'] == 'administrador') ? 'selected' : ''; ?>>Administrador</option>
                    <option value="trainee" <?php echo ($usuario['nivel_hierarquia'] == 'trainee') ? 'selected' : ''; ?>>Trainee</option>
                </select>
                        <!-- Campo para status -->
                <select id="status_multiplicador" name="status_multiplicador">
                    <option value="A" <?php echo ($usuario['status_multiplicador'] == 'A') ? 'selected' : ''; ?>>Ativo</option>
                    <option value="I" <?php echo ($usuario['status_multiplicador'] == 'I') ? 'selected' : ''; ?>>Inativo</option>
                </select>

                <input type="submit" name="atualizar" value="Atualizar">
            </fieldset>
        </form>

        <a href="sair.php">Sair</a>

    <?php } else {
        // Se a sessão não estiver ativa, exibe uma mensagem de acesso negado
        echo "Você não tem acesso a esta página!";
    } ?>
</body>

</html>
