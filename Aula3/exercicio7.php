<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 7 - Classe Pedido - Gerenciamento de Array</title>
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
            <h1>Exercício 7: Classe Pedido - Gerenciamento de Array</h1>
            <p>Desenvolver classe Pedido com itens privados e métodos para inserir e listar</p>
        </div>

        <div class="demo">
            <h3>Demonstração:</h3>
            <?php
            require_once 'Pedido.php';

            try {
                // Criar pedido
                $pedido = new Pedido("PED001", "João Silva");
                echo "<p><strong>Pedido criado:</strong> " . $pedido->getNumero() . " - " . $pedido->getCliente() . "</p>";

                // Adicionar itens
                $pedido->adicionarItem("Notebook", 1, 2500.00);
                $pedido->adicionarItem("Mouse", 2, 50.00);
                $pedido->adicionarItem("Teclado", 1, 120.00);

                echo "<p><strong>Itens adicionados com sucesso!</strong></p>";

                // Listar itens
                echo "<h4>Itens do Pedido:</h4>";
                $itens = $pedido->listarItens();
                foreach ($itens as $item) {
                    echo "<p>• " . $item['produto'] . " - Qtd: " . $item['quantidade'] . " - R$ " . number_format($item['preco'], 2, ',', '.') . "</p>";
                }

                // Calcular total
                $total = $pedido->calcularTotal();
                echo "<p><strong>Total do Pedido:</strong> R$ " . number_format($total, 2, ',', '.') . "</p>";

                // Testar validações
                try {
                    $pedido->adicionarItem("", 0, -10.00);
                } catch (InvalidArgumentException $e) {
                    echo "<p class='error'>✗ Erro capturado: " . $e->getMessage() . "</p>";
                }

                // Testar remoção de item
                $pedido->removerItem("Mouse");
                echo "<p><strong>Item 'Mouse' removido!</strong></p>";

                echo "<h4>Itens após remoção:</h4>";
                $itens = $pedido->listarItens();
                foreach ($itens as $item) {
                    echo "<p>• " . $item['produto'] . " - Qtd: " . $item['quantidade'] . " - R$ " . number_format($item['preco'], 2, ',', '.') . "</p>";
                }

                $totalAtualizado = $pedido->calcularTotal();
                echo "<p><strong>Total Atualizado:</strong> R$ " . number_format($totalAtualizado, 2, ',', '.') . "</p>";

            } catch (Exception $e) {
                echo "<p class='error'>Erro: " . $e->getMessage() . "</p>";
            }
            ?>
        </div>

        <div class="justification">
            <h3>Justificativa das Escolhas de Design:</h3>
            <ul>
                <li><strong>Visibilidade:</strong> Array de itens privado para encapsulamento total</li>
                <li><strong>Encapsulamento:</strong> Acesso controlado através de métodos específicos</li>
                <li><strong>Validação:</strong> Verificações rigorosas antes de inserir dados</li>
                <li><strong>Interface Clara:</strong> Métodos bem definidos para cada operação</li>
                <li><strong>Flexibilidade:</strong> Fácil adição e remoção de itens</li>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.html" class="btn">← Voltar ao Menu</a>
            <a href="ver_codigo.php?arquivo=Pedido.php" class="btn">Ver Código</a>
        </div>
    </div>
</body>
</html>
