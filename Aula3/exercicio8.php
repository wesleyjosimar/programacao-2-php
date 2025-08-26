<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 8 - Classe Cliente - Diferentes Níveis de Acesso</title>
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
            <h1>Exercício 8: Classe Cliente - Diferentes Níveis de Acesso</h1>
            <p>Classe Cliente com nome público, CPF protegido e telefone privado. Testar acessos.</p>
        </div>

        <div class="demo">
            <h3>Demonstração:</h3>
            <?php
            require_once 'Cliente.php';

            try {
                // Criar cliente
                $cliente = new Cliente("Maria Silva", "123.456.789-00", "(11) 99999-9999");
                echo "<p><strong>Cliente criado com sucesso!</strong></p>";

                // Testar acesso público (nome)
                echo "<p><strong>Nome (público):</strong> " . $cliente->nome . "</p>";
                
                // Modificar nome (público)
                $cliente->nome = "Maria Santos";
                echo "<p><strong>Nome modificado:</strong> " . $cliente->nome . "</p>";

                // Testar acesso protegido (CPF) - através de getter
                echo "<p><strong>CPF (protegido):</strong> " . $cliente->getCPF() . "</p>";

                // Testar acesso privado (telefone) - através de getter
                echo "<p><strong>Telefone (privado):</strong> " . $cliente->getTelefone() . "</p>";

                // Testar modificação de CPF (protegido)
                $cliente->setCPF("987.654.321-00");
                echo "<p><strong>CPF modificado:</strong> " . $cliente->getCPF() . "</p>";

                // Testar modificação de telefone (privado)
                $cliente->setTelefone("(11) 88888-8888");
                echo "<p><strong>Telefone modificado:</strong> " . $cliente->getTelefone() . "</p>";

                // Testar validações
                try {
                    $cliente->setCPF("CPF-invalido");
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro CPF: " . $e->getMessage() . "</p>";
                }

                try {
                    $cliente->setTelefone("telefone-invalido");
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro telefone: " . $e->getMessage() . "</p>";
                }

                // Testar herança
                echo "<h4>Teste de Herança:</h4>";
                $clienteVip = new ClienteVip("João Vip", "111.222.333-44", "(11) 77777-7777", "VIP");
                echo "<p><strong>Cliente VIP:</strong> " . $clienteVip->nome . " - Categoria: " . $clienteVip->getCategoria() . "</p>";

            } catch (Exception $e) {
                echo "<p class='error'>Erro: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <div class="justification">
            <h3>Justificativa das Escolhas de Design:</h3>
            <ul>
                <li><strong>Visibilidade:</strong> Diferentes níveis (public, protected, private) para controle de acesso</li>
                <li><strong>Herança:</strong> ClienteVip estende Cliente com funcionalidades adicionais</li>
                <li><strong>Encapsulamento:</strong> Dados sensíveis protegidos, interface pública controlada</li>
                <li><strong>Validação:</strong> Verificações específicas para cada tipo de dado</li>
                <li><strong>Flexibilidade:</strong> Fácil extensão através de herança</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="btn">← Voltar ao Menu</a>
            <a href="ver_codigo.php?arquivo=Cliente.php" class="btn">Ver Código</a>
        </div>
    </div>
</body>
</html>
