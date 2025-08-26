<?php
require_once 'Produto.php';

/**
 * Exercício 1: Classe Produto com atributos públicos
 * Demonstração de instanciação e acesso direto aos atributos
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 1 - Classe Produto</title>
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
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exercício 1 - Classe Produto</h1>
            <p>Atributos Públicos e Instanciação de Objetos</p>
        </div>
        
        <div class="content">
            <div class="explanation">
                <h4>Conceito Aplicado: Atributos Públicos</h4>
                <p>Atributos públicos permitem acesso direto de fora da classe, facilitando a manipulação dos dados, mas podem comprometer o encapsulamento. Este exercício demonstra como criar e acessar atributos públicos.</p>
            </div>

            <div class="result">
                <h3>Resultado da Execução:</h3>
                <?php
                // Instanciando objetos da classe Produto
                $produto1 = new Produto("Notebook Dell", 3500.00);
                $produto2 = new Produto("Mouse Gamer", 89.90);
                $produto3 = new Produto("Teclado Mecânico", 299.99);
                
                echo "<p><strong>Produto 1:</strong> " . $produto1->exibirInfo() . "</p>";
                echo "<p><strong>Produto 2:</strong> " . $produto2->exibirInfo() . "</p>";
                echo "<p><strong>Produto 3:</strong> " . $produto3->exibirInfo() . "</p>";
                
                echo "<hr>";
                
                // Demonstração de acesso direto aos atributos públicos
                                    echo "<h4>Acesso Direto aos Atributos Públicos:</h4>";
                echo "<p>Nome do Produto 1: <strong>" . $produto1->nome . "</strong></p>";
                echo "<p>Preço do Produto 1: <strong>R$ " . number_format($produto1->preco, 2, ',', '.') . "</strong></p>";
                
                // Modificando atributos diretamente
                $produto1->preco = 3200.00;
                echo "<p>Preço modificado do Produto 1: <strong>R$ " . number_format($produto1->preco, 2, ',', '.') . "</strong></p>";
                
                echo "<hr>";
                
                // Demonstração de métodos
                echo "<h4>🧮 Cálculo de Desconto:</h4>";
                echo "<p>Produto 2 com 15% de desconto: <strong>R$ " . number_format($produto2->calcularDesconto(15), 2, ',', '.') . "</strong></p>";
                echo "<p>Produto 3 com 20% de desconto: <strong>R$ " . number_format($produto3->calcularDesconto(20), 2, ',', '.') . "</strong></p>";
                ?>
            </div>

            <div class="code">
                <h4>💻 Código da Classe:</h4>
                <pre><code>class Produto {
    // Atributos públicos - podem ser acessados diretamente
    public $nome;
    public $preco;
    
    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }
    
    public function exibirInfo() {
        return "Produto: {$this->nome} - Preço: R$ " . number_format($this->preco, 2, ',', '.');
    }
}</code></pre>
            </div>

            <div class="explanation">
                <h4>Motivo da Implementação:</h4>
                <p><strong>Atributos Públicos:</strong> Foram implementados para demonstrar o conceito básico de POO onde os dados podem ser acessados e modificados diretamente. Isso facilita o aprendizado inicial, mas mostra a necessidade do encapsulamento nos próximos exercícios.</p>
                <p><strong>Construtor:</strong> Permite inicializar objetos com valores específicos, demonstrando a reutilização de código.</p>
                <p><strong>Métodos:</strong> Mostram como encapsular comportamentos mesmo com atributos públicos.</p>
            </div>

            <a href="index.html" class="btn">← Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>
