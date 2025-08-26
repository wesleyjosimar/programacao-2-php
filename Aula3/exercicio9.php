<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 9 - Refatoração - ContaBancaria com Validação</title>
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
            <h1>Exercício 9: Refatoração - ContaBancaria com Validação</h1>
            <p>Refatorar ContaBancaria para permitir saque apenas com saldo suficiente</p>
        </div>

        <div class="demo">
            <h3>Demonstração:</h3>
            <?php
            require_once 'ContaBancariaRefatorada.php';

            try {
                // Criar conta
                $conta = new ContaBancariaRefatorada("12345-6", "João Silva", 1000.00);
                echo "<p><strong>Conta criada com sucesso!</strong></p>";
                echo "<p><strong>Número:</strong> " . $conta->getNumero() . "</p>";
                echo "<p><strong>Titular:</strong> " . $conta->getTitular() . "</p>";
                echo "<p><strong>Saldo inicial:</strong> R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "</p>";

                // Testar depósito
                $conta->depositar(500.00);
                echo "<p class='success'>✓ Depósito de R$ 500,00 realizado!</p>";
                echo "<p><strong>Saldo após depósito:</strong> R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "</p>";

                // Testar saque válido
                $conta->sacar(300.00);
                echo "<p class='success'>✓ Saque de R$ 300,00 realizado!</p>";
                echo "<p><strong>Saldo após saque:</strong> R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "</p>";

                // Testar saque maior que saldo
                try {
                    $conta->sacar(2000.00);
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro capturado: " . $e->getMessage() . "</p>";
                }

                // Testar saque com valor negativo
                try {
                    $conta->sacar(-100.00);
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro capturado: " . $e->getMessage() . "</p>";
                }

                // Testar depósito com valor negativo
                try {
                    $conta->depositar(-50.00);
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro capturado: " . $e->getMessage() . "</p>";
                }

                // Testar saque com valor zero
                try {
                    $conta->sacar(0);
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro capturado: " . $e->getMessage() . "</p>";
                }

                // Testar saque exato do saldo
                $saldoAtual = $conta->getSaldo();
                $conta->sacar($saldoAtual);
                echo "<p class='success'>✓ Saque do saldo total realizado!</p>";
                echo "<p><strong>Saldo final:</strong> R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "</p>";

                // Testar saque com saldo zero
                try {
                    $conta->sacar(100.00);
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
                <li><strong>Refatoração:</strong> Código melhorado com validações rigorosas</li>
                <li><strong>Validação:</strong> Verificações de saldo, valores negativos e zero</li>
                <li><strong>Organização:</strong> Lógica clara e bem estruturada</li>
                <li><strong>Regras de Negócio:</strong> Saque apenas com saldo suficiente</li>
                <li><strong>Tratamento de Erros:</strong> Exceções específicas para cada tipo de erro</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="btn">← Voltar ao Menu</a>
            <a href="ver_codigo.php?arquivo=ContaBancariaRefatorada.php" class="btn">Ver Código</a>
        </div>
    </div>
</body>
</html>
