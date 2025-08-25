<?php
/**
 * Classe Cliente - Exercício 8
 * Demonstração de diferentes níveis de acesso aos atributos
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class Cliente {
    // Atributos com diferentes níveis de acesso
    public $nome;            // Público - acessível de qualquer lugar
    protected $cpf;          // Protegido - acessível na classe e subclasses
    private $telefone;       // Privado - acessível apenas na classe atual
    
    /**
     * Construtor da classe
     * @param string $nome Nome do cliente
     * @param string $cpf CPF do cliente
     * @param string $telefone Telefone do cliente
     */
    public function __construct($nome, $cpf, $telefone) {
        $this->nome = $nome;
        $this->setCpf($cpf);
        $this->setTelefone($telefone);
    }
    
    /**
     * Método para obter o CPF (getter público)
     * @return string CPF do cliente
     */
    public function getCpf() {
        return $this->cpf;
    }
    
    /**
     * Método para definir o CPF (setter protegido)
     * @param string $cpf CPF do cliente
     * @return bool True se o CPF foi definido com sucesso
     */
    protected function setCpf($cpf) {
        // Validação básica de CPF
        $cpf = preg_replace('/[^0-9]/', '', $cpf);
        if (strlen($cpf) == 11) {
            $this->cpf = $cpf;
            return true;
        }
        return false;
    }
    
    /**
     * Método para obter o telefone (getter público)
     * @return string Telefone do cliente
     */
    public function getTelefone() {
        return $this->telefone;
    }
    
    /**
     * Método para definir o telefone (setter privado)
     * @param string $telefone Telefone do cliente
     * @return bool True se o telefone foi definido com sucesso
     */
    private function setTelefone($telefone) {
        // Validação básica de telefone
        $telefone = preg_replace('/[^0-9]/', '', $telefone);
        if (strlen($telefone) >= 10) {
            $this->telefone = $telefone;
            return true;
        }
        return false;
    }
    
    /**
     * Método para exibir informações do cliente
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        return "Cliente: {$this->nome} | CPF: {$this->cpf} | Telefone: {$this->telefone}";
    }
    
    /**
     * Método para exibir informações públicas (sem dados sensíveis)
     * @return string Informações públicas
     */
    public function exibirInfoPublica() {
        return "Cliente: {$this->nome}";
    }
    
    /**
     * Método para validar CPF
     * @return bool True se o CPF for válido
     */
    public function validarCpf() {
        $cpf = $this->cpf;
        
        // Verifica se tem 11 dígitos
        if (strlen($cpf) != 11) {
            return false;
        }
        
        // Verifica se todos os dígitos são iguais
        if (preg_match('/^(\d)\1+$/', $cpf)) {
            return false;
        }
        
        // Calcula os dígitos verificadores
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Método para formatar CPF para exibição
     * @return string CPF formatado
     */
    public function getCpfFormatado() {
        $cpf = $this->cpf;
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
    
    /**
     * Método para formatar telefone para exibição
     * @return string Telefone formatado
     */
    public function getTelefoneFormatado() {
        $telefone = $this->telefone;
        if (strlen($telefone) == 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } elseif (strlen($telefone) == 10) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        }
        return $telefone;
    }
    
    /**
     * Método para alterar telefone (método público que usa setter privado)
     * @param string $novoTelefone Novo telefone
     * @return bool True se o telefone foi alterado
     */
    public function alterarTelefone($novoTelefone) {
        return $this->setTelefone($novoTelefone);
    }
    
    /**
     * Método para alterar CPF (método público que usa setter protegido)
     * @param string $novoCpf Novo CPF
     * @return bool True se o CPF foi alterado
     */
    public function alterarCpf($novoCpf) {
        return $this->setCpf($novoCpf);
    }
}

/**
 * Classe ClienteVip que herda de Cliente
 * Demonstra acesso a atributos protegidos
 */
class ClienteVip extends Cliente {
    private $pontos;
    private $nivel;
    
    /**
     * Construtor da classe
     * @param string $nome Nome do cliente
     * @param string $cpf CPF do cliente
     * @param string $telefone Telefone do cliente
     */
    public function __construct($nome, $cpf, $telefone) {
        parent::__construct($nome, $cpf, $telefone);
        $this->pontos = 0;
        $this->nivel = 'Bronze';
    }
    
    /**
     * Método para obter pontos do cliente VIP
     * @return int Pontos do cliente
     */
    public function getPontos() {
        return $this->pontos;
    }
    
    /**
     * Método para obter nível do cliente VIP
     * @return string Nível do cliente
     */
    public function getNivel() {
        return $this->nivel;
    }
    
    /**
     * Método para adicionar pontos
     * @param int $pontos Pontos a serem adicionados
     */
    public function adicionarPontos($pontos) {
        if ($pontos > 0) {
            $this->pontos += $pontos;
            $this->atualizarNivel();
        }
    }
    
    /**
     * Método para atualizar nível baseado nos pontos
     */
    private function atualizarNivel() {
        if ($this->pontos >= 1000) {
            $this->nivel = 'Diamante';
        } elseif ($this->pontos >= 500) {
            $this->nivel = 'Ouro';
        } elseif ($this->pontos >= 100) {
            $this->nivel = 'Prata';
        } else {
            $this->nivel = 'Bronze';
        }
    }
    
    /**
     * Método para exibir informações do cliente VIP
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        $info = parent::exibirInfo();
        $info .= " | Pontos: {$this->pontos} | Nível: {$this->nivel}";
        return $info;
    }
    
    /**
     * Método para obter CPF formatado (acesso ao atributo protegido)
     * @return string CPF formatado
     */
    public function getCpfFormatado() {
        $cpf = $this->cpf; // Acesso ao atributo protegido da classe pai
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }
}
?>
