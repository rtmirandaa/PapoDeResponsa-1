<?php
$server = "monorail.proxy.rlwy.net";
$userDb = "root";
$passDb = "ZshcFSCqLRLagZEWrMkPzpshPNBIawAn";
$nameDb = "railway";
$port = 37268;

// Conexão com o Banco de Dados
$connect = mysqli_connect($server, $userDb, $passDb, $nameDb, $port);

// Verificar conexão
if (!$connect) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Função para realizar o login
function login($connect)
{
    if (isset($_POST['acessar'])) {
        $check_email = filter_input(INPUT_POST, 'email_multiplicador', FILTER_VALIDATE_EMAIL);
        if ($check_email === false) {
            echo '<label style="color: red; font-size: 2rem;">E-mail inválido!</label>';
            return;
        }
        $email = mysqli_real_escape_string($connect, $check_email);
        $senha = mysqli_real_escape_string($connect, $_POST['senha_multiplicador']);

        if (!empty($email) && !empty($senha)) {
            $query = "SELECT * FROM multiplicador WHERE email_multiplicador = '$email' AND senha_multiplicador = '$senha'";
            $executar = mysqli_query($connect, $query);

            if (!$executar) {
                // Erro ao executar a consulta
                echo '<label style="color: red; font-size: 2rem;">Erro ao executar a consulta: ' . mysqli_error($connect) . '</label>';
                return;
            }

            $verifica = mysqli_num_rows($executar);
            $usuario = mysqli_fetch_assoc($executar);

            if ($verifica > 0) {
                // Inicia uma sessão (login)
                session_start();
                $_SESSION['email_multiplicador'] = $usuario['email_multiplicador'];
                $_SESSION['nome_multiplicador'] = $usuario['nome_multiplicador'];
                $_SESSION['id_multiplicador'] = $usuario['id_multiplicador'];
				$_SESSION['nivel_hierarquia'] = $usuario['nivel_hierarquia']; 
                $_SESSION['ativa'] = true;
                header("location: indexMultiplicador.php"); // Redireciona para a página de administração
                exit;
            } else {
                echo '<label style="color: red; font-size: 2rem;">E-mail ou senha não encontrados!</label>';
            }
        } else {
            echo '<label style="color: red; font-size: 2rem;">E-mail ou senha incorretos!</label>';
        }
    }
}
function loginSolicitante($connect)
{
    if (isset($_POST['acessar'])) {
        $check_email = filter_input(INPUT_POST, 'email_solicitante', FILTER_VALIDATE_EMAIL);
        if ($check_email === false) {
            echo '<label style="color: red; font-size: 2rem;">E-mail inválido!</label>';
            return;
        }
        $email = mysqli_real_escape_string($connect, $check_email);
        ########### verificar ###################################
        $senha = mysqli_real_escape_string($connect, $_POST['senha']);

        if (!empty($email) && !empty($senha)) {
            $query = "SELECT * FROM solicitante WHERE email_solicitante = '$email' AND senha_solicitante = '$senha'";
            $executar = mysqli_query($connect, $query);

            if (!$executar) {
                echo '<label style="color: red; font-size: 2rem;"Erro ao executar a consulta: ' . mysqli_error($connect) . '</label>';
                return;
            }

            $verifica = mysqli_num_rows($executar);
            $usuario = mysqli_fetch_assoc($executar);

            if ($verifica > 0) {
                session_start();
                $_SESSION['email_solicitante'] = $usuario['email_solicitante'];
                $_SESSION['responsavel'] = $usuario['responsavel'];
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['ativa'] = true;
                header("location: solicitante.php"); // Redireciona para a página de administração do solicitante
                exit;
            } else {
                echo '<label style="color: red; font-size: 2rem;">E-mail ou senha não encontrados!</label>';
                }
        } else {
                echo  '<label style="color: red; font-size: 2rem;">E-mail ou senhaaaaa incorretos!</label>';
        }
    }
}




// Função para deslogar
function logout()
{
	session_start();
	session_unset();
	session_destroy();
	header("location: index.php"); // Redireciona para a página inicial
}

