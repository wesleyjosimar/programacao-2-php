<?php
/**
 * Classe Config e Subclasses - Exercício 6
 * Demonstração de herança com atributo protegido parametros
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class Config {
    // Atributo protegido - acessível por subclasses
    protected $parametros;
    
    /**
     * Construtor da classe
     * @param array $parametrosIniciais Parâmetros iniciais
     */
    public function __construct($parametrosIniciais = []) {
        $this->parametros = $parametrosIniciais;
    }
    
    /**
     * Método para obter todos os parâmetros
     * @return array Todos os parâmetros
     */
    public function getParametros() {
        return $this->parametros;
    }
    
    /**
     * Método para obter um parâmetro específico
     * @param string $chave Chave do parâmetro
     * @param mixed $padrao Valor padrão se não existir
     * @return mixed Valor do parâmetro
     */
    public function getParametro($chave, $padrao = null) {
        return isset($this->parametros[$chave]) ? $this->parametros[$chave] : $padrao;
    }
    
    /**
     * Método para verificar se um parâmetro existe
     * @param string $chave Chave do parâmetro
     * @return bool True se o parâmetro existir
     */
    public function temParametro($chave) {
        return isset($this->parametros[$chave]);
    }
    
    /**
     * Método para obter o número de parâmetros
     * @return int Número de parâmetros
     */
    public function getNumeroParametros() {
        return count($this->parametros);
    }
}

/**
 * Classe ConfigLeitura - Apenas para leitura de parâmetros
 */
class ConfigLeitura extends Config {
    /**
     * Construtor - não permite modificação
     * @param array $parametros Parâmetros somente leitura
     */
    public function __construct($parametros) {
        parent::__construct($parametros);
    }
    
    /**
     * Método para exibir todos os parâmetros de forma legível
     * @return string Parâmetros formatados
     */
    public function exibirParametros() {
        $saida = "<h4>Parâmetros de Configuração (Somente Leitura)</h4>";
        $saida .= "<p><strong>Total de parâmetros:</strong> {$this->getNumeroParametros()}</p>";
        
        if (empty($this->parametros)) {
            $saida .= "<p>Nenhum parâmetro configurado.</p>";
        } else {
            $saida .= "<ul>";
            foreach ($this->parametros as $chave => $valor) {
                $tipo = gettype($valor);
                $valorFormatado = is_array($valor) ? json_encode($valor) : $valor;
                $saida .= "<li><strong>{$chave}:</strong> {$valorFormatado} ({$tipo})</li>";
            }
            $saida .= "</ul>";
        }
        
        return $saida;
    }
    
    /**
     * Método para validar se todos os parâmetros obrigatórios estão presentes
     * @param array $parametrosObrigatorios Lista de parâmetros obrigatórios
     * @return array Array com resultado da validação
     */
    public function validarParametrosObrigatorios($parametrosObrigatorios) {
        $faltantes = [];
        $presentes = [];
        
        foreach ($parametrosObrigatorios as $parametro) {
            if ($this->temParametro($parametro)) {
                $presentes[] = $parametro;
            } else {
                $faltantes[] = $parametro;
            }
        }
        
        return [
            'valido' => empty($faltantes),
            'presentes' => $presentes,
            'faltantes' => $faltantes
        ];
    }
}

/**
 * Classe ConfigModificacao - Permite leitura e modificação de parâmetros
 */
class ConfigModificacao extends Config {
    /**
     * Método para definir um parâmetro
     * @param string $chave Chave do parâmetro
     * @param mixed $valor Valor do parâmetro
     * @return bool True se o parâmetro foi definido
     */
    public function setParametro($chave, $valor) {
        if (!empty($chave)) {
            $this->parametros[$chave] = $valor;
            return true;
        }
        return false;
    }
    
    /**
     * Método para definir múltiplos parâmetros
     * @param array $parametros Array de parâmetros
     * @return int Número de parâmetros definidos
     */
    public function setParametros($parametros) {
        $contador = 0;
        foreach ($parametros as $chave => $valor) {
            if ($this->setParametro($chave, $valor)) {
                $contador++;
            }
        }
        return $contador;
    }
    
    /**
     * Método para remover um parâmetro
     * @param string $chave Chave do parâmetro
     * @return bool True se o parâmetro foi removido
     */
    public function removerParametro($chave) {
        if (isset($this->parametros[$chave])) {
            unset($this->parametros[$chave]);
            return true;
        }
        return false;
    }
    
    /**
     * Método para limpar todos os parâmetros
     */
    public function limparParametros() {
        $this->parametros = [];
    }
    
