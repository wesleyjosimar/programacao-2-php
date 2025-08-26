<?php
require_once 'Funcionario.php';

/**
 * Exercício 4: Herança - Funcionario e Gerente
 * Demonstração de herança com atributo protegido
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercício 4 - Herança</title>
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
            background: linear-gradient(135deg, #fd7e14 0%, #e55a00 100%);
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
        .info {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
        .comparison {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 8px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Exercício 4 - Herança</h1>
            <p>Funcionario e Gerente com Atributo Protegido</p>
        </div>
        
        <div class="content">
            <div class="explanation">
                <h4>Conceito Aplicado: Herança e Atributos Protegidos</h4>
                <p>A herança permite que uma classe (Gerente) herde características de outra (Funcionario). Atributos protegidos são acessíveis tanto na classe pai quanto nas subclasses, permitindo reutilização de código e extensão de funcionalidades.</p>
            </div>

            <div class="result">
                <h3>Resultado da Execução:</h3>
                <?php
                try {
                    // Criando funcionários e gerentes
                    $funcionario1 = new Funcionario("Carlos Silva", 2500.00, "Desenvolvedor", "F001");
                    $funcionario2 = new Funcionario("Ana Costa", 2200.00, "Designer", "F002");
                    $gerente1 = new Gerente("Roberto Santos", 5000.00, "TI", "G001");
                    $gerente2 = new Gerente("Fernanda Lima", 4800.00, "Marketing", "G002");
                    
                    echo "<div class='success'>";
                    echo "<h4>👷 Funcionários Criados:</h4>";
                    echo "<p><strong>Funcionário 1:</strong> " . $funcionario1->exibirInfo() . "</p>";
                    echo "<p><strong>Funcionário 2:</strong> " . $funcionario2->exibirInfo() . "</p>";
                    echo "</div>";
                    
                    echo "<div class='info'>";
                    echo "<h4>👔 Gerentes Criados:</h4>";
                    echo "<p><strong>Gerente 1:</strong> " . $gerente1->exibirInfo() . "</p>";
                    echo "<p><strong>Gerente 2:</strong> " . $gerente2->exibirInfo() . "</p>";
                    echo "</div>";
                    
                    echo "<hr>";
                    
                    // Demonstração de acesso a atributos protegidos
                    echo "<h4>🔓 Acesso a Atributos Protegidos:</h4>";
                    echo "<div class='comparison'>";
                    echo "<p><strong>Nome do Funcionário 1:</strong> " . $funcionario1->getNome() . " (via getter público)</p>";
                    echo "<p><strong>Nome do Gerente 1:</strong> " . $gerente1->getNome() . " (via herança do getter)</p>";
                    echo "<p><strong>Salário do Funcionário 1:</strong> R$ " . number_format($funcionario1->getSalario(), 2, ',', '.') . " (via getter público)</p>";
                    echo "<p><strong>Salário do Gerente 1:</strong> R$ " . number_format($gerente1->getSalario(), 2, ',', '.') . " (via herança do getter)</p>";
                    echo "</div>";
                    
                    echo "<hr>";
                    
                    // Demonstração de métodos específicos do gerente
                    echo "<h4>Métodos Específicos do Gerente:</h4>";
                    echo "<div class='success'>";
                    echo "<p><strong>Departamento do Gerente 1:</strong> " . $gerente1->getDepartamento() . "</p>";
                    echo "<p><strong>Bônus de Gerência:</strong> R$ " . number_format($gerente1->getBonusGerencia(), 2, ',', '.') . "</p>";
                    echo "<p><strong>Funcionário 1 trabalhando:</strong> " . $funcionario1->trabalhar() . "</p>";
                    echo "<p><strong>Gerente 1 trabalhando:</strong> " . $gerente1->trabalhar() . "</p>";
                    echo "<p><strong>Gerente 1 gerenciando equipe:</strong> " . $gerente1->gerenciarEquipe(8) . "</p>";
                    echo "</div>";
                    
                    echo "<hr>";
                    
                    // Demonstração de sobrescrita de métodos
                    echo "<h4>🔄 Sobrescrita de Métodos:</h4>";
                    echo "<div class='info'>";
                    echo "<p><strong>Salário Líquido Funcionário 1:</strong> R$ " . number_format($funcionario1->calcularSalarioLiquido(), 2, ',', '.') . " (desconto 10%)</p>";
                    echo "<p><strong>Salário Líquido Gerente 1:</strong> R$ " . number_format($gerente1->calcularSalarioLiquido(), 2, ',', '.') . " (com bônus, desconto 12%)</p>";
                    echo "</div>";
                    
                    echo "<hr>";
                    
                    // Demonstração de modificação de salário
                    echo "<h4>💰 Modificação de Salários:</h4>";
                    if ($gerente1->aumentarSalario(15)) {
                        echo "<div class='success'>";
                        echo "<p>Aumento de 15% aplicado ao Gerente 1</p>";
                        echo "<p>Novo salário: <strong>R$ " . number_format($gerente1->getSalario(), 2, ',', '.') . "</strong></p>";
                        echo "<p>Novo bônus: <strong>R$ " . number_format($gerente1->getBonusGerencia(), 2, ',', '.') . "</strong></p>";
                        echo "<p>Novo salário líquido: <strong>R$ " . number_format($gerente1->calcularSalarioLiquido(), 2, ',', '.') . "</strong></p>";
                        echo "</div>";
                    }
                    
                    echo "<hr>";
                    
                    // Demonstração de polimorfismo
                    echo "<h4>🎭 Demonstração de Polimorfismo:</h4>";
                    echo "<div class='comparison'>";
                    $funcionarios = [$funcionario1, $funcionario2, $gerente1, $gerente2];
                    
                    foreach ($funcionarios as $funcionario) {
                        echo "<p><strong>" . get_class($funcionario) . ":</strong> " . $funcionario->trabalhar() . "</p>";
                    }
                    echo "</div>";
                    
                } catch (Exception $e) {
                    echo "<div class='warning'>";
                    echo "<p><strong>Erro:</strong> " . $e->getMessage() . "</p>";
                    echo "</div>";
                }
                ?>
            </div>

            <div class="code">
                <h4>💻 Código das Classes:</h4>
                <pre><code>class Funcionario {
    protected $nome;         // Protegido - acessível por subclasses
    protected $salario;      // Protegido - acessível por subclasses
    
    protected function setSalario($salario) {
        if ($salario >= 0) {
            $this->saldo = $salario;
            return true;
        }
        return false;
    }
}

class Gerente extends Funcionario {
    public function setSalario($salario) {
        if (parent::setSalario($salario)) {
            $this->bonusGerencia = $salario * 0.2;
            return true;
        }
        return false;
    }
}</code></pre>
            </div>

            <div class="explanation">
                <h4>Motivo da Implementação:</h4>
                <p><strong>Atributo Protegido:</strong> O salário é protegido para permitir que subclasses (Gerente) possam acessá-lo e modificá-lo, mas ainda mantendo o encapsulamento em relação ao código externo.</p>
                <p><strong>Herança:</strong> A classe Gerente herda todos os atributos e métodos públicos/protegidos de Funcionario, demonstrando reutilização de código.</p>
                <p><strong>Sobrescrita de Métodos:</strong> O método setSalario() é sobrescrito na subclasse para adicionar funcionalidade específica (cálculo do bônus), demonstrando polimorfismo.</p>
                <p><strong>Construtor da Classe Pai:</strong> Usa parent::__construct() para inicializar atributos herdados, evitando duplicação de código.</p>
                <p><strong>Métodos Específicos:</strong> A subclasse adiciona funcionalidades específicas (gerenciarEquipe, getDepartamento) que não existem na classe pai.</p>
            </div>

            <a href="index.html" class="btn">← Voltar ao Menu</a>
        </div>
    </div>
</body>
</html>