// Função para buscar um usuário específico
function buscaUnica($connect, $tabela, $id) {
    // Monta a consulta SQL
    $query = "SELECT * FROM $tabela WHERE id_Multiplicador = " . (int)$id;

    // Executa a consulta
    $execute = mysqli_query($connect, $query);

    // Verifica se a consulta foi bem-sucedida
    if ($execute === false) {
        die("Erro na consulta: " . mysqli_error($connect));
    }

    // Verifica se há resultados
    if (mysqli_num_rows($execute) > 0) {
        // Retorna o resultado como um array associativo
        return mysqli_fetch_assoc($execute);
    } else {
        // Retorna null se não houver resultados
        return null;
    }
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
		$nivel_hierarquia = mysqli_real_escape_string($connect, $_POST['nivel_hierarquia']);


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
			$query = "INSERT INTO multiplicador (nome_multiplicador,email_multiplicador,senha_multiplicador,matricula,cpf_multiplicador,endereco_multiplicador,nivel_hierarquia) 
			values ('$nome','$email','$senha','$matricula','$cpf','$endereco', '$nivel_hierarquia')";

			if (mysqli_query($connect, $query)) {
				// Verifica o nível de hierarquia do usuário logado
				if ($_SESSION['nivel_hierarquia'] == 'administrador') {
					// Administrador
					echo "<script>
							alert('Novo multiplicador cadastrado com sucesso.');
							window.location.href = 'multiplicadores.php'; // Redireciona para o painel do administrador
						</script>";
				} else {
					// Outros multiplicadores
					echo "<script>
							alert('Seu pedido foi enviado para revisão.');
							window.location.href = 'index.php'; // Redireciona para o index
						</script>";
				}
			} else {
				echo "Erro ao cadastrar usuário: " . mysqli_error($connect);
			}

			// $executar = mysqli_query($connect, $query);
			// if ($executar) {
			// 	echo "multiplicador inserido com sucesso";
			// } else {
			// 	echo "Erro ao inserir multiplicador!";
			// }
		} else {
			foreach ($erros as $erro) {
				echo "<p>$erro</p>";
			}
		}
	}
}

function updateMultiplicador($connect)
{
	if (isset($_POST['atualizar']) and !empty($_POST['email_multiplicador'])) {
		$erros = array();
		$id_multiplicador = filter_input(INPUT_POST, "id_multiplicador", FILTER_VALIDATE_INT);
		$email_multiplicador = filter_input(INPUT_POST, 'email_multiplicador', FILTER_VALIDATE_EMAIL);
		$nome = mysqli_real_escape_string($connect, $_POST['nome_multiplicador']);
		$matricula = mysqli_real_escape_string($connect, $_POST['matricula']);
		$cpf= mysqli_real_escape_string($connect, $_POST['cpf_multiplicador']);
		$endereco= mysqli_real_escape_string($connect, $_POST['endereco_multiplicador']);
		$nivel_hierarquia = mysqli_real_escape_string($connect, $_POST['nivel_hierarquia']);
		$status = mysqli_real_escape_string($connect, $_POST['status_multiplicador']);
		$senha = "";

		if (strlen($nome) < 3) {
			$erros[] = "Nome muito curto";
		}

		if (empty($email_multiplicador)) {
			$erros[] = "Preencha seu e-mail corretamente";
		}

		if (!empty($_POST['senha_multiplicador'])) {
			if ($_POST['senha_multiplicador'] == $_POST['repetesenha']) {
				$senha = ($_POST['senha_multiplicador']);
			} else {
				$erros[] = "Senhas não conferem";
			}
		}

		// Verificar se não mudou o email
		$queryEmailAtual = "SELECT email_multiplicador FROM multiplicador where id_multiplicador = $id_multiplicador ";
		$buscaEmailAtual = mysqli_query($connect, $queryEmailAtual);
		$retornoEmail = mysqli_fetch_assoc($buscaEmailAtual);
		$queryEmail = "SELECT email_multiplicador FROM multiplicador WHERE email_multiplicador = '$email_multiplicador' AND  email_multiplicador <> '" . $retornoEmail['email_multiplicador'] . "'";
		$buscaEmail = mysqli_query($connect, $queryEmail);
		$verifica = mysqli_num_rows($buscaEmail); # traz número de linhas
		if (!empty($verifica)) {
			$erros[] = "E-mail já cadastrado!";
		}

		if (empty($erros)) {
			if (!empty($senha)) {
				$query = "UPDATE multiplicador SET 
                            nome_multiplicador='$nome', 
                            email_multiplicador='$email_multiplicador', 
                            matricula='$matricula',
							cpf_multiplicador='$cpf', 
               				endereco_multiplicador='$endereco',
                            senha_multiplicador='$senha', 
                            nivel_hierarquia='$nivel_hierarquia', 
                            status_multiplicador='$status' 
                          WHERE id_multiplicador='$id_multiplicador'";
			} else {
				$query = "UPDATE multiplicador SET 
                            nome_multiplicador='$nome', 
                            email_multiplicador='$email_multiplicador', 
                            matricula='$matricula', 
							cpf_multiplicador='$cpf', 
               				endereco_multiplicador='$endereco', 
                            nivel_hierarquia='$nivel_hierarquia', 
                            status_multiplicador='$status' 
                          WHERE id_multiplicador='$id_multiplicador'";
			}

			$executar = mysqli_query($connect, $query);
			if ($executar) {
			    "Usuário atualizado com sucesso!";
                header("Location: multiplicadores.php");
                exit(); // Certifique-se de que o script pare de ser executado após o redirecionamento
			} else {
				echo "Erro ao atualizar usuário: " . mysqli_error($connect);
			}
		} else {
			foreach ($erros as $erro) {
				echo "<p>$erro</p>";
			}
		}
	}
}



