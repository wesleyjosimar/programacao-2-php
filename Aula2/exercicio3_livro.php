<?php
/**
 * Exercício 3: Getters e Setters na Classe Livro
 * 
 * Implemente uma classe Livro com getters e setters que façam validações:
 * - Ano de publicação não pode ser futuro
 * - Número de páginas deve ser positivo
 * - Título e autor não podem ser vazios
 */

class Livro {
    // Atributos privados
    private $titulo;
    private $autor;
    private $anoPublicacao;
    private $numeroPaginas;
    private $disponivel;
    
    // Construtor
    public function __construct() {
        $this->disponivel = false; // Por padrão, livro não está disponível
    }
    
    // Getters
    public function getTitulo() {
        return $this->titulo;
    }
    
    public function getAutor() {
        return $this->autor;
    }
    
    public function getAnoPublicacao() {
        return $this->anoPublicacao;
    }
    
    public function getNumeroPaginas() {
        return $this->numeroPaginas;
    }
    
    public function getDisponivel() {
        return $this->disponivel ? "Sim" : "Não";
    }
    
    // Setters com validações
    public function setTitulo($titulo) {
        if (empty(trim($titulo))) {
            throw new Exception("Título não pode ser vazio!");
        }
        $this->titulo = trim($titulo);
    }
    
    public function setAutor($autor) {
        if (empty(trim($autor))) {
            throw new Exception("Autor não pode ser vazio!");
        }
        $this->autor = trim($autor);
    }
    
    public function setAnoPublicacao($ano) {
        $anoAtual = date('Y');
        if ($ano > $anoAtual) {
            throw new Exception("Ano de publicação não pode ser futuro! Ano atual: {$anoAtual}");
        }
        if ($ano < 1000 || $ano > $anoAtual) {
            throw new Exception("Ano de publicação deve estar entre 1000 e {$anoAtual}");
        }
        $this->anoPublicacao = $ano;
    }
    
    public function setNumeroPaginas($paginas) {
        if (!is_numeric($paginas) || $paginas <= 0) {
            throw new Exception("Número de páginas deve ser um valor positivo!");
        }
        $this->numeroPaginas = (int)$paginas;
    }
    
    public function setDisponivel($disponivel) {
        $this->disponivel = (bool)$disponivel;
    }
    
    // Método para exibir dados do livro
    public function exibirDados() {
        $dados = "=== DADOS DO LIVRO ===\n";
        $dados .= "Título: " . ($this->titulo ?? "Não definido") . "\n";
        $dados .= "Autor: " . ($this->autor ?? "Não definido") . "\n";
        $dados .= "Ano de Publicação: " . ($this->anoPublicacao ?? "Não definido") . "\n";
        $dados .= "Número de Páginas: " . ($this->numeroPaginas ?? "Não definido") . "\n";
        $dados .= "Disponível: " . $this->getDisponivel() . "\n";
        $dados .= "========================\n";
        
        return $dados;
    }
}

// Teste da implementação
echo "=== TESTE DA CLASSE LIVRO ===\n\n";

try {
    // Criando um livro e testando os setters
    $livro = new Livro();
    
    echo "Configurando dados do livro:\n";
    $livro->setTitulo("Dom Casmurro");
    $livro->setAutor("Machado de Assis");
    $livro->setAnoPublicacao(1899);
    $livro->setNumeroPaginas(256);
    $livro->setDisponivel(true);
    
    // Exibindo dados
    echo $livro->exibirDados();
    
    // Testando getters
    echo "=== TESTANDO GETTERS ===\n";
    echo "Título: " . $livro->getTitulo() . "\n";
    echo "Autor: " . $livro->getAutor() . "\n";
    echo "Ano: " . $livro->getAnoPublicacao() . "\n";
    echo "Páginas: " . $livro->getNumeroPaginas() . "\n";
    echo "Disponível: " . $livro->getDisponivel() . "\n\n";
    
    // Teste de validação - ano futuro
    echo "=== TESTANDO VALIDAÇÕES ===\n";
    try {
        $livro->setAnoPublicacao(2030);
        echo "Ano 2030 definido com sucesso\n";
    } catch (Exception $e) {
        echo "Erro ao definir ano 2030: " . $e->getMessage() . "\n";
    }
    
    // Teste de validação - título vazio
    try {
        $livro->setTitulo("");
        echo "Título vazio definido com sucesso\n";
    } catch (Exception $e) {
        echo "Erro ao definir título vazio: " . $e->getMessage() . "\n";
    }
    
    // Teste de validação - páginas negativas
    try {
        $livro->setNumeroPaginas(-50);
        echo "Páginas negativas definidas com sucesso\n";
    } catch (Exception $e) {
        echo "Erro ao definir páginas negativas: " . $e->getMessage() . "\n";
    }
    
    // Teste de validação - autor vazio
    try {
        $livro->setAutor("   ");
        echo "Autor vazio definido com sucesso\n";
    } catch (Exception $e) {
        echo "Erro ao definir autor vazio: " . $e->getMessage() . "\n";
    }
    
} catch (Exception $e) {
    echo "Erro geral: " . $e->getMessage() . "\n";
}

echo "\n=== FIM DOS TESTES ===\n";
?>
