# 📚 Discussão Coletiva e Próximos Passos - Aula 2

## 🎯 Visão Geral
Este documento complementa os exercícios práticos da Aula 2, fornecendo uma discussão coletiva sobre as soluções implementadas e orientações para os próximos passos no aprendizado de Programação Orientada a Objetos (POO) em PHP.

---

## 🤝 Discussão Coletiva

### **Compartilhamento de Soluções**
Vamos discutir as diferentes abordagens e soluções encontradas pelos alunos:

#### **1. Apresentação de 2-3 Soluções Diferentes**
- **Solução 1:** Implementação básica com validações simples
- **Solução 2:** Implementação robusta com tratamento de exceções
- **Solução 3:** Implementação avançada com padrões de design

#### **2. Comparação de Estratégias de Validação**
**Exemplo da Classe Livro (`exercicio3_livro.php`):**

```php
// Estratégia 1: Validação simples
public function setAnoPublicacao($ano) {
    if ($ano > date('Y')) {
        throw new Exception("Ano não pode ser futuro!");
    }
    $this->anoPublicacao = $ano;
}

// Estratégia 2: Validação com range
public function setAnoPublicacao($ano) {
    $anoAtual = date('Y');
    if ($ano < 1000 || $ano > $anoAtual) {
        throw new Exception("Ano deve estar entre 1000 e {$anoAtual}");
    }
    $this->anoPublicacao = $ano;
}
```

#### **3. Discussão sobre Escolhas de Design**
- **Encapsulamento:** Por que usar atributos privados?
- **Getters/Setters:** Quando usar e quando não usar?
- **Construtores:** Parâmetros obrigatórios vs. opcionais
- **Validações:** Onde implementar validações?

#### **4. Identificação de Padrões Comuns**
- **Padrão Builder:** Para objetos complexos
- **Padrão Factory:** Para criação de objetos
- **Padrão Observer:** Para notificações de mudanças

---

## ❌ Erros Comuns e Boas Práticas

### **1. Esquecer Validações nos Setters**
```php
// ❌ ERRADO - Sem validação
public function setNumeroPaginas($paginas) {
    $this->numeroPaginas = $paginas; // Pode receber valor negativo!
}

// ✅ CORRETO - Com validação
public function setNumeroPaginas($paginas) {
    if (!is_numeric($paginas) || $paginas <= 0) {
        throw new Exception("Número de páginas deve ser positivo!");
    }
    $this->numeroPaginas = (int)$paginas;
}
```

### **2. Acesso Direto a Atributos Privados**
```php
// ❌ ERRADO - Acesso direto
$aluno = new Aluno("João", "2024001");
echo $aluno->matricula; // Erro! Atributo privado

// ✅ CORRETO - Via getter
$aluno = new Aluno("João", "2024001");
echo $aluno->getMatricula(); // Correto!
```

### **3. Construtores sem Inicialização Adequada**
```php
// ❌ ERRADO - Construtor incompleto
public function __construct($titular) {
    $this->titular = $titular;
    // $this->saldo não é inicializado!
}

// ✅ CORRETO - Construtor completo
public function __construct($titular, $saldo = 0) {
    $this->titular = $titular;
    $this->saldo = $saldo;
    $this->numero = rand(1000, 9999);
}
```

### **4. Métodos Getters/Setters Incompletos**
```php
// ❌ ERRADO - Apenas getter
public function getTitulo() {
    return $this->titulo;
}
// Falta setTitulo()!

// ✅ CORRETO - Getter e Setter
public function getTitulo() {
    return $this->titulo;
}

public function setTitulo($titulo) {
    if (empty(trim($titulo))) {
        throw new Exception("Título não pode ser vazio!");
    }
    $this->titulo = trim($titulo);
}
```

### **5. Nomes de Métodos Inconsistentes**
```php
// ❌ ERRADO - Nomes inconsistentes
public function getNome() { return $this->nome; }
public function setNome($nome) { $this->nome = $nome; }
public function obterMatricula() { return $this->matricula; } // Inconsistente!

// ✅ CORRETO - Padrão consistente
public function getNome() { return $this->nome; }
public function setNome($nome) { $this->nome = $nome; }
public function getMatricula() { return $this->matricula; }
```

---

## 📖 Resumo dos Conceitos Aprendidos

### **1. Construtores: método `__construct()` para inicialização**
- **Propósito:** Inicializar objetos com valores padrão
- **Vantagens:** Garantir estado inicial válido
- **Exemplo:** `new Conta("João", 1000)`

