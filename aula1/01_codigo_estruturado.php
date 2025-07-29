<?php
// ============================================
// CÓDIGO ESTRUTURADO (ANTES)
// ============================================

// Variáveis independentes
$preco = 100;
$desconto = 0.1;

// Cálculo sequencial
$final = $preco - ($preco * $desconto);

// Exibição do resultado
echo "Preço original: R$ " . $preco . "\n";
echo "Desconto: " . ($desconto * 100) . "%\n";
echo "Preço final: R$ " . $final . "\n";

// Resultado: 90
?> 