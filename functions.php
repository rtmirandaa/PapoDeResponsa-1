<?php
$server = "localhost";
$userDb = "root";
$passDb = "";
$nameDb = "papo_de_responsa";
//conexão com o Banco de Dados
$connect = mysqli_connect($server, $userDb, $passDb, $nameDb);

// Função para realizar o login
function login($connect)
{
	if (isset($_POST['acessar'])) {
		$check_email = filter_input(INPUT_POST, 'email_multiplicador', FILTER_VALIDATE_EMAIL);
		$email = mysqli_real_escape_string($connect, $check_email);
		$senha = mysqli_real_escape_string($connect, $_POST['senha_multiplicador']);

		if (!empty($email) and !empty($senha)) {
			$query = "SELECT * FROM multiplicador WHERE email_multiplicador = '$email' AND senha_multiplicador = '$senha' ";
			$executar = mysqli_query($connect, $query);
			$verifica = mysqli_num_rows($executar);
			$usuario = mysqli_fetch_assoc($executar);
			if ($verifica > 0) {
				// Inicia uma sessão (login)
				session_start();
				$_SESSION['email_multiplicador'] = $usuario['email_multiplicador'];
				$_SESSION['nome_multiplicador'] = $usuario['nome_multiplicador'];
				$_SESSION['id'] = $usuario['id'];
				$_SESSION['ativa'] = true;
				header("location: index.php"); // Redireciona para a página de administração
			} else {
				$mensagem = "E-mail ou senha não encontrados!";
				echo '<label style="color: red; font-size: 2rem;">' . $mensagem . '</label>';
			}
		} else {
			$mensagem = "E-mail ou senha incorretos!";
			echo '<label style="color: red; font-size: 2rem;">' . $mensagem . '</label>';
		}
	}
}

// Função para deslogar
function logout()
{
	session_start();
	session_unset();
	session_destroy();
	header("location: login.php"); // Redireciona para a página inicial
}

// Função para buscar um usuário específico
function buscaUnica($connect, $tabela, $id)
{
	$query = "SELECT * FROM multiplicador where idMultiplicador =" . (int) $id;
	$execute = mysqli_query($connect, $query);
	$result = mysqli_fetch_assoc($execute);
	return $result;
}

// Função para buscar todos os usuários
function buscar($connect, $tabela, $where = 1, $order = "")
{
	if (!empty($order)) {
		$order = "ORDER BY $order";
	}
	$query = "SELECT * FROM multiplicador where $where $order";
	$execute = mysqli_query($connect, $query);
	$results = mysqli_fetch_all($execute, MYSQLI_ASSOC);
	return $results;
}

function inserirMultiplicador($connect)
{
	if (isset($_POST['cadastrar']) and !empty($_POST['email_multiplicador']) and !empty($_POST['senha_multiplicador'])) {
		$erros = array();
		$email = filter_input(INPUT_POST, 'email_multiplicador', FILTER_VALIDATE_EMAIL);
		$nome = mysqli_real_escape_string($connect, $_POST['nome_multiplicador']);
		$matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
		$cpf = mysqli_real_escape_string($connect, $_POST['cpf_multiplicador']);
		$endereco = mysqli_real_escape_string($connect, $_POST['endereco_multiplicador']);
		$senha = ($_POST['senha_multiplicador']);

		if ($_POST['senha_multiplicador'] != $_POST['repete_senha']) {
			$erros[] = "Senhas não conferem";
		}
		$queryEmail = "SELECT email_multiplicador FROM multiplicador WHERE email_multiplicador = '$email' ";
		$buscaEmail = mysqli_query($connect, $queryEmail);
		$verifica = mysqli_num_rows($buscaEmail); # traz número de linhas
		if (!empty($verifica)) {
			$erros[] = "E-mail já cadastrado!";
		}

		$queryMatricula = "SELECT matricula FROM multiplicador WHERE matricula = '$matricula' ";
		$buscaMatricula = mysqli_query($connect, $queryMatricula);
		$verificaMatricula = mysqli_num_rows($buscaMatricula);
		if ($verificaMatricula > 0) {
			$erros[] = "Matrícula já cadastrada!";
		}

		$queryCpf = "SELECT cpf_multiplicador FROM multiplicador WHERE cpf_multiplicador = '$cpf' ";
		$buscaCpf = mysqli_query($connect, $queryCpf);
		$verificaCpf = mysqli_num_rows($buscaCpf);
		if ($verificaCpf > 0) {
			$erros[] = "CPF já cadastrado!";
		}

		if (empty($erros)) {
			$query = "INSERT INTO multiplicador (nome_multiplicador,email_multiplicador,senha_multiplicador,matricula,cpf_multiplicador,endereco_multiplicador) values ('$nome','$email','$senha','$matricula','$cpf','$endereco')";
			$executar = mysqli_query($connect, $query);
			if ($executar) {
				echo "multiplicador inserido com sucesso";
			} else {
				echo "Erro ao inserir multiplicador!";
			}
		} else {
			foreach ($erros as $erro) {
				echo "<p>$erro</p>";
			}
		}
	}
}