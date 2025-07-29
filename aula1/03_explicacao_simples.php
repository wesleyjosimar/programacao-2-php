<?php
// ============================================
// EXPLICAÇÃO SIMPLES: Estruturado vs Orientado a Objetos
// ============================================

echo "=== COMPARAÇÃO: CÓDIGO ESTRUTURADO vs ORIENTADO A OBJETOS ===\n\n";

echo "1. CÓDIGO ESTRUTURADO (ANTES):\n";
echo "   - Variáveis soltas no código\n";
echo "   - Operações sequenciais\n";
echo "   - Difícil de reutilizar\n";
echo "   - Sem organização clara\n\n";

// Exemplo de código estruturado
$preco = 100;
$desconto = 0.1;
$final = $preco - ($preco * $desconto);
echo "   Resultado estruturado: " . $final . "\n\n";

echo "2. CÓDIGO ORIENTADO A OBJETOS (DEPOIS):\n";
echo "   - Dados organizados em classes\n";
echo "   - Comportamentos em métodos\n";
echo "   - Fácil de reutilizar\n";
echo "   - Código mais organizado\n\n";

// Exemplo de código orientado a objetos
class Produto {
    public $preco;
    public $desconto;

    public function precoFinal() {
        return $this->preco - ($this->preco * $this->desconto);
    }
}

$camiseta = new Produto();
$camiseta->preco = 100;
$camiseta->desconto = 0.1;
echo "   Resultado OO: " . $camiseta->precoFinal() . "\n\n";

echo "=== O QUE MUDOU ===\n";
echo "1. Criamos uma classe chamada 'Produto'\n";
echo "2. Colocamos os dados (preco e desconto) dentro da classe\n";
echo "3. Criamos um método 'precoFinal()' que faz o cálculo\n";
echo "4. Agora podemos criar vários produtos diferentes\n";
echo "5. O código fica mais organizado e fácil de entender\n\n";

echo "=== EXEMPLO DE REUTILIZAÇÃO ===\n";
$calca = new Produto();
$calca->preco = 150;
$calca->desconto = 0.2;
echo "Calça com 20% de desconto: R$ " . $calca->precoFinal() . "\n";

$tenis = new Produto();
$tenis->preco = 200;
$tenis->desconto = 0.15;
echo "Tênis com 15% de desconto: R$ " . $tenis->precoFinal() . "\n";
?> 