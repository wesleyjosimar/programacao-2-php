<?php
// Arquivo para exibir código fonte das classes
$arquivo = isset($_GET['arquivo']) ? $_GET['arquivo'] : '';

if (empty($arquivo) || !file_exists($arquivo)) {
    echo "<h1>Arquivo não encontrado</h1>";
    echo "<p><a href='index.html'>← Voltar ao Menu</a></p>";
    exit;
}

$conteudo = file_get_contents($arquivo);
$nomeArquivo = basename($arquivo);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Código - <?php echo $nomeArquivo; ?></title>
    <style>
        body {
            font-family: 'Courier New', monospace;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
            background: #1e1e1e;
            color: #d4d4d4;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            background: #2c3e50;
            color: white;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 1.5em;
        }
        .header p {
            margin: 5px 0 0 0;
            opacity: 0.8;
        }
        .nav {
            margin-bottom: 20px;
        }
        .nav a {
            display: inline-block;
            background: #007bff;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 4px;
            margin-right: 10px;
        }
        .nav a:hover {
            background: #0056b3;
        }
        .code-container {
            background: #252526;
            border: 1px solid #3c3c3c;
            border-radius: 5px;
            overflow-x: auto;
        }
        .code-header {
            background: #3c3c3c;
            padding: 10px 15px;
            border-bottom: 1px solid #3c3c3c;
            font-weight: bold;
        }
        .code-content {
            padding: 15px;
            white-space: pre;
            font-size: 14px;
        }
        .line-numbers {
            color: #858585;
            user-select: none;
        }
        .keyword { color: #569cd6; }
        .string { color: #ce9178; }
        .comment { color: #6a9955; }
        .function { color: #dcdcaa; }
        .variable { color: #9cdcfe; }
        .number { color: #b5cea8; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Código Fonte: <?php echo $nomeArquivo; ?></h1>
            <p>Visualização do código da classe para estudo e análise</p>
        </div>
        
        <div class="nav">
            <a href="index.html">← Voltar ao Menu</a>
            <a href="CRITERIOS_AVALIACAO.md">Ver Critérios</a>
        </div>
        
        <div class="code-container">
            <div class="code-header">
                <?php echo $nomeArquivo; ?> - Código Completo
            </div>
            <div class="code-content">
<?php
// Aplicar syntax highlighting básico
$conteudo = htmlspecialchars($conteudo);
$conteudo = preg_replace('/\b(public|private|protected|class|function|extends|new|return|if|else|foreach|for|while|try|catch|throw|Exception)\b/', '<span class="keyword">$1</span>', $conteudo);
$conteudo = preg_replace('/\b(\$[a-zA-Z_][a-zA-Z0-9_]*)\b/', '<span class="variable">$1</span>', $conteudo);
$conteudo = preg_replace('/\b([a-zA-Z_][a-zA-Z0-9_]*)\s*\(/', '<span class="function">$1</span>(', $conteudo);
$conteudo = preg_replace('/"([^"]*)"/', '<span class="string">"$1"</span>', $conteudo);
$conteudo = preg_replace('/\'([^\']*)\'/', '<span class="string">\'$1\'</span>', $conteudo);
$conteudo = preg_replace('/\/\/(.*)$/m', '<span class="comment">//$1</span>', $conteudo);
$conteudo = preg_replace('/\b(\d+)\b/', '<span class="number">$1</span>', $conteudo);

echo $conteudo;
?>
            </div>
        </div>
        
        <div class="nav" style="margin-top: 20px;">
            <a href="index.html">← Voltar ao Menu</a>
            <a href="CRITERIOS_AVALIACAO.md">Ver Critérios</a>
        </div>
    </div>
</body>
</html>