### **2. Modificadores de Acesso: public, private, protected**
- **`public`:** Acesso irrestrito (ex: `$aluno->nome`)
- **`private`:** Acesso apenas dentro da classe
- **`protected`:** Acesso na classe e classes filhas

### **3. Encapsulamento através de getters e setters**
- **Controle de acesso** aos atributos
- **Validação de dados** antes da atribuição
- **Interface pública controlada**

### **4. Validação de Dados em Métodos Setters**
- **Verificação de valores válidos**
- **Tratamento de exceções**
- **Mensagens de erro informativas**

### **5. Boas Práticas de Orientação a Objetos**
- **Responsabilidade única** para cada classe
- **Coesão alta** entre métodos e atributos
- **Acoplamento baixo** entre classes

---

## 🚀 Próximo Tema: Herança e Reuso de Código

### **O que vamos estudar:**
Estudaremos como criar hierarquias de classes, reutilizar código e implementar comportamentos especializados.

### **Conceitos que serão abordados:**
1. **Herança Simples e Múltipla**
2. **Sobrescrita de Métodos**
3. **Classes Abstratas**
4. **Interfaces**
5. **Polimorfismo**

### **Exemplo Prático - Hierarquia de Contas:**
```php
abstract class Conta {
    protected $titular;
    protected $saldo;
    
    abstract public function calcularTaxa();
}

class ContaCorrente extends Conta {
    public function calcularTaxa() {
        return $this->saldo * 0.01; // 1% ao mês
    }
}

class ContaPoupanca extends Conta {
    public function calcularTaxa() {
        return $this->saldo * 0.005; // 0.5% ao mês
    }
}
```

---

## 🧠 Hierarquia de Conceitos POO

```
                    ┌─────────────────┐
                    │   Inheritance   │ ← Próximo passo
                    │   (Herança)     │
                    └─────────────────┘
                              ▲
                    ┌─────────────────┐
                    │  Polymorphism   │
                    │ (Polimorfismo)  │
                    └─────────────────┘
                              ▲
                    ┌─────────────────┐
                    │  Abstraction    │
                    │ (Abstração)     │
                    └─────────────────┘
                              ▲
                    ┌─────────────────┐
                    │   Objects       │ ← Já aprendemos
                    │   (Objetos)     │
                    └─────────────────┘
                              ▲
                    ┌─────────────────┐
                    │ Encapsulation   │ ← Já aprendemos
                    │(Encapsulamento) │
                    └─────────────────┘
```

---

## 📚 Leitura Complementar

### **Documentação Oficial:**
- **PHP Documentation:** [Construtores e Destrutores](https://www.php.net/manual/pt_BR/language.oop5.decon.php)
- **PHP Documentation:** [Modificadores de Acesso](https://www.php.net/manual/pt_BR/language.oop5.visibility.php)

### **Livros Recomendados:**
- **Clean Code:** Capítulo sobre Classes (Robert C. Martin)
- **Design Patterns em PHP** (Gang of Four)
- **PHP Objects, Patterns, and Practice** (Matt Zandstra)

### **Recursos Online:**
- **PHP The Right Way:** [Object-Oriented PHP](https://phptherightway.com/#object_oriented_programming)
- **Laravel Documentation:** [Eloquent ORM](https://laravel.com/docs/eloquent)

---

## 💡 Dicas para o Próximo Passo

### **1. Pratique com Exercícios:**
- Crie hierarquias de classes simples
- Implemente interfaces básicas
- Experimente polimorfismo

### **2. Revise os Conceitos Atuais:**
- Execute novamente os exercícios da Aula 2
- Modifique as classes para entender melhor
- Crie suas próprias variações

### **3. Prepare-se para Herança:**
- Pense em relacionamentos "é um" (is-a)
- Identifique comportamentos comuns
- Planeje hierarquias de classes

---

## 🎯 Conclusão

A discussão coletiva ajuda a consolidar o conhecimento e explorar diferentes perspectivas sobre o mesmo problema. 

**Conceitos dominados na Aula 2:**
- ✅ Construtores e inicialização de objetos
- ✅ Modificadores de acesso (public/private)
- ✅ Encapsulamento com getters/setters
- ✅ Validação de dados
- ✅ Tratamento de exceções

**Próximo desafio:**
- 🚀 Herança e reuso de código
- 🚀 Polimorfismo e interfaces
- 🚀 Hierarquias de classes

Continue praticando e experimentando com os conceitos aprendidos. A POO é uma ferramenta poderosa que se torna mais clara com a prática constante!

---

*Documento criado para complementar os exercícios da Aula 2 - POO em PHP*
*Data: Agosto 2025*
