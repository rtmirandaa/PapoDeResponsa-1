<?php
session_start();
$seguranca = isset($_SESSION['ativa']) ? TRUE : header("location:index.php");

include "functions.php";
require "calculadorGoogleMaps.php";

if (isset($_GET['aceitar'])) {
    $id_solicitacao = $_GET['aceitar'];
    aceitarSolicitacao($connect, $id_solicitacao, $_SESSION['id_multiplicador']);
}

if (isset($_GET['desistir'])) {
    $id_solicitacao = $_GET['desistir'];
    desistirSolicitacao($connect, $id_solicitacao, $_SESSION['id_multiplicador']);
}

// Buscar solicitações disponíveis
$solicitacoes_disponiveis = buscarSolicitacoesDisponiveis($connect);

// Buscar solicitações aceitas
$solicitacoes_aceitas = buscarSolicitacoesAceitas($connect, $_SESSION['id_multiplicador']);
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
            <?php echo $_SESSION['nome_multiplicador']; ?> ao painel do site!
        </h1>
        <?php include "layout/menuMultiplicador.php"; ?>

        <h2>Solicitações Disponíveis</h2>
        <ul>
            <?php
            $endereco_multiplicador = buscarEnderecoMultiplicador($connect, $_SESSION['id_multiplicador']);

            foreach ($solicitacoes_disponiveis as $solicitacao) : ?>
                <li>
                    <?php $distancia = getDistance($addressFrom = $solicitacao['endereco_solicitante'], $addressTo = $endereco_multiplicador, $unit = "k"); ;
                    echo $solicitacao['descricao']; ?> - Solicitante: <?php echo $solicitacao['endereco_solicitante']; ?> - Distância: <?php echo $distancia;?>
                    <a href="?aceitar=<?php echo $solicitacao['id_solicitacao']; ?>">Aceitar</a>
                </li>
                function print_distancia
            <?php endforeach; 
            try {
                // Criar a conexão com o banco de dados usando PDO
                $connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // Configurar o PDO para lançar exceções em caso de erro
                $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
                // Preparar e executar a consulta SQL
                $stmt = $connect->prepare("SELECT id_multiplicador FROM solicitacao");
                $stmt->execute();
            
                // Obter os resultados e armazenar em uma lista
                $idList = $stmt->fetchAll(PDO::FETCH_COLUMN);
            
                // Exibir a lista de IDs (para fins de demonstração)
                print_r($idList);
            
            } catch(PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            function print_distancia ($distancia){
                for ($i = 0; $i < strlen($idList); $i++)
                {
                    $id = $idList[$i];
                    echo $id . " - " . $distancia[$i] . "<br>";
                }
            }
            
            ?>
        </ul>

        <h2>Solicitações Aceitas por Você</h2>
        <ul>
            <?php foreach ($solicitacoes_aceitas as $solicitacao) : ?>
                <li>
                    <?php echo $solicitacao['descricao']; ?> - Endereço: <?php echo $solicitacao['endereco_solicitante']; ?>
                    <a href="?desistir=<?php echo $solicitacao['id_solicitacao']; ?>">Desistir</a>
                </li>
            <?php endforeach; ?>
        </ul>

    <?php }  ?>
</body>
</html>


