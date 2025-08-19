<?php
/**
 * Exercício 1: Classe Conta com Construtor
 * 
 * Crie uma classe Conta que tenha um construtor para inicializar o titular e o saldo inicial.
 */

class Conta {
    // Atributos
    private $titular;
    private $saldo;
    private $numero;
    
    // Construtor que recebe titular e saldo inicial
    public function __construct($titular, $saldo) {
        $this->titular = $titular;
        $this->saldo = $saldo;
        // Número da conta gerado automaticamente
        $this->numero = rand(1000, 9999);
    }
    
    // Método para exibir dados da conta
    public function exibirDados() {
        return "Conta Nº: {$this->numero}\n" .
               "Titular: {$this->titular}\n" .
               "Saldo: R$ " . number_format($this->saldo, 2, ',', '.') . "\n" .
               "------------------------\n";
    }
    
    // Método para depositar valor
    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            return "Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso!\n";
        } else {
            return "Valor inválido para depósito!\n";
        }
    }
    
    // Getters para acesso aos atributos
    public function getTitular() {
        return $this->titular;
    }
    
    public function getSaldo() {
        return $this->saldo;
    }
    
    public function getNumero() {
        return $this->numero;
    }
}

// Teste da implementação
echo "=== TESTE DA CLASSE CONTA ===\n\n";

// Criando duas contas
$conta1 = new Conta("Carlos Silva", 500);
$conta2 = new Conta("Ana Oliveira", 1200);

// Exibindo dados iniciais
echo "Dados iniciais:\n";
echo $conta1->exibirDados();
echo $conta2->exibirDados();

// Fazendo depósito na conta 1
echo "Fazendo depósito na conta de Carlos Silva:\n";
echo $conta1->depositar(300);

// Exibindo dados após depósito
echo "\nDados após depósito:\n";
echo $conta1->exibirDados();

// Testando depósito com valor inválido
echo "Testando depósito com valor inválido:\n";
echo $conta1->depositar(-50);
?>
