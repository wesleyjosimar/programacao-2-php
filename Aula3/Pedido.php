<?php
/**
 * Classe Pedido - Exercício 7
 * Demonstração de gerenciamento de array privado
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class Pedido {
    // Atributos privados
    private $id;
    private $itens;          // Array privado de itens
    private $cliente;
    private $dataPedido;
    private $status;
    private $valorTotal;
    
    /**
     * Construtor da classe
     * @param string $cliente Nome do cliente
     */
    public function __construct($cliente) {
        $this->id = uniqid('pedido_');
        $this->itens = [];
        $this->cliente = $cliente;
        $this->dataPedido = date('Y-m-d H:i:s');
        $this->status = 'Pendente';
        $this->valorTotal = 0.0;
    }
    
    /**
     * Método para inserir um item no pedido
     * @param string $produto Nome do produto
     * @param int $quantidade Quantidade do produto
     * @param float $precoUnitario Preço unitário do produto
     * @return bool True se o item foi inserido com sucesso
     */
    public function inserirItem($produto, $quantidade, $precoUnitario) {
        if ($quantidade > 0 && $precoUnitario >= 0) {
            $item = [
                'produto' => $produto,
                'quantidade' => $quantidade,
                'preco_unitario' => $precoUnitario,
                'subtotal' => $quantidade * $precoUnitario
            ];
            
            $this->itens[] = $item;
            $this->calcularValorTotal();
            return true;
        }
        return false;
    }
    
    /**
     * Método para remover um item do pedido
     * @param int $indice Índice do item a ser removido
     * @return bool True se o item foi removido com sucesso
     */
    public function removerItem($indice) {
        if (isset($this->itens[$indice])) {
            unset($this->itens[$indice]);
            $this->itens = array_values($this->itens); // Reindexar array
            $this->calcularValorTotal();
            return true;
        }
        return false;
    }
    
    /**
     * Método para atualizar a quantidade de um item
     * @param int $indice Índice do item
     * @param int $novaQuantidade Nova quantidade
     * @return bool True se a quantidade foi atualizada
     */
    public function atualizarQuantidade($indice, $novaQuantidade) {
        if (isset($this->itens[$indice]) && $novaQuantidade > 0) {
            $this->itens[$indice]['quantidade'] = $novaQuantidade;
            $this->itens[$indice]['subtotal'] = $novaQuantidade * $this->itens[$indice]['preco_unitario'];
            $this->calcularValorTotal();
            return true;
        }
        return false;
    }
    
    /**
     * Método para listar todos os itens do pedido
     * @return array Array com todos os itens
     */
    public function listarItens() {
        return $this->itens;
    }
    
    /**
     * Método para obter um item específico
     * @param int $indice Índice do item
     * @return array|null Item ou null se não existir
     */
    public function getItem($indice) {
        return isset($this->itens[$indice]) ? $this->itens[$indice] : null;
    }
    
    /**
     * Método para obter o número de itens no pedido
     * @return int Número de itens
     */
    public function getNumeroItens() {
        return count($this->itens);
    }
    
    /**
     * Método para verificar se o pedido está vazio
     * @return bool True se o pedido estiver vazio
     */
    public function estaVazio() {
        return empty($this->itens);
    }
    
    /**
     * Método para calcular o valor total do pedido
     */
    private function calcularValorTotal() {
        $this->valorTotal = 0;
        foreach ($this->itens as $item) {
            $this->valorTotal += $item['subtotal'];
        }
    }
    
    /**
     * Método para obter o valor total do pedido
     * @return float Valor total
     */
    public function getValorTotal() {
        return $this->valorTotal;
    }
    
    /**
     * Método para aplicar desconto ao pedido
     * @param float $percentual Percentual de desconto
     * @return bool True se o desconto foi aplicado
     */
    public function aplicarDesconto($percentual) {
        if ($percentual > 0 && $percentual <= 100) {
            $desconto = $this->valorTotal * ($percentual / 100);
            $this->valorTotal -= $desconto;
            return true;
        }
        return false;
    }
    
    /**
     * Método para obter o ID do pedido
     * @return string ID do pedido
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Método para obter o cliente do pedido
     * @return string Nome do cliente
     */
    public function getCliente() {
        return $this->cliente;
    }
    
    /**
     * Método para obter a data do pedido
     * @return string Data do pedido
     */
    public function getDataPedido() {
        return $this->dataPedido;
    }
    
    /**
     * Método para obter o status do pedido
     * @return string Status do pedido
     */
    public function getStatus() {
        return $this->status;
    }
    
    /**
     * Método para alterar o status do pedido
     * @param string $novoStatus Novo status
     */
    public function setStatus($novoStatus) {
        $statusValidos = ['Pendente', 'Em Preparo', 'Pronto', 'Entregue', 'Cancelado'];
        if (in_array($novoStatus, $statusValidos)) {
            $this->status = $novoStatus;
        }
    }
    
    /**
     * Método para exibir informações do pedido
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        return "Pedido: {$this->id} | Cliente: {$this->cliente} | Status: {$this->status} | Total: R$ " . number_format($this->valorTotal, 2, ',', '.');
    }
    
    /**
     * Método para exibir o pedido completo
     * @return string Pedido formatado
     */
    public function exibirPedido() {
        $saida = "<h4>Pedido #{$this->id}</h4>";
        $saida .= "<p><strong>Cliente:</strong> {$this->cliente}</p>";
        $saida .= "<p><strong>Data:</strong> {$this->dataPedido}</p>";
        $saida .= "<p><strong>Status:</strong> {$this->status}</p>";
        $saida .= "<p><strong>Total de Itens:</strong> {$this->getNumeroItens()}</p>";
        $saida .= "<hr>";
        
        if ($this->estaVazio()) {
            $saida .= "<p>Nenhum item no pedido.</p>";
        } else {
            $saida .= "<h5>Itens do Pedido:</h5>";
            $saida .= "<table border='1' style='border-collapse: collapse; width: 100%;'>";
            $saida .= "<tr style='background-color: #f8f9fa;'>";
            $saida .= "<th style='padding: 8px; text-align: left;'>Produto</th>";
            $saida .= "<th style='padding: 8px; text-align: center;'>Qtd</th>";
            $saida .= "<th style='padding: 8px; text-align: right;'>Preço Unit.</th>";
            $saida .= "<th style='padding: 8px; text-align: right;'>Subtotal</th>";
            $saida .= "</tr>";
            
            foreach ($this->itens as $indice => $item) {
                $saida .= "<tr>";
                $saida .= "<td style='padding: 8px;'>{$item['produto']}</td>";
                $saida .= "<td style='padding: 8px; text-align: center;'>{$item['quantidade']}</td>";
                $saida .= "<td style='padding: 8px; text-align: right;'>R$ " . number_format($item['preco_unitario'], 2, ',', '.') . "</td>";
                $saida .= "<td style='padding: 8px; text-align: right;'>R$ " . number_format($item['subtotal'], 2, ',', '.') . "</td>";
                $saida .= "</tr>";
            }
            
            $saida .= "<tr style='background-color: #e9ecef; font-weight: bold;'>";
            $saida .= "<td colspan='3' style='padding: 8px; text-align: right;'>Total:</td>";
            $saida .= "<td style='padding: 8px; text-align: right;'>R$ " . number_format($this->valorTotal, 2, ',', '.') . "</td>";
            $saida .= "</tr>";
            $saida .= "</table>";
        }
        
        return $saida;
    }
    
    /**
     * Método para limpar todos os itens do pedido
     */
    public function limparPedido() {
        $this->itens = [];
        $this->valorTotal = 0.0;
        $this->status = 'Pendente';
    }
    
    /**
     * Método para duplicar o pedido
     * @return Pedido Novo pedido com os mesmos itens
     */
    public function duplicarPedido() {
        $novoPedido = new Pedido($this->cliente . " (Cópia)");
        foreach ($this->itens as $item) {
            $novoPedido->inserirItem($item['produto'], $item['quantidade'], $item['preco_unitario']);
        }
        return $novoPedido;
    }
}
?>
