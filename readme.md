# Sistema de Gestão de Estoque

Sistema desenvolvido em PHP e MySQL para controlar os produtos do estoque de um mercado.

## Objetivo

Permitir o cadastro, visualização, edição e exclusão de produtos.

## Tecnologias

- PHP
- MySQL
- HTML
- CSS
- XAMPP
- Git e GitHub

## Funcionalidades

- Cadastro de produtos
- Listagem de produtos
- Edição de produtos
- Exclusão de produtos
- Validação dos dados
- Prepared Statements
- Tratamento básico de erros
- Controle de validade dos produtos

## Dados do produto

Cada produto possui:

- Nome
- Categoria
- Descrição
- Preço
- Quantidade em estoque
- Data de validade

## Como executar

1. Instale o XAMPP.
2. Inicie Apache e MySQL.
3. Coloque a pasta `CRUD_Estoque_Mercado` dentro de `htdocs`.
4. Abra o phpMyAdmin.
5. Execute o arquivo `database.sql`.
6. Acesse:

`http://localhost/CRUD_Estoque_Mercado/`

O projeto utiliza a configuração padrão do XAMPP: usuário `root` e senha vazia.

## Banco de dados

Banco: `gestao_estoque`

Tabela principal: `produtos`.

## Segurança

As operações de inserção, consulta por ID, atualização e exclusão utilizam Prepared Statements para evitar a construção direta de SQL com dados recebidos pelo usuário.

## Caso de uso

O arquivo `documentacao/caso_de_uso.md` apresenta o ator e as principais ações do sistema.