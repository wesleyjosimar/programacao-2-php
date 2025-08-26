<?php
require_once 'ContaBancaria.php';

/**
 * Exercício 3: Classe ContaBancaria
 * Demonstração de encapsulamento com operações bancárias
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 3 - ContaBancaria</title>
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
            max-width: 1000px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #6f42c1 0%, #5a2d91 100%);
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
        .success {
            background: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .extrato {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 15px 0;
            font-family: 'Courier New', monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exercício 3 - ContaBancaria</h1>
            <p>Encapsulamento com Operações Bancárias</p>
        </div>
        
        <div class="content">
            <div class="explanation">
                <h4>Conceito Aplicado: Encapsulamento em Operações Bancárias</h4>
                <p>A classe ContaBancaria demonstra como o encapsulamento protege dados sensíveis como saldo e histórico, permitindo apenas operações controladas através de métodos públicos como depositar() e sacar().</p>
            </div>

            <div class="result">
                <h3>Resultado da Execução:</h3>
                <?php
                try {
                    // Criando contas bancárias
                    $contaJoao = new ContaBancaria("001", "João Silva", "Corrente", 1000.00);
                    $contaMaria = new ContaBancaria("002", "Maria Santos", "Poupança", 500.00);
                    
                    echo "<div class='success'>";
                    echo "<p><strong>Conta 1:</strong> " . $contaJoao->exibirInfo() . "</p>";
                    echo "<p><strong>Conta 2:</strong> " . $contaMaria->exibirInfo() . "</p>";
                    echo "</div>";
                    
                    echo "<hr>";
                    
                    // Demonstração de depósitos
                    echo "<h4>💰 Operações de Depósito:</h4>";
                    if ($contaJoao->depositar(500.00)) {
                        echo "<div class='success'>";
                        echo "<p>Depósito de R$ 500,00 realizado na conta de João</p>";
                        echo "<p>Novo saldo: <strong>R$ " . number_format($contaJoao->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    if ($contaMaria->depositar(200.00)) {
                        echo "<div class='success'>";
                        echo "<p>Depósito de R$ 200,00 realizado na conta de Maria</p>";
                        echo "<p>Novo saldo: <strong>R$ " . number_format($contaMaria->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Demonstração de saques
                    echo "<h4>💸 Operações de Saque:</h4>";
                    if ($contaJoao->sacar(300.00)) {
                        echo "<div class='success'>";
                        echo "<p>Saque de R$ 300,00 realizado na conta de João</p>";
                        echo "<p>Novo saldo: <strong>R$ " . number_format($contaJoao->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    // Tentativa de saque maior que o saldo
                    if (!$contaJoao->sacar(2000.00)) {
                        echo "<div class='warning'>";
                        echo "<p>❌ Saque de R$ 2.000,00 negado - Saldo insuficiente</p>";
                        echo "<p>Saldo atual: <strong>R$ " . number_format($contaJoao->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Demonstração de transferência
                    echo "<h4>🔄 Operação de Transferência:</h4>";
                    if ($contaJoao->transferir($contaMaria, 150.00)) {
                        echo "<div class='success'>";
                        echo "<p>Transferência de R$ 150,00 de João para Maria realizada com sucesso</p>";
                        echo "<p>Saldo de João: <strong>R$ " . number_format($contaJoao->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "<p>Saldo de Maria: <strong>R$ " . number_format($contaMaria->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Demonstração de aplicação de juros
                    echo "<h4>📈 Aplicação de Juros:</h4>";
                    if ($contaMaria->aplicarJuros(2.5)) {
                        echo "<div class='success'>";
                        echo "<p>Juros de 2,5% aplicados na conta poupança de Maria</p>";
                        echo "<p>Novo saldo: <strong>R$ " . number_format($contaMaria->getSaldo(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Exibindo extratos
                    echo "<h4>Extratos das Contas:</h4>";
                    echo "<div class='extrato'>";
                    echo $contaJoao->exibirExtrato();
                    echo "</div>";
                    
                    echo "<div class='extrato'>";
                    echo $contaMaria->exibirExtrato();
                    echo "</div>";
                    
                } catch (Exception $e) {
                    echo "<div class='warning'>";
                    echo "<p><strong>Erro:</strong> " . $e->getMessage() . "</p>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="code">
                <h4>💻 Código da Classe ContaBancaria:</h4>
                <pre><code>class ContaBancaria {
    private $saldo;           // Saldo privado
    private $historico;       // Histórico privado
    
    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            $this->adicionarTransacao("Depósito", $valor, "Entrada");
            return true;
        }
        return false;
    }
    
    public function sacar($valor) {
        if ($valor > 0 && $valor <= $this->saldo) {
            $this->saldo -= $valor;
            $this->adicionarTransacao("Saque", $valor, "Saída");
            return true;
        }
        return false;
    }
    
    public function getSaldo() {
        return $this->saldo;
    }
}</code></pre>
            </div>

            <div class="explanation">
                <h4>Motivo da Implementação:</h4>
                <p><strong>Atributos Privados:</strong> Saldo e histórico são privados para proteger a integridade dos dados bancários, impedindo manipulação direta.</p>
                <p><strong>Métodos de Operação:</strong> depositar() e sacar() encapsulam a lógica de negócio, garantindo que apenas operações válidas sejam realizadas.</p>
                <p><strong>Validações:</strong> Implementadas para prevenir saques maiores que o saldo e depósitos negativos.</p>
                <p><strong>Histórico de Transações:</strong> Mantém registro de todas as operações para auditoria e controle.</p>
                <p><strong>Transferências:</strong> Demonstra como objetos podem interagir de forma segura através de métodos públicos.</p>
            </div>

            <a href="index.html" class="btn">← Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>
