<?php
/**
 * Script para executar exercícios PHP e retornar resultados
 * Este arquivo é chamado pela interface web para executar os exercícios
 */

// Configurações de cabeçalho
header('Content-Type: text/plain; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

// Verificar se o arquivo foi especificado
if (!isset($_GET['file'])) {
    http_response_code(400);
    echo "❌ Erro: Arquivo não especificado!";
    exit;
}

$filename = $_GET['file'];

// Lista de arquivos permitidos (segurança)
$allowedFiles = [
    'exercicio1_conta.php',
    'exercicio2_aluno.php',
    'exercicio3_livro.php'
];

// Verificar se o arquivo é permitido
if (!in_array($filename, $allowedFiles)) {
    http_response_code(403);
    echo "❌ Erro: Arquivo não permitido!";
    exit;
}

// Verificar se o arquivo existe
if (!file_exists($filename)) {
    http_response_code(404);
    echo "❌ Erro: Arquivo não encontrado: {$filename}";
    exit;
}

try {
    // Capturar a saída do PHP
    ob_start();
    
    // Incluir e executar o arquivo
    include $filename;
    
    // Capturar a saída
    $output = ob_get_contents();
    ob_end_clean();
    
    // Limpar a saída (remover tags PHP e HTML se houver)
    $output = strip_tags($output);
    
    // Adicionar informações sobre o arquivo executado
            $fileInfo = "Arquivo executado: {$filename}\n";
    $fileInfo .= "⏰ Data/Hora: " . date('d/m/Y H:i:s') . "\n";
    $fileInfo .= "🔧 PHP Version: " . PHP_VERSION . "\n";
    $fileInfo .= "=" . str_repeat("=", 50) . "\n\n";
    
    // Retornar resultado
    echo $fileInfo . $output;
    
} catch (Exception $e) {
    http_response_code(500);
    echo "❌ Erro ao executar exercício:\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
} catch (Error $e) {
    http_response_code(500);
    echo "❌ Erro fatal ao executar exercício:\n";
    echo "Mensagem: " . $e->getMessage() . "\n";
    echo "Arquivo: " . $e->getFile() . "\n";
    echo "Linha: " . $e->getLine() . "\n";
}
?>
