# Caso de Uso — Sistema de Gestão de Estoque

## Ator

**Funcionário do mercado:** utiliza o sistema para controlar os produtos do estoque.

## Casos de uso

1. Cadastrar produto
2. Visualizar produtos
3. Editar produto
4. Excluir produto

## Descrição

### Cadastrar produto
O funcionário informa nome, categoria, descrição, preço, quantidade em estoque e data de validade. O sistema valida os dados e salva o produto no banco.

### Visualizar produtos
O funcionário acessa a página principal e visualiza os produtos cadastrados.

### Editar produto
O funcionário escolhe um produto, altera seus dados e salva as alterações.

### Excluir produto
O funcionário escolhe um produto e confirma a exclusão.

## Diagrama de Caso de Uso

```text
                    +---------------------------+
                    | Sistema de Gestão         |
                    | de Estoque                |
                    |                           |
Funcionário ------> | (Cadastrar produto)       |
       |            |                           |
       |-----------> | (Visualizar produtos)    |
       |            |                           |
       |-----------> | (Editar produto)         |
       |            |                           |
       |-----------> | (Excluir produto)        |
                    +---------------------------+
```
