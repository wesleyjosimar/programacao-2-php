<?php
/**
 * Classe Funcionario e Gerente - Exercício 4
 * Demonstração de herança com atributo protegido
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class Funcionario {
    // Atributos com diferentes níveis de acesso
    protected $nome;         // Protegido - acessível por subclasses
    protected $salario;      // Protegido - acessível por subclasses
    protected $cargo;        // Protegido - acessível por subclasses
    private $dataAdmissao;   // Privado - apenas na classe atual
    public $matricula;       // Público - acessível de qualquer lugar
    
    /**
     * Construtor da classe Funcionario
     * @param string $nome Nome do funcionário
     * @param float $salario Salário inicial
     * @param string $cargo Cargo do funcionário
     * @param string $matricula Matrícula do funcionário
     */
    public function __construct($nome, $salario, $cargo, $matricula) {
        $this->nome = $nome;
        $this->setSalario($salario);
        $this->cargo = $cargo;
        $this->matricula = $matricula;
        $this->dataAdmissao = date('Y-m-d');
    }
    
    /**
     * Método para obter o nome do funcionário
     * @return string Nome do funcionário
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * Método para obter o salário do funcionário
     * @return float Salário atual
     */
    public function getSalario() {
        return $this->salario;
    }
    
    /**
     * Método para obter o cargo do funcionário
     * @return string Cargo atual
     */
    public function getCargo() {
        return $this->cargo;
    }
    
    /**
     * Método para obter a data de admissão
     * @return string Data de admissão
     */
    public function getDataAdmissao() {
        return $this->dataAdmissao;
    }
    
    /**
     * Método para definir o salário (com validação básica)
     * @param float $salario Novo salário
     * @return bool True se o salário foi definido com sucesso
     */
    protected function setSalario($salario) {
        if ($salario >= 0) {
            $this->salario = $salario;
            return true;
        }
        return false;
    }
    
    /**
     * Método para calcular o salário líquido (pode ser sobrescrito)
     * @return float Salário líquido
     */
    public function calcularSalarioLiquido() {
        // Simulação de desconto de 10% para impostos
        return $this->salario * 0.9;
    }
    
    /**
     * Método para exibir informações do funcionário
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        return "Funcionário: {$this->nome} | Cargo: {$this->cargo} | Salário: R$ " . number_format($this->salario, 2, ',', '.') . " | Matrícula: {$this->matricula}";
    }
    
    /**
     * Método para trabalhar (pode ser sobrescrito)
     * @return string Mensagem de trabalho
     */
    public function trabalhar() {
        return "{$this->nome} está trabalhando como {$this->cargo}";
    }
}

/**
 * Classe Gerente que herda de Funcionario
 * Demonstra acesso a atributos protegidos da classe pai
 */
class Gerente extends Funcionario {
    // Atributos específicos do gerente
    private $departamento;
    private $bonusGerencia;
    
    /**
     * Construtor da classe Gerente
     * @param string $nome Nome do gerente
     * @param float $salario Salário inicial
     * @param string $departamento Departamento sob gerência
     * @param string $matricula Matrícula do gerente
     */
    public function __construct($nome, $salario, $departamento, $matricula) {
        // Chama o construtor da classe pai
        parent::__construct($nome, $salario, "Gerente", $matricula);
        $this->departamento = $departamento;
        $this->bonusGerencia = $salario * 0.2; // 20% de bônus
    }
    
    /**
     * Método para obter o departamento
     * @return string Departamento sob gerência
     */
    public function getDepartamento() {
        return $this->departamento;
    }
    
    /**
     * Método para obter o bônus de gerência
     * @return float Bônus de gerência
     */
    public function getBonusGerencia() {
        return $this->bonusGerencia;
    }
    
    /**
     * Método para definir o salário (sobrescreve o método da classe pai)
     * @param float $salario Novo salário
     * @return bool True se o salário foi definido com sucesso
     */
    public function setSalario($salario) {
        if (parent::setSalario($salario)) {
            // Atualiza o bônus baseado no novo salário
            $this->bonusGerencia = $salario * 0.2;
            return true;
        }
        return false;
    }
    
    /**
     * Método para aumentar o salário
     * @param float $percentual Percentual de aumento
     * @return bool True se o aumento foi aplicado
     */
    public function aumentarSalario($percentual) {
        if ($percentual > 0) {
            $novoSalario = $this->salario * (1 + $percentual / 100);
            return $this->setSalario($novoSalario);
        }
        return false;
    }
    
    /**
     * Método para calcular o salário líquido (sobrescreve o método da classe pai)
     * @return float Salário líquido com bônus
     */
    public function calcularSalarioLiquido() {
        $salarioComBonus = $this->salario + $this->bonusGerencia;
        // Simulação de desconto de 12% para impostos (gerentes pagam mais impostos)
        return $salarioComBonus * 0.88;
    }
    
    /**
     * Método para exibir informações do gerente
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        $info = parent::exibirInfo(); // Chama o método da classe pai
        $info .= " | Departamento: {$this->departamento} | Bônus: R$ " . number_format($this->bonusGerencia, 2, ',', '.');
        return $info;
    }
    
    /**
     * Método para trabalhar (sobrescreve o método da classe pai)
     * @return string Mensagem de trabalho específica do gerente
     */
    public function trabalhar() {
        return "{$this->nome} está gerenciando o departamento {$this->departamento}";
    }
    
    /**
     * Método para gerenciar equipe
     * @param int $quantidadeFuncionarios Quantidade de funcionários na equipe
     * @return string Mensagem de gerenciamento
     */
    public function gerenciarEquipe($quantidadeFuncionarios) {
        return "{$this->nome} está gerenciando uma equipe de {$quantidadeFuncionarios} funcionários no departamento {$this->departamento}";
    }
}
?>
