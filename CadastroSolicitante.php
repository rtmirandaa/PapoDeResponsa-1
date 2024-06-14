<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Cadastro</title>
    <link rel="stylesheet" href="style.css">
   
</head>
<body>
    <header>
        <h1>Papo de Responsa</h1>
    </header>
    <main>
        <form id="signup-form">
            <h2>Cadastro do Solicitante</h2>
            <div class="form-group">
                <label for="institution-name">Nome da Instituição:</label>
                <input type="text" id="institution-name" name="institution-name" required>
            </div>
            <div class="form-group">
                <label for="institution-name">Responsavel:</label>
                <input type="text" id="institution-name" name="institution-name" required>
            </div>
            <div class="form-group">
                <label for="institution-cnpj">CNPJ da Instituição:</label>
                <input type="text" id="institution-cnpj" name="institution-cnpj" required>
            </div>
            <div class="form-group">
                <label for="institution-type">A instituição é:</label>
                <select id="institution-type" name="institution-type" required>
                    <option value="public">Pública</option>
                    <option value="private">Privada</option>
                </select>
            </div>
            <div class="form-group">
                <label for="institution-sphere">Esfera:</label>
                <select id="institution-sphere" name="institution-sphere" required>
                    <option value="federal">Federal</option>
                    <option value="state">Estadual</option>
                    <option value="municipal">Municipal</option>
                </select>
            </div>
            <div class="form-group">
                <label for="address">Endereço:</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirmar Senha:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>

            
            <button type="submit">Cadastrar</button>
        </form>
        <a href="logout.php">Sair</a>
    </main>

    <footer>
    
    </footer>
</body>
</html>

