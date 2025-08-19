# Aula 2 - Programação Orientada a Objetos em PHP

## Visão Geral
Esta aula contém três exercícios práticos sobre Programação Orientada a Objetos (POO) em PHP, focando em conceitos fundamentais como construtores, modificadores de acesso, getters e setters.

## 🚀 Interface Web Interativa

**Arquivo:** `index.html`

Criamos uma interface web moderna e responsiva para você visualizar e executar todos os exercícios diretamente no navegador!

### Características da Interface:
- ✨ Design moderno e responsivo
- 🎯 Cards visuais para cada exercício
- ▶️ Botões para executar exercícios
- 📊 Visualização dos resultados em tempo real
- 📱 Compatível com dispositivos móveis
- 🎨 Interface intuitiva e amigável

### Como Usar a Interface Web:

#### Opção 1: Servidor PHP Local (Recomendado)
```bash
# Navegar para a pasta aula2
cd aula2

# Iniciar servidor PHP (Windows)
start_server.bat

# OU usando PowerShell
.\start_server.ps1

# OU manualmente
php -S localhost:8000
```

Depois abra seu navegador e acesse: **http://localhost:8000**

#### Opção 2: Servidor Web Local
Se você tiver XAMPP, WAMP ou similar, coloque os arquivos na pasta `htdocs` e acesse via localhost.

## Exercícios Implementados

### 1. Exercício 1: Classe Conta com Construtor
**Arquivo:** `exercicio1_conta.php`

**Objetivo:** Criar uma classe Conta com construtor para inicializar titular e saldo inicial.

**Requisitos:**
- Atributos: `$titular`, `$saldo`, `$numero`
- Construtor que receba titular e saldo inicial
- Número da conta deve ser gerado automaticamente
- Método `exibirDados()` para mostrar informações
- Método `depositar($valor)` que adicione ao saldo

**Conceitos Aplicados:**
- Construtores
- Atributos privados
- Getters
- Validação de dados

### 2. Exercício 2: Modificadores de Acesso na Classe Aluno
**Arquivo:** `exercicio2_aluno.php`

**Objetivo:** Criar uma classe Aluno com diferentes níveis de acesso aos atributos.

**Requisitos:**
- `$nome`: Public (pode ser lido e alterado)
- `$matricula`: Somente leitura (privado com getter)
- `$notas`: Privado (acessível apenas por métodos)
- `$media`: Privado (calculado internamente)

**Conceitos Aplicados:**
- Modificadores de acesso (public, private)
- Métodos privados
- Getters
- Encapsulamento

### 3. Exercício 3: Getters e Setters na Classe Livro
**Arquivo:** `exercicio3_livro.php`

**Objetivo:** Implementar uma classe Livro com getters e setters que façam validações.

**Requisitos:**
- Ano de publicação não pode ser futuro
- Número de páginas deve ser positivo
- Título e autor não podem ser vazios

**Conceitos Aplicados:**
- Getters e Setters
- Validação de dados
- Tratamento de exceções
- Encapsulamento completo

## Como Executar

### Via Interface Web (Recomendado)
1. Inicie o servidor PHP local
2. Acesse http://localhost:8000
3. Clique nos botões para executar cada exercício
4. Visualize os resultados na tela

### Via Terminal
Para executar cada exercício diretamente no terminal:

```bash
# Exercício 1
php exercicio1_conta.php

# Exercício 2
php exercicio2_aluno.php

# Exercício 3
php exercicio3_livro.php
```

## Arquivos da Interface Web

- **`index.html`** - Interface principal
- **`run_exercise.php`** - Script para executar exercícios
- **`start_server.bat`** - Script Windows para iniciar servidor
- **`start_server.ps1`** - Script PowerShell para iniciar servidor

## Conceitos de POO Demonstrados

1. **Classes e Objetos**
   - Definição de classes
   - Instanciação de objetos
   - Uso de `$this`

2. **Construtores**
   - Inicialização de objetos
   - Parâmetros de entrada
   - Valores padrão

3. **Modificadores de Acesso**
   - `public`: Acesso irrestrito
   - `private`: Acesso apenas dentro da classe
   - Encapsulamento de dados

4. **Getters e Setters**
   - Controle de acesso aos atributos
   - Validação de dados
   - Interface pública controlada

5. **Validação de Dados**
   - Verificação de valores válidos
   - Tratamento de exceções
   - Mensagens de erro informativas

## Estrutura dos Arquivos

```
aula2/
├── README.md                    # Este arquivo
├── index.html                   # Interface web principal
├── run_exercise.php             # Script para executar exercícios
├── start_server.bat             # Script Windows para servidor
├── start_server.ps1             # Script PowerShell para servidor
├── exercicio1_conta.php        # Classe Conta com construtor
├── exercicio2_aluno.php        # Classe Aluno com modificadores de acesso
└── exercicio3_livro.php        # Classe Livro com getters/setters
```

## Dicas de Estudo

1. **Use a interface web** para visualizar os resultados de forma mais clara
2. **Execute cada exercício** e observe a saída
3. **Modifique os valores** de teste para entender melhor o comportamento
4. **Experimente quebrar as validações** para ver como as exceções funcionam
5. **Compare os conceitos** entre os três exercícios
6. **Tente criar suas próprias classes** baseadas nos exemplos

## Próximos Passos

Após dominar estes conceitos, você pode explorar:
- Herança e polimorfismo
- Interfaces e classes abstratas
- Namespaces e autoloading
- Padrões de projeto
- Testes unitários

## Suporte

Se encontrar algum problema:
1. Verifique se o PHP está instalado: `php --version`
2. Certifique-se de estar na pasta correta
3. Use a interface web para melhor visualização
4. Consulte os comentários no código para entender cada parte
