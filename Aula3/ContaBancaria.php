<?php
/**
 * Classe ContaBancaria - Exercício 3
 * Demonstração de encapsulamento com operações bancárias
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class ContaBancaria {
    // Atributos privados para proteger os dados
    private $saldo;
    private $numeroConta;
    private $titular;
    private $tipoConta;
    private $historico;
    
    /**
     * Construtor da classe
     * @param string $numeroConta Número da conta
     * @param string $titular Nome do titular
     * @param string $tipoConta Tipo da conta (corrente, poupança, etc.)
     * @param float $saldoInicial Saldo inicial da conta
     */
    public function __construct($numeroConta, $titular, $tipoConta = "Corrente", $saldoInicial = 0.0) {
        $this->numeroConta = $numeroConta;
        $this->titular = $titular;
        $this->tipoConta = $tipoConta;
        $this->saldo = $saldoInicial;
        $this->historico = [];
        
        // Registrar abertura da conta
        $this->adicionarTransacao("Abertura da conta", $saldoInicial, "Entrada");
    }
    
    /**
     * Método para depositar dinheiro na conta
     * @param float $valor Valor a ser depositado
     * @return bool True se o depósito foi realizado com sucesso
     */
    public function depositar($valor) {
        if ($valor > 0) {
            $this->saldo += $valor;
            $this->adicionarTransacao("Depósito", $valor, "Entrada");
            return true;
        }
        return false;
    }
    
    /**
     * Método para sacar dinheiro da conta
     * @param float $valor Valor a ser sacado
     * @return bool True se o saque foi realizado com sucesso
     */
    public function sacar($valor) {
        if ($valor > 0 && $valor <= $this->saldo) {
            $this->saldo -= $valor;
            $this->adicionarTransacao("Saque", $valor, "Saída");
            return true;
        }
        return false;
    }
    
    /**
     * Método para transferir dinheiro para outra conta
     * @param ContaBancaria $contaDestino Conta de destino
     * @param float $valor Valor a ser transferido
     * @return bool True se a transferência foi realizada com sucesso
     */
    public function transferir($contaDestino, $valor) {
        if ($this->sacar($valor)) {
            if ($contaDestino->depositar($valor)) {
                $this->adicionarTransacao("Transferência para " . $contaDestino->getTitular(), $valor, "Saída");
                return true;
            } else {
                // Se não conseguiu depositar na conta destino, reverte o saque
                $this->depositar($valor);
            }
        }
        return false;
    }
    
    /**
     * Método para obter o saldo atual
     * @return float Saldo atual da conta
     */
    public function getSaldo() {
        return $this->saldo;
    }
    
    /**
     * Método para obter o número da conta
     * @return string Número da conta
     */
    public function getNumeroConta() {
        return $this->numeroConta;
    }
    
    /**
     * Método para obter o titular da conta
     * @return string Nome do titular
     */
    public function getTitular() {
        return $this->titular;
    }
    
    /**
     * Método para obter o tipo da conta
     * @return string Tipo da conta
     */
    public function getTipoConta() {
        return $this->tipoConta;
    }
    
    /**
     * Método para obter o histórico de transações
     * @return array Histórico de transações
     */
    public function getHistorico() {
        return $this->historico;
    }
    
    /**
     * Método para exibir informações da conta
     * @return string Informações formatadas da conta
     */
    public function exibirInfo() {
        return "Conta: {$this->numeroConta} | Titular: {$this->titular} | Tipo: {$this->tipoConta} | Saldo: R$ " . number_format($this->saldo, 2, ',', '.');
    }
    
    /**
     * Método para exibir o extrato da conta
     * @return string Extrato formatado
     */
    public function exibirExtrato() {
        $extrato = "<h4>Extrato da Conta {$this->numeroConta}</h4>";
        $extrato .= "<p><strong>Titular:</strong> {$this->titular}</p>";
        $extrato .= "<p><strong>Tipo:</strong> {$this->tipoConta}</p>";
        $extrato .= "<p><strong>Saldo Atual:</strong> R$ " . number_format($this->saldo, 2, ',', '.') . "</p>";
        $extrato .= "<hr>";
        $extrato .= "<h5>Histórico de Transações:</h5>";
        
        if (empty($this->historico)) {
            $extrato .= "<p>Nenhuma transação registrada.</p>";
        } else {
            foreach ($this->historico as $transacao) {
                $tipo = $transacao['tipo'] == 'Entrada' ? '➕' : '➖';
                $extrato .= "<p>{$tipo} <strong>{$transacao['descricao']}</strong>: R$ " . number_format($transacao['valor'], 2, ',', '.') . " ({$transacao['tipo']})</p>";
            }
        }
        
        return $extrato;
    }
    
    /**
     * Método privado para adicionar transações ao histórico
     * @param string $descricao Descrição da transação
     * @param float $valor Valor da transação
     * @param string $tipo Tipo da transação (Entrada/Saída)
     */
    private function adicionarTransacao($descricao, $valor, $tipo) {
        $this->historico[] = [
            'data' => date('d/m/Y H:i:s'),
            'descricao' => $descricao,
            'valor' => $valor,
            'tipo' => $tipo
        ];
    }
    
    /**
     * Método para aplicar juros (para contas poupança)
     * @param float $taxa Taxa de juros em percentual
     * @return bool True se os juros foram aplicados
     */
    public function aplicarJuros($taxa) {
        if ($this->tipoConta == "Poupança" && $taxa > 0) {
            $juros = $this->saldo * ($taxa / 100);
            $this->saldo += $juros;
            $this->adicionarTransacao("Aplicação de juros ({$taxa}%)", $juros, "Entrada");
            return true;
        }
        return false;
    }
}
?>
