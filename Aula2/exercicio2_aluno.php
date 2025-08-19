<?php
/**
 * Exercício 2: Modificadores de Acesso na Classe Aluno
 * 
 * Crie uma classe Aluno com os seguintes requisitos de acesso:
 * - $nome: Public (pode ser lido e alterado)
 * - $matricula: Somente leitura (privado com getter)
 * - $notas: Privado (acessível apenas por métodos)
 * - $media: Privado (calculado internamente)
 */

class Aluno {
    // Atributos com diferentes níveis de acesso
    public $nome;                    // Público - pode ser lido e alterado
    private $matricula;              // Privado - só acessível por getter
    private $notas = [];             // Privado - acessível apenas por métodos
    private $media = 0;              // Privado - calculado internamente
    
    // Construtor para inicializar nome e matrícula
    public function __construct($nome, $matricula) {
        $this->nome = $nome;
        $this->matricula = $matricula;
    }
    
    // Getter para matrícula (somente leitura)
    public function getMatricula() {
        return $this->matricula;
    }
    
    // Método para adicionar nota à lista
    public function adicionarNota($nota) {
        if ($nota >= 0 && $nota <= 10) {
            $this->notas[] = $nota;
            $this->calcularMedia(); // Recalcula a média automaticamente
            return "Nota {$nota} adicionada com sucesso!\n";
        } else {
            return "Nota inválida! Deve estar entre 0 e 10.\n";
        }
    }
    
    // Método privado para calcular média
    private function calcularMedia() {
        if (count($this->notas) > 0) {
            $this->media = array_sum($this->notas) / count($this->notas);
        } else {
            $this->media = 0;
        }
    }
    
    // Método para retornar situação (Aprovado ou Reprovado)
    public function situacao() {
        if ($this->media >= 7.0) {
            return "Aprovado";
        } else {
            return "Reprovado";
        }
    }
    
    // Método para exibir dados do aluno
    public function exibirDados() {
        $this->calcularMedia(); // Garante que a média está atualizada
        
        $dados = "=== DADOS DO ALUNO ===\n";
        $dados .= "Nome: {$this->nome}\n";
        $dados .= "Matrícula: {$this->matricula}\n";
        $dados .= "Notas: " . implode(", ", $this->notas) . "\n";
        $dados .= "Média: " . number_format($this->media, 1) . "\n";
        $dados .= "Situação: {$this->situacao()}\n";
        $dados .= "========================\n";
        
        return $dados;
    }
    
    // Getter para média (para demonstração)
    public function getMedia() {
        return $this->media;
    }
}

// Teste da implementação
echo "=== TESTE DA CLASSE ALUNO ===\n\n";

// Criando dois alunos
$aluno1 = new Aluno("João Silva", "2024001");
$aluno2 = new Aluno("Maria Santos", "2024002");

// Adicionando notas diferentes para cada aluno
echo "Adicionando notas para João Silva:\n";
echo $aluno1->adicionarNota(8.5);
echo $aluno1->adicionarNota(7.0);
echo $aluno1->adicionarNota(9.0);

echo "\nAdicionando notas para Maria Santos:\n";
echo $aluno2->adicionarNota(6.0);
echo $aluno2->adicionarNota(5.5);
echo $aluno2->adicionarNota(7.5);

// Exibindo dados e verificando situação de cada um
echo "\n" . $aluno1->exibirDados();
echo $aluno2->exibirDados();

// Testando modificadores de acesso
echo "=== TESTANDO MODIFICADORES DE ACESSO ===\n";
echo "Nome (público): " . $aluno1->nome . "\n";
echo "Matrícula (via getter): " . $aluno1->getMatricula() . "\n";
echo "Média (via getter): " . $aluno1->getMedia() . "\n";

// Tentativa de acessar atributos privados (comentado para evitar erro)
// echo $aluno1->matricula; // Isso causaria erro
// echo $aluno1->notas;     // Isso causaria erro
// echo $aluno1->media;     // Isso causaria erro
?>
