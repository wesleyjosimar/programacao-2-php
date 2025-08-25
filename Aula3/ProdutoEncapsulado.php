<?php
/**
 * Classe ProdutoEncapsulado - Exercício 2
 * Demonstração de encapsulamento com atributos privados e métodos get/set
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class ProdutoEncapsulado {
    // Atributos com diferentes níveis de acesso
    public $nome;           // Público - acesso direto permitido
    private $preco;         // Privado - acesso apenas através de métodos
    
    /**
     * Construtor da classe
     * @param string $nome Nome do produto
     * @param float $preco Preço do produto
     */
    public function __construct($nome, $preco) {
        $this->nome = $nome;
        $this->setPreco($preco); // Usa o setter para validação
    }
    
    /**
     * Método getter para o preço
     * @return float Preço do produto
     */
    public function getPreco() {
        return $this->preco;
    }
    
    /**
     * Método setter para o preço com validação
     * @param float $preco Novo preço
     * @return bool True se o preço foi definido com sucesso
     */
    public function setPreco($preco) {
        // Validação: preço deve ser positivo
        if ($preco >= 0) {
            $this->preco = $preco;
            return true;
        } else {
            throw new InvalidArgumentException("O preço deve ser um valor positivo!");
        }
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
        if ($percentual < 0 || $percentual > 100) {
            throw new InvalidArgumentException("Percentual de desconto deve estar entre 0 e 100!");
        }
        return $this->preco * (1 - $percentual / 100);
    }
    
    /**
     * Método para aplicar desconto ao preço atual
     * @param float $percentual Percentual de desconto
     * @return bool True se o desconto foi aplicado
     */
    public function aplicarDesconto($percentual) {
        try {
            $novoPreco = $this->calcularDesconto($percentual);
            return $this->setPreco($novoPreco);
        } catch (Exception $e) {
            return false;
        }
    }
    
    /**
     * Método para aumentar o preço
     * @param float $percentual Percentual de aumento
     * @return bool True se o aumento foi aplicado
     */
    public function aumentarPreco($percentual) {
        if ($percentual > 0) {
            $novoPreco = $this->preco * (1 + $percentual / 100);
            return $this->setPreco($novoPreco);
        }
        return false;
    }
}
?>
