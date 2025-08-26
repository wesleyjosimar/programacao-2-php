<?php
// Incluir todas as classes necessárias
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
    <title>Todos os Exercícios - Aula 3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2em;
        }
        .content {
            padding: 20px;
        }
        .exercise {
            background: #f8f9fa;
            border-left: 4px solid #007bff;
            margin: 20px 0;
            padding: 20px;
            border-radius: 5px;
        }
        .exercise h2 {
            color: #2c3e50;
            margin-top: 0;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 10px;
        }
        .exercise h3 {
            color: #495057;
            margin-top: 15px;
        }
        .result {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .justification {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin: 15px 0;
        }
        .justification h4 {
            color: #856404;
            margin-top: 0;
        }
        .footer {
            background: #f8f9fa;
            padding: 15px;
            text-align: center;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
        }
        .nav {
            text-align: center;
            margin: 20px 0;
        }
        .nav a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            margin: 3px;
        }
        .nav a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Todos os Exercícios - Aula 3</h1>
            <p>Programação Orientada a Objetos | 4ª Fase - Ciência da Computação</p>
        </div>

        <div class="nav">
            <a href="index.html">← Voltar ao Menu</a>
            <a href="CRITERIOS_AVALIACAO.md">Ver Critérios</a>
        </div>

        <div class="content">

            <!-- EXERCÍCIO 1 -->
            <div class="exercise">
                <h2>Exercício 1: Classe Produto - Atributos Públicos</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $produto1 = new Produto("Notebook", 2500.00);
                    $produto2 = new Produto("Mouse", 45.50);
                    
                    echo "<strong>Produto 1:</strong><br>";
                    $produto1->exibirInfo();
                    echo "<br><strong>Produto 2:</strong><br>";
                    $produto2->exibirInfo();
                    
                    echo "<br><strong>Desconto de 10% no Notebook:</strong><br>";
                    $produto1->calcularDesconto(10);
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>Este exercício demonstra o nível mais básico de POO, onde todos os atributos são públicos para facilitar o acesso direto. É intencionalmente simples para estabelecer a base conceitual.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 2 -->
            <div class="exercise">
                <h2>Exercício 2: Classe Produto - Encapsulamento</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $produtoEnc = new ProdutoEncapsulado("Smartphone", 1200.00);
                    
                    echo "<strong>Produto Original:</strong><br>";
                    $produtoEnc->exibirInfo();
                    
                    echo "<br><strong>Alterando preço para 1100.00:</strong><br>";
                    $produtoEnc->setPreco(1100.00);
                    $produtoEnc->exibirInfo();
                    
                    echo "<br><strong>Tentando definir preço negativo:</strong><br>";
                    $produtoEnc->setPreco(-100);
                    $produtoEnc->exibirInfo();
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>A refatoração demonstra encapsulamento: o preço agora é privado e só pode ser modificado através de um setter que valida os dados. Isso protege a integridade dos dados.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 3 -->
            <div class="exercise">
                <h2>Exercício 3: Classe ContaBancaria - Métodos de Operação</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $conta = new ContaBancaria("12345", "João Silva", 1000.00);
                    
                    echo "<strong>Conta Criada:</strong><br>";
                    echo "Número: " . $conta->getNumeroConta() . "<br>";
                    echo "Titular: " . $conta->getTitular() . "<br>";
                    echo "Saldo: R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Depositando R$ 500.00:</strong><br>";
                    $conta->depositar(500.00);
                    echo "Saldo: R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Sacando R$ 200.00:</strong><br>";
                    $conta->sacar(200.00);
                    echo "Saldo: R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Tentando sacar R$ 2000.00 (saldo insuficiente):</strong><br>";
                    $conta->sacar(2000.00);
                    echo "Saldo: R$ " . number_format($conta->getSaldo(), 2, ',', '.') . "<br>";
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>Os atributos são privados para proteger informações sensíveis da conta. Apenas métodos públicos podem modificar o saldo, garantindo controle total sobre as operações.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 4 -->
            <div class="exercise">
                <h2>Exercício 4: Herança - Funcionario e Gerente</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $funcionario = new Funcionario("Maria Santos", 3000.00, "Desenvolvedora");
                    $gerente = new Gerente("Carlos Oliveira", 5000.00, "TI");
                    
                    echo "<strong>Funcionário:</strong><br>";
                    $funcionario->exibirInfo();
                    
                    echo "<br><strong>Gerente:</strong><br>";
                    $gerente->exibirInfo();
                    
                    echo "<br><strong>Alterando salário do gerente para R$ 5500.00:</strong><br>";
                    $gerente->setSalario(5500.00);
                    $gerente->exibirInfo();
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>O uso de atributos protegidos permite que subclasses acessem e modifiquem dados da classe base, enquanto mantém o encapsulamento em relação ao mundo externo.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 5 -->
            <div class="exercise">
                <h2>Exercício 5: Classe Usuario - Verificação de Senha</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $usuario = new Usuario("admin", "senha123");
                    
                    echo "<strong>Usuário Criado:</strong><br>";
                    echo "Login: " . $usuario->getLogin() . "<br>";
                    
                    echo "<br><strong>Verificando senha correta:</strong><br>";
                    if ($usuario->verificarSenha("senha123")) {
                        echo "✓ Senha correta!<br>";
                    } else {
                        echo "✗ Senha incorreta!<br>";
                    }
                    
                    echo "<br><strong>Verificando senha incorreta:</strong><br>";
                    if ($usuario->verificarSenha("senha456")) {
                        echo "✓ Senha correta!<br>";
                    } else {
                        echo "✗ Senha incorreta!<br>";
                    }
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>A senha é privada e nunca exposta. O hash garante que mesmo que o objeto seja serializado, a senha original não pode ser recuperada.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 6 -->
            <div class="exercise">
                <h2>Exercício 6: Herança - Config e Subclasses</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $config = new Config();
                    $config->adicionarParametro("host", "localhost");
                    $config->adicionarParametro("porta", "3306");
                    $config->adicionarParametro("usuario", "root");
                    
                    $leitor = new ConfigLeitura();
                    $modificador = new ConfigModificacao();
                    $avancada = new ConfigAvancada();
                    
                    echo "<strong>Configuração Base:</strong><br>";
                    $config->listarParametros();
                    
                    echo "<br><strong>Leitor - Apenas Visualização:</strong><br>";
                    $leitor->listarParametros();
                    
                    echo "<br><strong>Modificador - Adicionando parâmetro:</strong><br>";
                    $modificador->adicionarParametro("senha", "123456");
                    $modificador->listarParametros();
                    
                    echo "<br><strong>Avançada - Contando parâmetros:</strong><br>";
                    echo "Total de parâmetros: " . $avancada->contarParametros() . "<br>";
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>Cada subclasse tem responsabilidades específicas: leitura, modificação ou operações avançadas. Os atributos protegidos permitem que todas acessem os parâmetros base.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 7 -->
            <div class="exercise">
                <h2>Exercício 7: Classe Pedido - Gerenciamento de Array</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $pedido = new Pedido("PED001");
                    
                    echo "<strong>Pedido Criado:</strong><br>";
                    echo "Número: " . $pedido->getNumero() . "<br>";
                    
                    echo "<br><strong>Adicionando itens:</strong><br>";
                    $pedido->inserirItem("Produto A", 2, 25.00);
                    $pedido->inserirItem("Produto B", 1, 50.00);
                    $pedido->inserirItem("Produto C", 3, 15.00);
                    
                    echo "<br><strong>Listando itens:</strong><br>";
                    $pedido->listarItens();
                    
                    echo "<br><strong>Removendo item 'Produto B':</strong><br>";
                    $pedido->removerItem("Produto B");
                    $pedido->listarItens();
                    
                    echo "<br><strong>Total do pedido:</strong><br>";
                    echo "R$ " . number_format($pedido->calcularTotal(), 2, ',', '.') . "<br>";
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>O array de itens é privado para evitar modificações diretas. Apenas métodos específicos podem alterar a estrutura, garantindo consistência dos dados.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 8 -->
            <div class="exercise">
                <h2>Exercício 8: Classe Cliente - Diferentes Níveis de Acesso</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $cliente = new Cliente("Ana Silva", "123.456.789-00", "(11) 99999-9999");
                    $clienteVip = new ClienteVip("João Vip", "987.654.321-00", "(11) 88888-8888", "Platinum");
                    
                    echo "<strong>Cliente Normal:</strong><br>";
                    echo "Nome: " . $cliente->nome . "<br>";
                    echo "CPF: " . $cliente->getCpf() . "<br>";
                    echo "Telefone: " . $cliente->getTelefone() . "<br>";
                    
                    echo "<br><strong>Cliente VIP:</strong><br>";
                    echo "Nome: " . $clienteVip->nome . "<br>";
                    echo "CPF: " . $clienteVip->getCpf() . "<br>";
                    echo "Telefone: " . $clienteVip->getTelefone() . "<br>";
                    echo "Categoria: " . $clienteVip->getCategoria() . "<br>";
                    
                    echo "<br><strong>Alterando telefone do cliente VIP:</strong><br>";
                    $clienteVip->setTelefone("(11) 77777-7777");
                    echo "Novo telefone: " . $clienteVip->getTelefone() . "<br>";
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>Cada nível de visibilidade tem um propósito: público para acesso universal, protegido para herança, privado para encapsulamento total. A subclasse demonstra acesso a membros protegidos.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 9 -->
            <div class="exercise">
                <h2>Exercício 9: Refatoração - ContaBancaria com Validação</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    $contaRef = new ContaBancariaRefatorada("67890", "Pedro Santos", 5000.00);
                    
                    echo "<strong>Conta Criada:</strong><br>";
                    echo "Número: " . $contaRef->getNumeroConta() . "<br>";
                    echo "Titular: " . $contaRef->getTitular() . "<br>";
                    echo "Saldo: R$ " . number_format($contaRef->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Depositando R$ 1000.00:</strong><br>";
                    $contaRef->depositar(1000.00);
                    echo "Saldo: R$ " . number_format($contaRef->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Sacando R$ 500.00 (válido):</strong><br>";
                    $contaRef->sacar(500.00);
                    echo "Saldo: R$ " . number_format($contaRef->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Tentando sacar R$ 100.00 (múltiplo inválido):</strong><br>";
                    $contaRef->sacar(100.00);
                    echo "Saldo: R$ " . number_format($contaRef->getSaldo(), 2, ',', '.') . "<br>";
                    
                    echo "<br><strong>Tentando sacar R$ 10000.00 (saldo insuficiente):</strong><br>";
                    $contaRef->sacar(10000.00);
                    echo "Saldo: R$ " . number_format($contaRef->getSaldo(), 2, ',', '.') . "<br>";
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>A refatoração adiciona validações robustas que simulam regras bancárias reais. O método sacar agora verifica múltiplas condições antes de permitir a operação.</p>
                </div>
            </div>

            <!-- EXERCÍCIO 10 -->
            <div class="exercise">
                <h2>Exercício 10: Classe ConexaoBD - Encapsulamento de Conexão</h2>
                
                <h3>Demonstração:</h3>
                <div class="result">
                    <?php
                    try {
                        $conexao = new ConexaoBD();
                        
                        echo "<strong>Testando conexão com banco de dados:</strong><br>";
                        
                        // Simulando obtenção de conexão
                        $pdo = $conexao->getConexao();
                        
                        if ($pdo) {
                            echo "✓ Conexão estabelecida com sucesso!<br>";
                            echo "Versão do PDO: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "<br>";
                            echo "Driver: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "<br>";
                        } else {
                            echo "✗ Falha na conexão<br>";
                        }
                        
                    } catch (Exception $e) {
                        echo "<strong>Erro na conexão:</strong><br>";
                        echo "Mensagem: " . $e->getMessage() . "<br>";
                        echo "Código: " . $e->getCode() . "<br>";
                    }
                    ?>
                </div>

                <div class="justification">
                    <h4>Justificativa da Implementação:</h4>
                    <p>O método conectar é privado para esconder detalhes técnicos da conexão. Apenas getConexao é público, fornecendo uma interface limpa para obter a conexão.</p>
                </div>
            </div>

        </div>

        <div class="footer">
            <p><strong>Desenvolvido por:</strong> Aluno da 4ª Fase - Ciência da Computação</p>
            <p><strong>Disciplina:</strong> Programação 2 - PHP</p>
            <p><strong>Conceitos Aplicados:</strong> Encapsulamento, Herança, Polimorfismo, Abstração</p>
        </div>
    </div>
</body>
</html>
