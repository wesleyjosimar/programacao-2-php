<?php
require_once 'ProdutoEncapsulado.php';

/**
 * Exercício 2: Classe Produto com Encapsulamento
 * Demonstração de atributos privados e métodos get/set
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 2 - Encapsulamento</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }
        .container {
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .result {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
        }
        .code {
            background: #2d3748;
            color: #e2e8f0;
            padding: 15px;
            border-radius: 8px;
            font-family: 'Courier New', monospace;
            margin: 15px 0;
            overflow-x: auto;
        }
        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
        }
        .explanation {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin: 15px 0;
        }
        .explanation h4 {
            color: #1976d2;
            margin-top: 0;
        }
        .error {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            color: #721c24;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔒 Exercício 2 - Encapsulamento</h1>
            <p>Atributos Privados e Métodos Get/Set</p>
        </div>
        
        <div class="content">
            <div class="explanation">
                <h4>📚 Conceito Aplicado: Encapsulamento</h4>
                <p>O encapsulamento protege os dados da classe através de modificadores de acesso. Atributos privados só podem ser acessados através de métodos públicos (getters/setters), permitindo validação e controle de acesso.</p>
            </div>

            <div class="result">
                <h3>🔍 Resultado da Execução:</h3>
                <?php
                try {
                    // Instanciando objetos da classe ProdutoEncapsulado
                    $produto1 = new ProdutoEncapsulado("Smartphone Samsung", 1299.99);
                    $produto2 = new ProdutoEncapsulado("Fone de Ouvido", 199.90);
                    
                    echo "<div class='success'>";
                    echo "<p><strong>Produto 1:</strong> " . $produto1->exibirInfo() . "</p>";
                    echo "<p><strong>Produto 2:</strong> " . $produto2->exibirInfo() . "</p>";
                    echo "</div>";
                    
                    echo "<hr>";
                    
                    // Demonstração de acesso através de getters
                    echo "<h4>🎯 Acesso através de Getters:</h4>";
                    echo "<p>Nome do Produto 1: <strong>" . $produto1->nome . "</strong> (público)</p>";
                    echo "<p>Preço do Produto 1: <strong>R$ " . number_format($produto1->getPreco(), 2, ',', '.') . "</strong> (via getter)</p>";
                    
                    echo "<hr>";
                    
                    // Demonstração de modificação através de setters
                    echo "<h4>✏️ Modificação através de Setters:</h4>";
                    if ($produto1->setPreco(1199.99)) {
                        echo "<div class='success'>";
                        echo "<p>Preço do Produto 1 alterado para: <strong>R$ " . number_format($produto1->getPreco(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Demonstração de validação
                    echo "<h4>⚠️ Teste de Validação:</h4>";
                    try {
                        $produto1->setPreco(-100); // Tentativa de definir preço negativo
                    } catch (InvalidArgumentException $e) {
                        echo "<div class='error'>";
                        echo "<p><strong>Erro capturado:</strong> " . $e->getMessage() . "</p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Demonstração de métodos de desconto
                    echo "<h4>🧮 Aplicação de Descontos:</h4>";
                    if ($produto2->aplicarDesconto(15)) {
                        echo "<div class='success'>";
                        echo "<p>Desconto de 15% aplicado ao Produto 2: <strong>R$ " . number_format($produto2->getPreco(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    // Demonstração de aumento de preço
                    if ($produto1->aumentarPreco(10)) {
                        echo "<div class='success'>";
                        echo "<p>Aumento de 10% aplicado ao Produto 1: <strong>R$ " . number_format($produto1->getPreco(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                } catch (Exception $e) {
                    echo "<div class='error'>";
                    echo "<p><strong>Erro:</strong> " . $e->getMessage() . "</p>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="code">
                <h4>💻 Código da Classe Encapsulada:</h4>
                <pre><code>class ProdutoEncapsulado {
    public $nome;           // Público
    private $preco;         // Privado
    
    public function getPreco() {
        return $this->preco;
    }
    
    public function setPreco($preco) {
        if ($preco >= 0) {
            $this->preco = $preco;
            return true;
        } else {
            throw new InvalidArgumentException("Preço deve ser positivo!");
        }
    }
}</code></pre>
            </div>

            <div class="explanation">
                <h4>🎯 Motivo da Implementação:</h4>
                <p><strong>Atributo Privado:</strong> O preço foi tornado privado para proteger a integridade dos dados, impedindo que valores inválidos sejam atribuídos diretamente.</p>
                <p><strong>Métodos Get/Set:</strong> Permitem acesso controlado aos dados, incluindo validação no setter para garantir que apenas valores válidos sejam aceitos.</p>
                <p><strong>Validação:</strong> Implementada para demonstrar como o encapsulamento pode prevenir erros e manter a consistência dos dados.</p>
                <p><strong>Tratamento de Exceções:</strong> Mostra como lidar com erros de validação de forma elegante.</p>
            </div>

            <a href="index.html" class="btn">← Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>
