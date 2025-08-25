<?php
/**
 * Classe ContaBancariaRefatorada - Exercício 9
 * Refatoração da ContaBancaria com validação de saque
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class ContaBancariaRefatorada {
    // Atributos privados para proteger os dados
    private $saldo;
    private $numeroConta;
    private $titular;
    private $tipoConta;
    private $limiteSaque;
    private $historico;
    private $status;
    
    /**
     * Construtor da classe
     * @param string $numeroConta Número da conta
     * @param string $titular Nome do titular
     * @param string $tipoConta Tipo da conta
     * @param float $saldoInicial Saldo inicial da conta
     * @param float $limiteSaque Limite de saque diário
     */
    public function __construct($numeroConta, $titular, $tipoConta = "Corrente", $saldoInicial = 0.0, $limiteSaque = 1000.0) {
        $this->numeroConta = $numeroConta;
        $this->titular = $titular;
        $this->tipoConta = $tipoConta;
        $this->saldo = $saldoInicial;
        $this->limiteSaque = $limiteSaque;
        $this->historico = [];
        $this->status = 'Ativa';
        
        // Registrar abertura da conta
        $this->adicionarTransacao("Abertura da conta", $saldoInicial, "Entrada", "Conta criada com sucesso");
    }
    
    /**
     * Método para depositar dinheiro na conta
     * @param float $valor Valor a ser depositado
     * @return array Array com resultado da operação
     */
    public function depositar($valor) {
        if (!$this->contaAtiva()) {
            return $this->criarResultado(false, "Conta inativa", 0);
        }
        
        if ($valor <= 0) {
            return $this->criarResultado(false, "Valor deve ser maior que zero", 0);
        }
        
        $this->saldo += $valor;
        $this->adicionarTransacao("Depósito", $valor, "Entrada", "Depósito realizado com sucesso");
        
        return $this->criarResultado(true, "Depósito realizado com sucesso", $this->saldo);
    }
    
    /**
     * Método para sacar dinheiro da conta (REFATORADO)
     * @param float $valor Valor a ser sacado
     * @return array Array com resultado da operação
     */
    public function sacar($valor) {
        if (!$this->contaAtiva()) {
            return $this->criarResultado(false, "Conta inativa", 0);
        }
        
        if ($valor <= 0) {
            return $this->criarResultado(false, "Valor deve ser maior que zero", 0);
        }
        
        // Validação 1: Saldo suficiente
        if ($valor > $this->saldo) {
            return $this->criarResultado(false, "Saldo insuficiente. Saldo atual: R$ " . number_format($this->saldo, 2, ',', '.'), $this->saldo);
        }
        
        // Validação 2: Limite de saque diário
        $saquesHoje = $this->calcularSaquesDoDia();
        if ($saquesHoje + $valor > $this->limiteSaque) {
            $limiteRestante = $this->limiteSaque - $saquesHoje;
            return $this->criarResultado(false, "Limite de saque diário excedido. Limite restante: R$ " . number_format($limiteRestante, 2, ',', '.'), $this->saldo);
        }
        
        // Validação 3: Valor mínimo de saque
        if ($valor < 10.0) {
            return $this->criarResultado(false, "Valor mínimo para saque é R$ 10,00", $this->saldo);
        }
        
        // Validação 4: Múltiplos de 10 para saques em caixa eletrônico
        if ($valor > 100.0 && $valor % 10 != 0) {
            return $this->criarResultado(false, "Para valores acima de R$ 100,00, o saque deve ser em múltiplos de R$ 10,00", $this->saldo);
        }
        
        // Se passou por todas as validações, realiza o saque
        $this->saldo -= $valor;
        $this->adicionarTransacao("Saque", $valor, "Saída", "Saque realizado com sucesso");
        
        return $this->criarResultado(true, "Saque realizado com sucesso", $this->saldo);
    }
    
    /**
     * Método para transferir dinheiro para outra conta
     * @param ContaBancariaRefatorada $contaDestino Conta de destino
     * @param float $valor Valor a ser transferido
     * @return array Array com resultado da operação
     */
    public function transferir($contaDestino, $valor) {
        if (!$this->contaAtiva()) {
            return $this->criarResultado(false, "Conta de origem inativa", 0);
        }
        
        if (!$contaDestino->contaAtiva()) {
            return $this->criarResultado(false, "Conta de destino inativa", 0);
        }
        
        // Tenta sacar da conta de origem
        $resultadoSaque = $this->sacar($valor);
        if (!$resultadoSaque['sucesso']) {
            return $resultadoSaque;
        }
        
        // Se o saque foi bem-sucedido, deposita na conta de destino
        $resultadoDeposito = $contaDestino->depositar($valor);
        if (!$resultadoDeposito['sucesso']) {
            // Se não conseguiu depositar, reverte o saque
            $this->depositar($valor);
            return $this->criarResultado(false, "Falha na transferência. Saque revertido.", $this->saldo);
        }
        
        $this->adicionarTransacao("Transferência para " . $contaDestino->getTitular(), $valor, "Saída", "Transferência realizada com sucesso");
        
        return $this->criarResultado(true, "Transferência realizada com sucesso", $this->saldo);
    }
    
    /**
     * Método para verificar se a conta está ativa
     * @return bool True se a conta estiver ativa
     */
    private function contaAtiva() {
        return $this->status === 'Ativa';
    }
    
    /**
     * Método para calcular saques do dia
     * @return float Total de saques realizados hoje
     */
    private function calcularSaquesDoDia() {
        $hoje = date('Y-m-d');
        $totalSaques = 0;
        
        foreach ($this->historico as $transacao) {
            if ($transacao['data'] == $hoje && $transacao['tipo'] == 'Saída' && $transacao['descricao'] == 'Saque') {
                $totalSaques += $transacao['valor'];
            }
        }
        
        return $totalSaques;
    }
    
    /**
     * Método para criar resultado padronizado
     * @param bool $sucesso Se a operação foi bem-sucedida
     * @param string $mensagem Mensagem da operação
     * @param float $saldo Saldo atual
     * @return array Array com resultado
     */
    private function criarResultado($sucesso, $mensagem, $saldo) {
        return [
            'sucesso' => $sucesso,
            'mensagem' => $mensagem,
            'saldo' => $saldo,
            'timestamp' => date('Y-m-d H:i:s')
        ];
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
     * Método para obter o limite de saque
     * @return float Limite de saque
     */
    public function getLimiteSaque() {
        return $this->limiteSaque;
    }
    
    /**
     * Método para obter o status da conta
     * @return string Status da conta
     */
    public function getStatus() {
        return $this->status;
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
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        return "Conta: {$this->numeroConta} | Titular: {$this->titular} | Tipo: {$this->tipoConta} | Saldo: R$ " . number_format($this->saldo, 2, ',', '.') . " | Status: {$this->status}";
    }
    
    /**
     * Método para exibir o extrato da conta
     * @return string Extrato formatado
     */
    public function exibirExtrato() {
        $extrato = "<h4>📋 Extrato da Conta {$this->numeroConta}</h4>";
        $extrato .= "<p><strong>Titular:</strong> {$this->titular}</p>";
        $extrato .= "<p><strong>Tipo:</strong> {$this->tipoConta}</p>";
        $extrato .= "<p><strong>Status:</strong> {$this->status}</p>";
        $extrato .= "<p><strong>Saldo Atual:</strong> R$ " . number_format($this->saldo, 2, ',', '.') . "</p>";
        $extrato .= "<p><strong>Limite de Saque Diário:</strong> R$ " . number_format($this->limiteSaque, 2, ',', '.') . "</p>";
        $extrato .= "<p><strong>Saques Realizados Hoje:</strong> R$ " . number_format($this->calcularSaquesDoDia(), 2, ',', '.') . "</p>";
        $extrato .= "<hr>";
        $extrato .= "<h5>Histórico de Transações:</h5>";
        
        if (empty($this->historico)) {
            $extrato .= "<p>Nenhuma transação registrada.</p>";
        } else {
            foreach ($this->historico as $transacao) {
                $tipo = $transacao['tipo'] == 'Entrada' ? '➕' : '➖';
                $extrato .= "<p>{$tipo} <strong>{$transacao['descricao']}</strong>: R$ " . number_format($transacao['valor'], 2, ',', '.') . " ({$transacao['tipo']}) - {$transacao['observacao']}</p>";
            }
        }
        
        return $extrato;
    }
    
    /**
     * Método privado para adicionar transações ao histórico
     * @param string $descricao Descrição da transação
     * @param float $valor Valor da transação
     * @param string $tipo Tipo da transação
     * @param string $observacao Observação adicional
     */
    private function adicionarTransacao($descricao, $valor, $tipo, $observacao = "") {
        $this->historico[] = [
            'data' => date('Y-m-d'),
            'hora' => date('H:i:s'),
            'descricao' => $descricao,
            'valor' => $valor,
            'tipo' => $tipo,
            'observacao' => $observacao
        ];
    }
    
    /**
     * Método para bloquear a conta
     */
    public function bloquearConta() {
        $this->status = 'Bloqueada';
        $this->adicionarTransacao("Bloqueio de conta", 0, "Sistema", "Conta bloqueada pelo sistema");
    }
    
    /**
     * Método para desbloquear a conta
     */
    public function desbloquearConta() {
        $this->status = 'Ativa';
        $this->adicionarTransacao("Desbloqueio de conta", 0, "Sistema", "Conta desbloqueada pelo sistema");
    }
    
    /**
     * Método para aplicar juros (para contas poupança)
     * @param float $taxa Taxa de juros em percentual
     * @return array Array com resultado da operação
     */
    public function aplicarJuros($taxa) {
        if ($this->tipoConta == "Poupança" && $taxa > 0 && $this->contaAtiva()) {
            $juros = $this->saldo * ($taxa / 100);
            $this->saldo += $juros;
            $this->adicionarTransacao("Aplicação de juros ({$taxa}%)", $juros, "Entrada", "Juros aplicados com sucesso");
            
            return $this->criarResultado(true, "Juros aplicados com sucesso", $this->saldo);
        }
        
        return $this->criarResultado(false, "Não foi possível aplicar juros", $this->saldo);
    }
}
?>
