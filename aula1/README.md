# Transformação de Código PHP: Estruturado para Orientado a Objetos

Este projeto demonstra a transformação de código PHP estruturado em código orientado a objetos, de forma simples e didática.

## 📁 Arquivos do Projeto

### 1. `codigo_estruturado.php`
Código PHP estruturado original:
- Variáveis independentes (`$preco`, `$desconto`)
- Operações sequenciais
- Sem agrupamento lógico entre dados e comportamentos

### 2. `exemplo_simples.php`
Demonstração completa da transformação:
- Mostra o código estruturado (antes)
- Mostra o código orientado a objetos (depois)
- Lista as vantagens da orientação a objetos

### 3. `explicacao_simples.php`
Explicação detalhada com exemplos práticos:
- Comparação lado a lado
- Explicação das mudanças
- Exemplos de reutilização da classe

## 🚀 Como Executar

```bash
# Executar código estruturado
php codigo_estruturado.php

# Executar exemplo completo
php exemplo_simples.php

# Executar explicação detalhada
php explicacao_simples.php
```

## 📊 Comparação

### Código Estruturado:
```php
$preco = 100;
$desconto = 0.1;
$final = $preco - ($preco * $desconto);
echo $final; // 90
```

### Código Orientado a Objetos:
```php
class Produto {
    public $preco;
    public $desconto;
    
    public function precoFinal() {
        return $this->preco - ($this->preco * $this->desconto);
    }
}

$camiseta = new Produto();
$camiseta->preco = 100;
$camiseta->desconto = 0.1;
echo $camiseta->precoFinal(); // 90
```

## ✅ Vantagens da Orientação a Objetos

- **Organização**: Dados e comportamentos agrupados
- **Reutilização**: Uma classe pode ser usada múltiplas vezes
- **Manutenibilidade**: Mudanças centralizadas
- **Clareza**: Código mais fácil de entender

## 🎯 Resultado Esperado

Ambas as versões produzem o mesmo resultado: **90**
- Preço inicial: R$ 100
- Desconto: 10% (0.1)
- Cálculo: 100 - (100 × 0.1) = 90 