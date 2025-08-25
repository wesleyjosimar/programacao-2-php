<?php
/**
 * Todos os Exercícios - Aula 3
 * Executa todos os exercícios de POO de uma vez
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */

// Incluir todas as classes
require_once 'Produto.php';
require_once 'ProdutoEncapsulado.php';
require_once 'ContaBancaria.php';
require_once 'Funcionario.php';
require_once 'Usuario.php';
require_once 'Config.php';
require_once 'Pedido.php';
require_once 'Cliente.php';
require_once 'ContaBancariaRefatorada.php';
require_once 'ConexaoBD.php';

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todos os Exercícios - POO Aula 3</title>
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
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }
        .content {
            padding: 30px;
        }
        .exercise-section {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .exercise-section h3 {
            color: #2c3e50;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
            margin-top: 0;
        }
        .result {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
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
        .info {
            background: #d1ecf1;
            border: 1px solid #bee5eb;
            color: #0c5460;
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
        .btn {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 5px;
        }
        .summary {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .summary h4 {
            color: #1976d2;
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🚀 Todos os Exercícios de POO</h1>
            <p>Aula 3 - Programação Orientada a Objetos | 4ª Fase - Ciência da Computação</p>
        </div>
        
        <div class="content">
            <div class="summary">
                <h4>📚 Resumo dos Conceitos Implementados</h4>
                <p>Esta demonstração inclui todos os 10 exercícios de POO, cobrindo os principais conceitos: <strong>Encapsulamento</strong>, <strong>Herança</strong>, <strong>Polimorfismo</strong> e <strong>Abstração</strong>.</p>
            </div>

            <!-- Exercício 1: Classe Produto -->
            <div class="exercise-section">
                <h3>🏷️ Exercício 1: Classe Produto - Atributos Públicos</h3>
                <div class="result">
                    <?php
                    try {
                        $produto1 = new Produto("Notebook Dell", 3500.00);
                        $produto2 = new Produto("Mouse Gamer", 89.90);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Produto 1:</strong> " . $produto1->exibirInfo() . "</p>";
                        echo "<p><strong>Produto 2:</strong> " . $produto2->exibirInfo() . "</p>";
                        echo "<p><strong>Desconto 15% Produto 2:</strong> R$ " . number_format($produto2->calcularDesconto(15), 2, ',', '.') . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Atributos públicos permitem acesso direto aos dados.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 2: Classe Produto com Encapsulamento -->
            <div class="exercise-section">
                <h3>🔒 Exercício 2: Classe Produto com Encapsulamento</h3>
                <div class="result">
                    <?php
                    try {
                        $produtoEncapsulado = new ProdutoEncapsulado("Smartphone", 1299.99);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Produto:</strong> " . $produtoEncapsulado->exibirInfo() . "</p>";
                        echo "<p><strong>Preço via getter:</strong> R$ " . number_format($produtoEncapsulado->getPreco(), 2, ',', '.') . "</p>";
                        echo "</div>";
                        
                        if ($produtoEncapsulado->aplicarDesconto(10)) {
                            echo "<div class='info'>";
                            echo "<p>Desconto de 10% aplicado. Novo preço: R$ " . number_format($produtoEncapsulado->getPreco(), 2, ',', '.') . "</p>";
                            echo "</div>";
                        }
                        
                        echo "<p><strong>Conceito:</strong> Atributos privados com métodos get/set para controle de acesso.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 3: Classe ContaBancaria -->
            <div class="exercise-section">
                <h3>🏦 Exercício 3: Classe ContaBancaria</h3>
                <div class="result">
                    <?php
                    try {
                        $conta = new ContaBancaria("001", "João Silva", "Corrente", 1000.00);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Conta criada:</strong> " . $conta->exibirInfo() . "</p>";
                        echo "</div>";
                        
                        if ($conta->depositar(500.00)) {
                            echo "<div class='info'>";
                            echo "<p>Depósito realizado. Novo saldo: R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "</p>";
                            echo "</div>";
                        }
                        
                        if ($conta->sacar(300.00)) {
                            echo "<div class='info'>";
                            echo "<p>Saque realizado. Saldo atual: R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "</p>";
                            echo "</div>";
                        }
                        
                        echo "<p><strong>Conceito:</strong> Encapsulamento com métodos para operações bancárias.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 4: Herança - Funcionario e Gerente -->
            <div class="exercise-section">
                <h3>👥 Exercício 4: Herança - Funcionario e Gerente</h3>
                <div class="result">
                    <?php
                    try {
                        $funcionario = new Funcionario("Carlos Silva", 2500.00, "Desenvolvedor", "F001");
                        $gerente = new Gerente("Roberto Santos", 5000.00, "TI", "G001");
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Funcionário:</strong> " . $funcionario->exibirInfo() . "</p>";
                        echo "<p><strong>Gerente:</strong> " . $gerente->exibirInfo() . "</p>";
                        echo "</div>";
                        
                        echo "<div class='info'>";
                        echo "<p><strong>Salário Líquido Funcionário:</strong> R$ " . number_format($funcionario->calcularSalarioLiquido(), 2, ',', '.') . "</p>";
                        echo "<p><strong>Salário Líquido Gerente:</strong> R$ " . number_format($gerente->calcularSalarioLiquido(), 2, ',', '.') . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Herança com atributos protegidos e sobrescrita de métodos.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 5: Classe Usuario -->
            <div class="exercise-section">
                <h3>👤 Exercício 5: Classe Usuario - Verificação de Senha</h3>
                <div class="result">
                    <?php
                    try {
                        $usuario = new Usuario("Maria Silva", "maria@email.com", "senha123");
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Usuário criado:</strong> " . $usuario->exibirInfo() . "</p>";
                        echo "</div>";
                        
                        echo "<div class='info'>";
                        echo "<p><strong>Verificação de senha 'senha123':</strong> " . ($usuario->verificarSenha('senha123') ? '✅ Correta' : '❌ Incorreta') . "</p>";
                        echo "<p><strong>Verificação de senha 'senha456':</strong> " . ($usuario->verificarSenha('senha456') ? '✅ Correta' : '❌ Incorreta') . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Encapsulamento de senha com hash e verificação segura.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 6: Herança - Config e Subclasses -->
            <div class="exercise-section">
                <h3>⚙️ Exercício 6: Herança - Config e Subclasses</h3>
                <div class="result">
                    <?php
                    try {
                        $configLeitura = new ConfigLeitura(['host' => 'localhost', 'porta' => 3306]);
                        $configModificacao = new ConfigModificacao(['banco' => 'teste', 'usuario' => 'root']);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Config Leitura:</strong> " . $configLeitura->getNumeroParametros() . " parâmetros</p>";
                        echo "<p><strong>Config Modificação:</strong> " . $configModificacao->getNumeroParametros() . " parâmetros</p>";
                        echo "</div>";
                        
                        $configModificacao->setParametro('senha', '123456');
                        echo "<div class='info'>";
                        echo "<p><strong>Novo parâmetro adicionado:</strong> " . $configModificacao->getNumeroParametros() . " parâmetros</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Herança com diferentes níveis de acesso aos parâmetros.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 7: Classe Pedido -->
            <div class="exercise-section">
                <h3>📋 Exercício 7: Classe Pedido - Gerenciamento de Array</h3>
                <div class="result">
                    <?php
                    try {
                        $pedido = new Pedido("Cliente Exemplo");
                        
                        $pedido->inserirItem("Produto A", 2, 25.00);
                        $pedido->inserirItem("Produto B", 1, 50.00);
                        $pedido->inserirItem("Produto C", 3, 15.00);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Pedido criado:</strong> " . $pedido->exibirInfo() . "</p>";
                        echo "<p><strong>Total de itens:</strong> " . $pedido->getNumeroItens() . "</p>";
                        echo "<p><strong>Valor total:</strong> R$ " . number_format($pedido->getValorTotal(), 2, ',', '.') . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Encapsulamento de array privado com métodos para manipulação.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 8: Classe Cliente -->
            <div class="exercise-section">
                <h3>👤 Exercício 8: Classe Cliente - Diferentes Níveis de Acesso</h3>
                <div class="result">
                    <?php
                    try {
                        $cliente = new Cliente("João Silva", "12345678901", "11987654321");
                        $clienteVip = new ClienteVip("Maria Santos", "98765432109", "11912345678");
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Cliente:</strong> " . $cliente->exibirInfo() . "</p>";
                        echo "<p><strong>Cliente VIP:</strong> " . $clienteVip->exibirInfo() . "</p>";
                        echo "</div>";
                        
                        echo "<div class='info'>";
                        echo "<p><strong>Nome (público):</strong> " . $cliente->nome . "</p>";
                        echo "<p><strong>CPF (protegido):</strong> " . $cliente->getCpf() . "</p>";
                        echo "<p><strong>Telefone (privado):</strong> " . $cliente->getTelefone() . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Diferentes níveis de acesso: público, protegido e privado.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 9: ContaBancaria Refatorada -->
            <div class="exercise-section">
                <h3>🏦 Exercício 9: ContaBancaria Refatorada - Validação de Saque</h3>
                <div class="result">
                    <?php
                    try {
                        $contaRefatorada = new ContaBancariaRefatorada("001", "João Silva", "Corrente", 1000.00, 500.00);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Conta criada:</strong> " . $contaRefatorada->exibirInfo() . "</p>";
                        echo "</div>";
                        
                        $resultadoSaque = $contaRefatorada->sacar(300.00);
                        echo "<div class='info'>";
                        echo "<p><strong>Resultado do saque:</strong> " . $resultadoSaque['mensagem'] . "</p>";
                        echo "<p><strong>Saldo atual:</strong> R$ " . number_format($resultadoSaque['saldo'], 2, ',', '.') . "</p>";
                        echo "</div>";
                        
                        $resultadoSaqueInvalido = $contaRefatorada->sacar(2000.00);
                        echo "<div class='warning'>";
                        echo "<p><strong>Tentativa de saque inválido:</strong> " . $resultadoSaqueInvalido['mensagem'] . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Refatoração com validações robustas e tratamento de erros.</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Exercício 10: Classe ConexaoBD -->
            <div class="exercise-section">
                <h3>🗄️ Exercício 10: Classe ConexaoBD - Encapsulamento de Conexão</h3>
                <div class="result">
                    <?php
                    try {
                        $conexao = new ConexaoBD([
                            'host' => 'localhost',
                            'banco' => 'exemplo',
                            'usuario' => 'usuario_teste'
                        ]);
                        
                        echo "<div class='success'>";
                        echo "<p><strong>Objeto ConexaoBD criado com sucesso</strong></p>";
                        echo "</div>";
                        
                        $info = $conexao->getInfoConexao();
                        echo "<div class='info'>";
                        echo "<p><strong>Host:</strong> " . $info['host'] . "</p>";
                        echo "<p><strong>Banco:</strong> " . $info['banco'] . "</p>";
                        echo "<p><strong>Usuário:</strong> " . $info['usuario'] . "</p>";
                        echo "<p><strong>Status:</strong> " . ($info['conectado'] ? 'Conectado' : 'Desconectado') . "</p>";
                        echo "</div>";
                        
                        echo "<p><strong>Conceito:</strong> Encapsulamento completo da conexão com método privado conectar() e público getConexao().</p>";
                        
                    } catch (Exception $e) {
                        echo "<div class='warning'>Erro: " . $e->getMessage() . "</div>";
                    }
                    ?>
                </div>
            </div>

            <!-- Resumo Final -->
            <div class="summary">
                <h4>🎯 Resumo da Implementação</h4>
                <p><strong>Total de Exercícios Implementados:</strong> 10</p>
                <p><strong>Conceitos Demonstrados:</strong></p>
                <ul>
                    <li><strong>Encapsulamento:</strong> Atributos privados/protegidos com métodos públicos</li>
                    <li><strong>Herança:</strong> Classes base e derivadas com reutilização de código</li>
                    <li><strong>Polimorfismo:</strong> Sobrescrita de métodos e comportamentos diferentes</li>
                    <li><strong>Abstração:</strong> Interfaces claras e implementações ocultas</li>
                </ul>
                <p><strong>Nível de Complexidade:</strong> Adequado para 4ª fase de Ciência da Computação</p>
                <p><strong>Padrões de Projeto:</strong> Getters/Setters, Factory, Singleton (implícito)</p>
            </div>

            <a href="index.html" class="btn">← Voltar ao Menu Principal</a>
        </div>
    </div>
</body>
</html>
