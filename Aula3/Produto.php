<?php
/**
 * Classe Produto - Exercício 1
 * Demonstração de atributos públicos em POO
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class Produto {
    // Atributos públicos - podem ser acessados diretamente de fora da classe
    public $nome;
    public $preco;
    
    /**
     * Construtor da classe
     * @param string $nome Nome do produto
     * @param float $preco Preço do produto
     */
    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->preco = $preco;
    }
    
    /**
     * Método para exibir informações do produto
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        return "Produto: {$this->nome} - Preço: R$ " . number_format($this->preco, 2, ',', '.');
    }
    
    /**
     * Método para calcular preço com desconto
     * @param float $percentual Percentual de desconto
     * @return float Preço com desconto
     */
    public function calcularDesconto($percentual) {
        return $this->preco * (1 - $percentual / 100);
    }
}
?>