    /**
     * Método para mesclar parâmetros existentes com novos
     * @param array $novosParametros Novos parâmetros
     * @param bool $sobrescrever Se deve sobrescrever parâmetros existentes
     */
    public function mesclarParametros($novosParametros, $sobrescrever = true) {
        if ($sobrescrever) {
            $this->parametros = array_merge($this->parametros, $novosParametros);
        } else {
            $this->parametros = array_merge($novosParametros, $this->parametros);
        }
    }
    
    /**
     * Método para exibir parâmetros com opções de modificação
     * @return string Parâmetros formatados
     */
    public function exibirParametros() {
        $saida = "<h4>Parâmetros de Configuração (Leitura e Modificação)</h4>";
        $saida .= "<p><strong>Total de parâmetros:</strong> {$this->getNumeroParametros()}</p>";
        
        if (empty($this->parametros)) {
            $saida .= "<p>Nenhum parâmetro configurado.</p>";
        } else {
            $saida .= "<ul>";
            foreach ($this->parametros as $chave => $valor) {
                $tipo = gettype($valor);
                $valorFormatado = is_array($valor) ? json_encode($valor) : $valor;
                $saida .= "<li><strong>{$chave}:</strong> {$valorFormatado} ({$tipo})</li>";
            }
            $saida .= "</ul>";
        }
        
        return $saida;
    }
}

/**
 * Classe ConfigAvancada - Funcionalidades avançadas de configuração
 */
class ConfigAvancada extends ConfigModificacao {
    // Atributos específicos para configurações avançadas
    private $historicoModificacoes;
    private $versao;
    
    /**
     * Construtor da classe
     * @param array $parametrosIniciais Parâmetros iniciais
     * @param string $versao Versão da configuração
     */
    public function __construct($parametrosIniciais = [], $versao = "1.0") {
        parent::__construct($parametrosIniciais);
        $this->historicoModificacoes = [];
        $this->versao = $versao;
    }
    
    /**
     * Método para obter a versão da configuração
     * @return string Versão da configuração
     */
    public function getVersao() {
        return $this->versao;
    }
    
    /**
     * Método para definir um parâmetro com histórico
     * @param string $chave Chave do parâmetro
     * @param mixed $valor Valor do parâmetro
     * @param string $motivo Motivo da modificação
     * @return bool True se o parâmetro foi definido
     */
    public function setParametroComHistorico($chave, $valor, $motivo = "") {
        $valorAnterior = $this->getParametro($chave);
        
        if (parent::setParametro($chave, $valor)) {
            $this->historicoModificacoes[] = [
                'data' => date('Y-m-d H:i:s'),
                'chave' => $chave,
                'valor_anterior' => $valorAnterior,
                'valor_novo' => $valor,
                'motivo' => $motivo
            ];
            return true;
        }
        return false;
    }
    
    /**
     * Método para obter o histórico de modificações
     * @return array Histórico de modificações
     */
    public function getHistoricoModificacoes() {
        return $this->historicoModificacoes;
    }
    
    /**
     * Método para reverter uma modificação específica
     * @param int $indice Índice da modificação no histórico
     * @return bool True se a reversão foi bem-sucedida
     */
    public function reverterModificacao($indice) {
        if (isset($this->historicoModificacoes[$indice])) {
            $modificacao = $this->historicoModificacoes[$indice];
            $this->parametros[$modificacao['chave']] = $modificacao['valor_anterior'];
            
            $this->historicoModificacoes[] = [
                'data' => date('Y-m-d H:i:s'),
                'chave' => $modificacao['chave'],
                'valor_anterior' => $modificacao['valor_novo'],
                'valor_novo' => $modificacao['valor_anterior'],
                'motivo' => "Reversão da modificação #{$indice}"
            ];
            
            return true;
        }
        return false;
    }
    
    /**
     * Método para exportar configuração para JSON
     * @return string Configuração em formato JSON
     */
    public function exportarParaJSON() {
        return json_encode([
            'versao' => $this->versao,
            'parametros' => $this->parametros,
            'data_exportacao' => date('Y-m-d H:i:s')
        ], JSON_PRETTY_PRINT);
    }
    
    /**
     * Método para importar configuração de JSON
     * @param string $json JSON com configuração
     * @return bool True se a importação foi bem-sucedida
     */
    public function importarDeJSON($json) {
        $dados = json_decode($json, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($dados['parametros'])) {
            $this->parametros = $dados['parametros'];
            if (isset($dados['versao'])) {
                $this->versao = $dados['versao'];
            }
            return true;
        }
        return false;
    }
}
?>
