<?php
/**
 * Classe ConexaoBD - Exercício 10
 * Demonstração de encapsulamento de conexão com banco de dados
 * 
 * @author Aluno 4ª Fase - Ciência da Computação
 * @version 1.0
 */
class ConexaoBD {
    // Atributos privados para configuração da conexão
    private $host;
    private $porta;
    private $banco;
    private $usuario;
    private $senha;
    private $charset;
    
    // Atributos para gerenciar a conexão
    private $conexao;
    private $conectado;
    private $ultimoErro;
    private $configuracoes;
    
    /**
     * Construtor da classe
     * @param array $config Configurações de conexão
     */
    public function __construct($config = []) {
        // Configurações padrão
        $this->host = $config['host'] ?? 'localhost';
        $this->porta = $config['porta'] ?? 3306;
        $this->banco = $config['banco'] ?? 'teste';
        $this->usuario = $config['usuario'] ?? 'root';
        $this->senha = $config['senha'] ?? '';
        $this->charset = $config['charset'] ?? 'utf8mb4';
        
        $this->conexao = null;
        $this->conectado = false;
        $this->ultimoErro = '';
        
        // Configurações adicionais
        $this->configuracoes = [
            'timeout' => $config['timeout'] ?? 30,
            'retry_attempts' => $config['retry_attempts'] ?? 3,
            'auto_reconnect' => $config['auto_reconnect'] ?? true
        ];
    }
    
    /**
     * Método privado para estabelecer conexão com o banco
     * @return bool True se a conexão foi estabelecida com sucesso
     */
    private function conectar() {
        try {
            // DSN (Data Source Name) para MySQL
            $dsn = "mysql:host={$this->host};port={$this->porta};dbname={$this->banco};charset={$this->charset}";
            
            // Opções do PDO
            $opcoes = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_TIMEOUT => $this->configuracoes['timeout'],
                PDO::ATTR_PERSISTENT => false,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$this->charset}"
            ];
            
            // Tentativas de conexão
            $tentativas = 0;
            $maxTentativas = $this->configuracoes['retry_attempts'];
            
            while ($tentativas < $maxTentativas) {
                try {
                    $this->conexao = new PDO($dsn, $this->usuario, $this->senha, $opcoes);
                    $this->conectado = true;
                    $this->ultimoErro = '';
                    
                    // Log de conexão bem-sucedida
                    $this->logConexao("Conexão estabelecida com sucesso");
                    return true;
                    
                } catch (PDOException $e) {
                    $tentativas++;
                    $this->ultimoErro = "Tentativa {$tentativas}: " . $e->getMessage();
                    
                    if ($tentativas >= $maxTentativas) {
                        $this->logConexao("Falha na conexão após {$maxTentativas} tentativas: " . $e->getMessage());
                        return false;
                    }
                    
                    // Aguarda um pouco antes de tentar novamente
                    sleep(1);
                }
            }
            
