<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 10 - Classe ConexaoBD - Encapsulamento de Conexão</title>
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
            <h1>Exercício 10: Classe ConexaoBD - Encapsulamento de Conexão</h1>
            <p>Projetar classe ConexaoBD com método privado conectar() e público getConexao()</p>
        </div>

        <div class="demo">
            <h3>Demonstração:</h3>
            <?php
            require_once 'ConexaoBD.php';

            try {
                // Criar instância de ConexaoBD
                $conexaoBD = new ConexaoBD();
                echo "<p><strong>Classe ConexaoBD instanciada com sucesso!</strong></p>";

                // Testar configurações padrão
                echo "<p><strong>Host padrão:</strong> " . $conexaoBD->getHost() . "</p>";
                echo "<p><strong>Porta padrão:</strong> " . $conexaoBD->getPorta() . "</p>";
                echo "<p><strong>Banco padrão:</strong> " . $conexaoBD->getBanco() . "</p>";

                // Modificar configurações
                $conexaoBD->setHost("servidor-producao.com");
                $conexaoBD->setPorta(5433);
                $conexaoBD->setBanco("banco_producao");

                echo "<p><strong>Configurações modificadas:</strong></p>";
                echo "<p>Host: " . $conexaoBD->getHost() . "</p>";
                echo "<p>Porta: " . $conexaoBD->getPorta() . "</p>";
                echo "<p>Banco: " . $conexaoBD->getBanco() . "</p>";

                // Testar método público getConexao()
                echo "<p><strong>Testando método getConexao():</strong></p>";
                
                try {
                    $conexao = $conexaoBD->getConexao();
                    echo "<p class='success'>✓ Método getConexao() executado com sucesso!</p>";
                    echo "<p><strong>Tipo de retorno:</strong> " . gettype($conexao) . "</p>";
                    
                    if (is_string($conexao)) {
                        echo "<p><strong>String de conexão:</strong> " . $conexao . "</p>";
                    }
                } catch (Exception $e) {
                    echo "<p class='error'>✗ Erro ao obter conexão: " . $e->getMessage() . "</p>";
                }

                // Testar validações
                try {
                    $conexaoBD->setHost("");
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro host vazio: " . $e->getMessage() . "</p>";
                }

                try {
                    $conexaoBD->setPorta(-1);
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro porta inválida: " . $e->getMessage() . "</p>";
                }

                try {
                    $conexaoBD->setBanco("");
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro banco vazio: " . $e->getMessage() . "</p>";
                }

                // Testar método privado (não deve ser acessível)
                echo "<p><strong>Testando encapsulamento:</strong></p>";
                echo "<p>O método conectar() é privado e não pode ser chamado externamente.</p>";
                echo "<p>Isso demonstra o encapsulamento avançado da classe.</p>";

            } catch (Exception $e) {
                echo "<p class='error'>Erro: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <div class="justification">
            <h3>Justificativa das Escolhas de Design:</h3>
            <ul>
                <li><strong>Visibilidade:</strong> Método conectar() privado para encapsulamento total</li>
                <li><strong>Encapsulamento Avançado:</strong> Implementação interna oculta da interface</li>
                <li><strong>Interface Pública Limpa:</strong> Apenas métodos necessários expostos</li>
                <li><strong>Separação de Responsabilidades:</strong> Configuração vs. Conexão bem definidas</li>
                <li><strong>Validação:</strong> Verificações rigorosas para configurações válidas</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="btn">← Voltar ao Menu</a>
            <a href="ver_codigo.php?arquivo=ConexaoBD.php" class="btn">Ver Código</a>
        </div>
    </div>
</body>
</html>
