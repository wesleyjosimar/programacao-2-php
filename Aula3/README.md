# Aula 3 - Programação Orientada a Objetos (POO)

## Visão Geral

Esta aula apresenta 10 exercícios práticos de Programação Orientada a Objetos em PHP, desenvolvidos para alunos da 4ª fase de Ciência da Computação. Os exercícios demonstram os conceitos fundamentais de POO de forma progressiva e prática.

## Objetivos de Aprendizagem

- Compreender os conceitos básicos de POO
- Implementar classes com diferentes níveis de acesso
- Aplicar encapsulamento, herança e polimorfismo
- Desenvolver código orientado a objetos de qualidade profissional
- Praticar padrões de projeto comuns

## Exercícios Implementados

### 1. Classe Produto - Atributos Públicos
- Arquivo: Produto.php / exercicio1.php
- Conceito: Atributos públicos e instanciação de objetos
- Demonstra: Acesso direto aos dados da classe

### 2. Classe Produto com Encapsulamento - Atributos Privados
- Arquivo: ProdutoEncapsulado.php / exercicio2.php
- Conceito: Encapsulamento com métodos get/set
- Demonstra: Proteção de dados e validação

### 3. Classe ContaBancaria - Operações Bancárias
- Arquivo: ContaBancaria.php / exercicio3.php
- Conceito: Encapsulamento com operações complexas
- Demonstra: Métodos para depositar, sacar e transferir

### 4. Herança - Funcionario e Gerente - Atributos Protegidos
- Arquivo: Funcionario.php / exercicio4.php
- Conceito: Herança e atributos protegidos
- Demonstra: Reutilização de código e extensão de funcionalidades

### 5. Classe Usuario - Verificação de Senha
- Arquivo: Usuario.php / exercicio5.php
- Conceito: Encapsulamento de dados sensíveis
- Demonstra: Hash de senhas e autenticação segura

### 6. Herança - Config e Subclasses - Parâmetros Protegidos
- Arquivo: Config.php / exercicio6.php
- Conceito: Herança com diferentes níveis de acesso
- Demonstra: Subclasses para leitura e modificação

### 7. Classe Pedido - Gerenciamento de Array
- Arquivo: Pedido.php / exercicio7.php
- Conceito: Encapsulamento de arrays privados
- Demonstra: Métodos para inserir, listar e gerenciar itens

### 8. Classe Cliente - Diferentes Níveis de Acesso
- Arquivo: Cliente.php / exercicio8.php
- Conceito: Múltiplos níveis de acesso (público, protegido, privado)
- Demonstra: Controle granular sobre atributos

### 9. ContaBancaria Refatorada - Validação de Saque
- Arquivo: ContaBancariaRefatorada.php / exercicio9.php
- Conceito: Refatoração com validações robustas
- Demonstra: Tratamento de erros e validações de negócio

### 10. Classe ConexaoBD - Encapsulamento de Conexão
- Arquivo: ConexaoBD.php / exercicio10.php
- Conceito: Encapsulamento completo de recursos externos
- Demonstra: Padrão Singleton e gerenciamento de conexões

## Conceitos POO Demonstrados

### Encapsulamento
- Atributos privados e protegidos
- Métodos públicos para acesso controlado
- Validação de dados nos setters
- Proteção da integridade dos objetos

### Herança
- Classes base e derivadas
- Reutilização de código
- Sobrescrita de métodos
- Construtores da classe pai

### Polimorfismo
- Métodos com comportamentos diferentes
- Sobrescrita de métodos
- Interfaces consistentes
- Comportamento dinâmico

### Abstração
- Interfaces claras
- Implementações ocultas
- Separação de responsabilidades
- Código limpo e organizado

## Como Executar

### Opção 1: Executar Individualmente
1. Acesse index.html para ver o menu principal
2. Clique em qualquer exercício para executá-lo
3. Cada exercício tem sua própria página com demonstração

### Opção 2: Ver Código das Classes
1. Cada exercício tem um botão "Ver Código"
2. Acesse diretamente os arquivos .php das classes
3. Analise a implementação completa

## Estrutura de Arquivos

```
Aula3/
├── index.html                          # Menu principal
├── README.md                           # Este arquivo
├── Produto.php                        # Classe do Exercício 1
├── exercicio1.php                     # Execução do Exercício 1
├── ProdutoEncapsulado.php             # Classe do Exercício 2
├── exercicio2.php                     # Execução do Exercício 2
├── ContaBancaria.php                  # Classe do Exercício 3
├── exercicio3.php                     # Execução do Exercício 3
├── Funcionario.php                    # Classes do Exercício 4
├── exercicio4.php                     # Execução do Exercício 4
├── Usuario.php                        # Classe do Exercício 5
├── Config.php                         # Classes do Exercício 6
├── Pedido.php                         # Classe do Exercício 7
├── Cliente.php                        # Classes do Exercício 8
├── ContaBancariaRefatorada.php        # Classe do Exercício 9
└── ConexaoBD.php                      # Classe do Exercício 10
```

## Requisitos Técnicos

- PHP: 7.4 ou superior
- Servidor Web: Apache, Nginx ou servidor PHP embutido
- Extensões PHP: PDO (para ConexaoBD)
- Navegador: Moderno com suporte a CSS3

## Padrões de Projeto Utilizados

- Getters/Setters: Para acesso controlado aos atributos
- Factory: Para criação de objetos complexos
- Singleton: Implícito na ConexaoBD
- Template Method: Na hierarquia de classes
- Strategy: Para diferentes tipos de validação

## Nível de Complexidade

### Básico (Exercícios 1-3)
- Conceitos fundamentais de POO
- Atributos e métodos básicos
- Encapsulamento simples

### Intermediário (Exercícios 4)
- Herança e polimorfismo
- Arrays e estruturas de dados
- Validações e tratamento de erros

### Avançado (Classes 5-10)
- Múltiplos níveis de acesso
- Refatoração e melhorias
- Padrões de projeto complexos

## Próximos Passos

Após dominar estes exercícios, você pode:

1. Implementar interfaces e classes abstratas
2. Aplicar padrões de projeto mais avançados
3. Desenvolver aplicações web completas
4. Estudar frameworks PHP modernos (Laravel, Symfony)
5. Explorar testes unitários e TDD

## Autor

Aluno da 4ª Fase - Ciência da Computação  
Disciplina: Programação 2 - PHP  
Universidade: Unoesc Videira  
Ano: 2025

## Licença

Este projeto é destinado exclusivamente para fins educacionais e de aprendizado.

---

Lembre-se: A prática é fundamental para dominar POO. Execute cada exercício, modifique o código, experimente diferentes abordagens e sempre questione "por que" cada decisão foi tomada.
