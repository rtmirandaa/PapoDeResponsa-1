<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <link rel="stylesheet" href="style.css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }
        main {
            padding: 20px;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #f4f4f4;
            padding: 20px;
            border-radius: 5px;
        }
        h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #333;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #555;
        }
    </style> -->
</head>
<body>
    <header>
        <h1>Papo de Responsa</h1>
    </header>
    
    <main>
        <form id="signup-form">
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
                <label for="registration">Matrícula:</label>
                <input type="text" id="registration" name="matricula" required>
            </div>
            <div class="form-group">
                <label for="registration">CPF:</label>
                <input type="text" id="registration" name="cpf_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="registration">Endereco:</label>
                <input type="text" id="registration" name="endereco_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="registration">Senha:</label>
                <input type="text" id="registration" name="senha_multiplicador" required>
            </div>
            <div class="form-group">
                <label for="registration">Repete Senha:</label>
                <input type="text" id="registration" name="repete_senha" required>
            </div>


                      <!-- Formulário para Cadastrar novo Multiplicador -->
        <!-- <form action="" method="post">
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
        </form> -->
            <button type="submit" name="cadastrar" value="Cadastrar">Cadastrar</button>
        </form>
        <a href="logout.php">Sair</a>
    </main>

    <footer>
    
    </footer>
</body>
</html>
