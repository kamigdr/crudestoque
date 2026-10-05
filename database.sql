CREATE DATABASE IF NOT EXISTS gestao_estoque
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE gestao_estoque;

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    categoria VARCHAR(50) NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    quantidade_estoque INT NOT NULL,
    data_validade DATE NOT NULL
);

INSERT INTO produtos
(nome, categoria, descricao, preco, quantidade_estoque, data_validade)
VALUES
('Arroz 5kg', 'Alimentos', 'Arroz branco tipo 1', 29.90, 30, '2027-06-15'),
('Leite 1L', 'Bebidas', 'Leite integral', 5.99, 50, '2026-12-20'),
('Biscoito', 'Alimentos', 'Biscoito recheado', 4.50, 25, '2027-01-10');