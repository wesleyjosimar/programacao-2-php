<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 6 - Herança - Config e Subclasses</title>
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
            <h1>Exercício 6: Herança - Config e Subclasses</h1>
            <p>Classe Config com parametros protegidos e subclasses para leitura e modificação</p>
        </div>

        <div class="demo">
            <h3>Demonstração:</h3>
            <?php
            require_once 'Config.php';

            try {
                // Criar instância de Config
                $config = new Config();
                echo "<p><strong>Configuração criada com sucesso!</strong></p>";

                // Testar ConfigLeitura (pode ler, não pode modificar)
                $leitor = new ConfigLeitura();
                echo "<p><strong>ConfigLeitura:</strong></p>";
                echo "<p>Host: " . $leitor->getHost() . "</p>";
                echo "<p>Porta: " . $leitor->getPorta() . "</p>";
                echo "<p>Banco: " . $leitor->getBanco() . "</p>";

                // Testar ConfigModificacao (pode ler e modificar)
                $modificador = new ConfigModificacao();
                echo "<p><strong>ConfigModificacao:</strong></p>";
                echo "<p>Host atual: " . $modificador->getHost() . "</p>";
                
                $modificador->setHost("novo-servidor.com");
                echo "<p>Host modificado: " . $modificador->getHost() . "</p>";

                $modificador->setPorta(5433);
                echo "<p>Porta modificada: " . $modificador->getPorta() . "</p>";

                // Testar polimorfismo
                echo "<p><strong>Teste de Polimorfismo:</strong></p>";
                $configuracoes = [$leitor, $modificador];
                
                foreach ($configuracoes as $config) {
                    echo "<p>Classe: " . get_class($config) . " - Host: " . $config->getHost() . "</p>";
                }

            } catch (Exception $e) {
                echo "<p class='error'>Erro: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <div class="justification">
            <h3>Justificativa das Escolhas de Design:</h3>
            <ul>
                <li><strong>Visibilidade:</strong> Atributos protegidos para permitir acesso às subclasses</li>
                <li><strong>Herança:</strong> Hierarquia clara com Config como classe base</li>
                <li><strong>Polimorfismo:</strong> Diferentes comportamentos baseados no tipo de objeto</li>
                <li><strong>Encapsulamento:</strong> Controle de acesso através de herança</li>
                <li><strong>Separação de Responsabilidades:</strong> Leitura vs. Modificação bem definidas</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="btn">← Voltar ao Menu</a>
            <a href="ver_codigo.php?arquivo=Config.php" class="btn">Ver Código</a>
        </div>
    </div>
</body>
</html>