            return false;
            
        } catch (Exception $e) {
            $this->ultimoErro = "Erro crítico na conexão: " . $e->getMessage();
            $this->logConexao($this->ultimoErro);
            return false;
        }
    }
    
    /**
     * Método público para obter a conexão
     * @return PDO|null Objeto PDO da conexão ou null se falhar
     */
    public function getConexao() {
        // Se não está conectado, tenta conectar
        if (!$this->conectado || $this->conexao === null) {
            if (!$this->conectar()) {
                return null;
            }
        }
        
        // Verifica se a conexão ainda está ativa
        if (!$this->verificarConexao()) {
            if ($this->configuracoes['auto_reconnect']) {
                if ($this->reconectar()) {
                    return $this->conexao;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        }
        
        return $this->conexao;
    }
    
    /**
     * Método para verificar se a conexão está ativa
     * @return bool True se a conexão estiver ativa
     */
    private function verificarConexao() {
        if ($this->conexao === null) {
            return false;
        }
        
        try {
            $this->conexao->query('SELECT 1');
            return true;
        } catch (PDOException $e) {
            $this->conectado = false;
            return false;
        }
    }
    
    /**
     * Método para reconectar ao banco
     * @return bool True se a reconexão foi bem-sucedida
     */
    private function reconectar() {
        $this->desconectar();
        return $this->conectar();
    }
    
    /**
     * Método para desconectar do banco
     */
    public function desconectar() {
        if ($this->conexao !== null) {
            $this->conexao = null;
        }
        $this->conectado = false;
        $this->logConexao("Conexão fechada");
    }
    
    /**
     * Método para verificar se está conectado
     * @return bool True se estiver conectado
     */
    public function estaConectado() {
        return $this->conectado && $this->verificarConexao();
    }
    
    /**
     * Método para obter informações da conexão
     * @return array Array com informações da conexão
     */
    public function getInfoConexao() {
        return [
            'host' => $this->host,
            'porta' => $this->porta,
            'banco' => $this->banco,
            'usuario' => $this->usuario,
            'charset' => $this->charset,
            'conectado' => $this->conectado,
            'ultimo_erro' => $this->ultimoErro
        ];
    }
    
    /**
     * Método para obter estatísticas da conexão
     * @return array Array com estatísticas
     */
    public function getEstatisticas() {
        if (!$this->estaConectado()) {
            return [];
        }
        
        try {
            $stats = [];
            
            // Informações do servidor
            $stmt = $this->conexao->query("SELECT VERSION() as versao");
            $stats['versao_mysql'] = $stmt->fetchColumn();
            
            // Status da conexão
            $stmt = $this->conexao->query("SHOW STATUS LIKE 'Threads_connected'");
            $stats['conexoes_ativas'] = $stmt->fetchColumn();
            
            // Variáveis do servidor
            $stmt = $this->conexao->query("SHOW VARIABLES LIKE 'max_connections'");
            $stats['max_conexoes'] = $stmt->fetchColumn();
            
            return $stats;
            
        } catch (PDOException $e) {
            return ['erro' => $e->getMessage()];
        }
    }
    
    /**
     * Método para executar uma query simples
     * @param string $sql SQL a ser executado
     * @return array|false Array com resultados ou false se falhar
     */
    public function executarQuery($sql) {
        $conexao = $this->getConexao();
        if ($conexao === null) {
            return false;
        }
        
        try {
            $stmt = $conexao->query($sql);
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            $this->ultimoErro = $e->getMessage();
            $this->logConexao("Erro na query: " . $this->ultimoErro);
            return false;
        }
    }
    
    /**
     * Método para preparar uma statement
     * @param string $sql SQL a ser preparado
     * @return PDOStatement|false Statement preparado ou false se falhar
     */
    public function preparar($sql) {
        $conexao = $this->getConexao();
        if ($conexao === null) {
            return false;
        }
        
        try {
            return $conexao->prepare($sql);
        } catch (PDOException $e) {
            $this->ultimoErro = $e->getMessage();
            $this->logConexao("Erro ao preparar statement: " . $this->ultimoErro);
            return false;
        }
    }
    
    /**
     * Método para iniciar uma transação
     * @return bool True se a transação foi iniciada
     */
    public function iniciarTransacao() {
        $conexao = $this->getConexao();
        if ($conexao === null) {
            return false;
        }
        
        try {
            return $conexao->beginTransaction();
        } catch (PDOException $e) {
            $this->ultimoErro = $e->getMessage();
            return false;
        }
    }
    
    /**
     * Método para confirmar uma transação
     * @return bool True se a transação foi confirmada
     */
    public function confirmarTransacao() {
        $conexao = $this->getConexao();
        if ($conexao === null) {
            return false;
        }
        
        try {
            return $conexao->commit();
        } catch (PDOException $e) {
            $this->ultimoErro = $e->getMessage();
            return false;
        }
    }
    
    /**
     * Método para reverter uma transação
     * @return bool True se a transação foi revertida
     */
    public function reverterTransacao() {
        $conexao = $this->getConexao();
        if ($conexao === null) {
            return false;
        }
        
        try {
            return $conexao->rollBack();
        } catch (PDOException $e) {
            $this->ultimoErro = $e->getMessage();
            return false;
        }
    }
    
    /**
     * Método para obter o último erro
     * @return string Último erro ocorrido
     */
    public function getUltimoErro() {
        return $this->ultimoErro;
    }
    
    /**
     * Método para limpar o último erro
     */
    public function limparErro() {
        $this->ultimoErro = '';
    }
    
    /**
     * Método para alterar configurações da conexão
     * @param array $novasConfig Novas configurações
     */
    public function alterarConfiguracao($novasConfig) {
        foreach ($novasConfig as $chave => $valor) {
            if (property_exists($this, $chave)) {
                $this->$chave = $valor;
            }
        }
        
        // Se alterou configurações de conexão, reconecta
        if (isset($novasConfig['host']) || isset($novasConfig['porta']) || 
            isset($novasConfig['banco']) || isset($novasConfig['usuario']) || 
            isset($novasConfig['senha'])) {
            $this->reconectar();
        }
    }
    
    /**
     * Método privado para log de conexão
     * @param string $mensagem Mensagem para log
     */
    private function logConexao($mensagem) {
        $timestamp = date('Y-m-d H:i:s');
        $log = "[{$timestamp}] ConexaoBD: {$mensagem}\n";
        
        // Em um sistema real, você salvaria em arquivo ou banco
        // error_log($log, 3, 'conexao_bd.log');
    }
    
    /**
     * Destrutor da classe - fecha a conexão automaticamente
     */
    public function __destruct() {
        $this->desconectar();
    }
}

/**
 * Classe de exemplo para demonstrar o uso da ConexaoBD
 */
class ExemploConexao {
    private $conexao;
    
    public function __construct() {
        // Configuração de exemplo
        $config = [
            'host' => 'localhost',
            'porta' => 3306,
            'banco' => 'exemplo',
            'usuario' => 'usuario_exemplo',
            'senha' => 'senha_exemplo',
            'charset' => 'utf8mb4',
            'timeout' => 30,
            'retry_attempts' => 3,
            'auto_reconnect' => true
        ];
        
        $this->conexao = new ConexaoBD($config);
    }
    
    /**
     * Exemplo de uso da conexão
     */
    public function exemploUso() {
        // Obtém a conexão
        $pdo = $this->conexao->getConexao();
        
        if ($pdo === null) {
            echo "Erro: Não foi possível conectar ao banco de dados\n";
            echo "Último erro: " . $this->conexao->getUltimoErro() . "\n";
            return false;
        }
        
        echo "Conexão estabelecida com sucesso!\n";
        
        // Exemplo de query
        $resultado = $this->conexao->executarQuery("SELECT 1 as teste");
        if ($resultado !== false) {
            echo "Query executada com sucesso: " . print_r($resultado, true) . "\n";
        }
        
        // Exemplo de prepared statement
        $stmt = $this->conexao->preparar("SELECT ? as parametro");
        if ($stmt !== false) {
            $stmt->execute(['teste']);
            $resultado = $stmt->fetch();
            echo "Prepared statement executado: " . print_r($resultado, true) . "\n";
        }
        
        return true;
    }
}
?>
