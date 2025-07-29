<?php
// ============================================
// EXEMPLO: Código Estruturado → Orientado a Objetos
// ============================================

// CÓDIGO ESTRUTURADO (ANTES)
echo "=== CÓDIGO ESTRUTURADO ===\n";
$preco = 100;
$desconto = 0.1;
$final = $preco - ($preco * $desconto);
echo "Resultado: " . $final . "\n\n";

// CÓDIGO ORIENTADO A OBJETOS (DEPOIS)
echo "=== CÓDIGO ORIENTADO A OBJETOS ===\n";

class Produto {
    public $preco;
    public $desconto;

    public function precoFinal() {
        return $this->preco - ($this->preco * $this->desconto);
    }
}

// Uso da classe
$camiseta = new Produto();
$camiseta->preco = 100;
$camiseta->desconto = 0.1;
echo "Resultado: " . $camiseta->precoFinal() . "\n\n";

echo "=== VANTAGENS DA ORIENTAÇÃO A OBJETOS ===\n";
echo "✓ Código mais organizado\n";
echo "✓ Fácil de reutilizar\n";
echo "✓ Dados e comportamentos agrupados\n";
echo "✓ Mais fácil de manter\n";
?> 