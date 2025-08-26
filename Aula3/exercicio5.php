<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 5 - Usuário com Validação</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; background: #f5f5f5; }
        .container { max-width: 800px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 10px; }
        .header { background: #2c3e50; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .demo { background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .justification { background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .btn { display: inline-block; padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin: 5px; }
        .btn:hover { background: #0056b3; }
        .error { color: #dc3545; }
        .success { color: #28a745; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exercício 5: Usuário com Validação</h1>
            <p>Implementação de classe Usuário com validação de dados, hash de senha e métodos de autenticação</p>
        </div>

        <div class="demo">
            <h3>Demonstração:</h3>
            <?php
            require_once 'Usuario.php';

            try {
                // Criar usuário válido
                $usuario1 = new Usuario("joao123", "joao@email.com", "senha123");
                echo "<p><strong>Usuário criado:</strong> " . $usuario1->getNome() . "</p>";
                echo "<p><strong>Email:</strong> " . $usuario1->getEmail() . "</p>";

                // Testar verificação de senha
                if ($usuario1->verificarSenha("senha123")) {
                    echo "<p class='success'>✓ Senha correta verificada!</p>";
                } else {
                    echo "<p class='error'>✗ Senha incorreta!</p>";
                }

                if ($usuario1->verificarSenha("senhaerrada")) {
                    echo "<p class='success'>✓ Senha correta verificada!</p>";
                } else {
                    echo "<p class='error'>✗ Senha incorreta!</p>";
                }

                // Testar validações
                try {
                    $usuario2 = new Usuario("", "emailinvalido", "123");
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro capturado: " . $e->getMessage() . "</p>";
                }

            } catch (Exception $e) {
                echo "<p class='error'>Erro: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <div class="justification">
            <h3>Justificativa das Escolhas de Design:</h3>
            <ul>
                <li><strong>Visibilidade:</strong> Atributos privados para proteger dados sensíveis</li>
                <li><strong>Getters/Setters:</strong> Controle total sobre acesso e modificação</li>
                <li><strong>Validação:</strong> Verificações rigorosas nos setters para manter integridade</li>
                <li><strong>Segurança:</strong> Hash de senha com password_hash() para proteção</li>
                <li><strong>Tratamento de Erros:</strong> Exceções específicas para validações falhadas</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="btn">← Voltar ao Menu</a>
            <a href="ver_codigo.php?arquivo=Usuario.php" class="btn">Ver Código</a>
        </div>
    </div>
</body>
</html>
