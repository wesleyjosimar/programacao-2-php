<?php
/**
 * Classe Usuario - Exercício 5
 * Demonstração de encapsulamento com verificação de senha
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class Usuario {
    // Atributos com diferentes níveis de acesso
    private $id;
    private $nome;
    private $email;
    private $senha;          // Senha privada - nunca exposta
    private $dataCadastro;
    private $ativo;
    
    /**
     * Construtor da classe
     * @param string $nome Nome do usuário
     * @param string $email Email do usuário
     * @param string $senha Senha do usuário
     */
    public function __construct($nome, $email, $senha) {
        $this->id = uniqid('user_');
        $this->nome = $nome;
        $this->email = $email;
        $this->setSenha($senha); // Usa o setter para hash da senha
        $this->dataCadastro = date('Y-m-d H:i:s');
        $this->ativo = true;
    }
    
    /**
     * Método para definir a senha com hash
     * @param string $senha Nova senha
     * @return bool True se a senha foi definida com sucesso
     */
    private function setSenha($senha) {
        if (strlen($senha) >= 6) {
            // Hash da senha usando password_hash (PHP 5.5+)
            $this->senha = password_hash($senha, PASSWORD_DEFAULT);
            return true;
        }
        return false;
    }
    
    /**
     * Método para verificar se uma senha está correta
     * @param string $senha Senha a ser verificada
     * @return bool True se a senha estiver correta
     */
    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }
    
    /**
     * Método para alterar a senha
     * @param string $senhaAtual Senha atual para confirmação
     * @param string $novaSenha Nova senha
     * @return bool True se a senha foi alterada com sucesso
     */
    public function alterarSenha($senhaAtual, $novaSenha) {
        if ($this->verificarSenha($senhaAtual)) {
            return $this->setSenha($novaSenha);
        }
        return false;
    }
    
    /**
     * Método para obter o ID do usuário
     * @return string ID do usuário
     */
    public function getId() {
        return $this->id;
    }
    
    /**
     * Método para obter o nome do usuário
     * @return string Nome do usuário
     */
    public function getNome() {
        return $this->nome;
    }
    
    /**
     * Método para obter o email do usuário
     * @return string Email do usuário
     */
    public function getEmail() {
        return $this->email;
    }
    
    /**
     * Método para obter a data de cadastro
     * @return string Data de cadastro
     */
    public function getDataCadastro() {
        return $this->dataCadastro;
    }
    
    /**
     * Método para verificar se o usuário está ativo
     * @return bool True se o usuário estiver ativo
     */
    public function isAtivo() {
        return $this->ativo;
    }
    
    /**
     * Método para ativar/desativar o usuário
     * @param bool $ativo Status de ativação
     */
    public function setAtivo($ativo) {
        $this->ativo = (bool) $ativo;
    }
    
    /**
     * Método para exibir informações do usuário (sem senha)
     * @return string Informações formatadas
     */
    public function exibirInfo() {
        $status = $this->ativo ? "Ativo" : "Inativo";
        return "Usuário: {$this->nome} | Email: {$this->email} | Status: {$status} | ID: {$this->id}";
    }
    
    /**
     * Método para autenticar o usuário
     * @param string $email Email para autenticação
     * @param string $senha Senha para autenticação
     * @return bool True se a autenticação for bem-sucedida
     */
    public function autenticar($email, $senha) {
        if ($this->email === $email && $this->verificarSenha($senha) && $this->ativo) {
            return true;
        }
        return false;
    }
    
    /**
     * Método para gerar token de recuperação de senha
     * @return string Token único para recuperação
     */
    public function gerarTokenRecuperacao() {
        $token = bin2hex(random_bytes(32));
        // Em um sistema real, este token seria armazenado no banco
        return $token;
    }
    
    /**
     * Método para validar força da senha
     * @param string $senha Senha a ser validada
     * @return array Array com informações sobre a força da senha
     */
    public static function validarForcaSenha($senha) {
        $forca = 0;
        $mensagens = [];
        
        if (strlen($senha) >= 8) {
            $forca += 2;
        } else {
            $mensagens[] = "Senha deve ter pelo menos 8 caracteres";
        }
        
        if (preg_match('/[a-z]/', $senha)) {
            $forca += 1;
        } else {
            $mensagens[] = "Senha deve conter pelo menos uma letra minúscula";
        }
        
        if (preg_match('/[A-Z]/', $senha)) {
            $forca += 1;
        } else {
            $mensagens[] = "Senha deve conter pelo menos uma letra maiúscula";
        }
        
        if (preg_match('/[0-9]/', $senha)) {
            $forca += 1;
        } else {
            $mensagens[] = "Senha deve conter pelo menos um número";
        }
        
        if (preg_match('/[^a-zA-Z0-9]/', $senha)) {
            $forca += 1;
        } else {
            $mensagens[] = "Senha deve conter pelo menos um caractere especial";
        }
        
        $nivel = "";
        if ($forca <= 2) $nivel = "Fraca";
        elseif ($forca <= 4) $nivel = "Média";
        else $nivel = "Forte";
        
        return [
            'forca' => $forca,
            'nivel' => $nivel,
            'mensagens' => $mensagens
        ];
    }
}
?>