// Função para deletar um usuário
function deletar($connect, $usuario, $id_multiplicador)
{
	if (!empty($id_multiplicador)) {
		$query = "DELETE FROM $usuario WHERE id_multiplicador =" . (int) $id_multiplicador;
		$execute = mysqli_query($connect, $query);
		if ($execute) {
			echo "<script>
							alert('Multiplicador deletado com sucesso.');
							window.location.href = 'multiplicadores.php';
				</script>";
		} else {
			echo "Erro ao deletar!";
		}
	}
}


// Buscar solicitações disponíveis
function buscarSolicitacoesDisponiveis($connect) {
    $query = "SELECT s.*, sl.endereco_solicitante FROM solicitacao s
              INNER JOIN solicitante sl ON s.id_solicitante = sl.id_solicitante
              WHERE s.id_multiplicador IS NULL AND s.status_solicitacao = 'A'";
    $result = mysqli_query($connect, $query);
    $solicitacoes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $solicitacoes;
}

// Buscar solicitações aceitas
function buscarSolicitacoesAceitas($connect, $id_multiplicador) {
    $query = "SELECT s.*, sl.endereco_solicitante FROM solicitacao s
              INNER JOIN solicitante sl ON s.id_solicitante = sl.id_solicitante
              WHERE s.id_multiplicador = $id_multiplicador AND s.status_solicitacao = 'A'";
    $result = mysqli_query($connect, $query);
    $solicitacoes = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $solicitacoes;
}

// Aceitar uma solicitação
function aceitarSolicitacao($connect, $id_solicitacao, $id_multiplicador) {
    $query = "UPDATE solicitacao SET id_multiplicador = $id_multiplicador WHERE id_solicitacao = $id_solicitacao";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: indexMultiplicador.php");
        exit;
    } else {
        echo "Erro ao aceitar solicitação.";
    }
}

// Desistir de uma solicitação
function desistirSolicitacao($connect, $id_solicitacao, $id_multiplicador) {
    $query = "UPDATE solicitacao SET id_multiplicador = NULL WHERE id_solicitacao = $id_solicitacao AND id_multiplicador = $id_multiplicador";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location: indexMultiplicador.php");
        exit;
    } else {
        echo "Erro ao desistir da solicitação.";
    }
}

function buscarEnderecoMultiplicador($connect, $id_multiplicador) {
    $query = "SELECT endereco_multiplicador FROM multiplicador
              WHERE id_multiplicador = $id_multiplicador";
    $result = mysqli_query($connect, $query);
    
    // Verifique se a consulta retornou algum resultado
    if ($result && mysqli_num_rows($result) > 0) {
        // Obtenha a primeira linha do resultado
        $row = mysqli_fetch_assoc($result);
        return $row['endereco_multiplicador'];
    } else {
        // Retorne null ou um valor padrão se nenhum resultado for encontrado
        return null;
    }
}