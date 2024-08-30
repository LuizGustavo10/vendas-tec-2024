/* ALTERAR tabela de nome em tabela*/
UPDATE usuario SET nome="Stela" WHERE id=1;

/*DELETAR algum registro*/
DELETE FROM usuario WHERE id=1;

/*SELECIONAR todos os registros*/
/*selecionar todos usuarios*/
SELECT * FROM usuario;
/*selecionar todos apenas a coluna nome e cpf ordenando por nome*/
SELECT nome, cpf FROM usuario ORDER BY nome ASC;
/*selecionar todos os usuario com id entre 1 e 10*/
SELECT * FROM usuario WHERE id BETWEEN 1 and 3 ORDER BY nome;
/*selecionar usuario de acordo com cpf*/
SELECT * FROM usuario WHERE cpf LIKE '123.123.123-12';
SELECT * FROM usuario WHERE nome LIKE 'Janaina' or nome LIKE 'Lucas';

SELECT escola.nome, cidade.nome
FROM escola INNER JOIN cidade
ON escola.cidade = cidade.id


/* comando para criação de tabela de usuario */
CREATE TABLE usuario(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45),
    cpf VARCHAR(15),
    senha VARCHAR(45)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Inserindo na tabela usuario*/
INSERT INTO usuario(nome, cpf, senha) VALUES
('Luana','123.123.123-12', '123'),
('Janaina', '321.321.321-31', '321');

/*criação da tabela cidade*/
CREATE TABLE cidade(
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
	nome VARCHAR(45),
    estado VARCHAR(20),
    cep VARCHAR(10)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*inserindo na tabela cidade*/
INSERT INTO cidade(nome, estado, cep) VALUES 
('Nova Londrina','Paraná','87.970-000'), 
('Marilena','Paraná','87.960-000');



-- Criar a tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT,
    custo INT,
    lucro INT,
    margem INT
);

-- Criar a tabela de vendas
CREATE TABLE venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    obs VARCHAR(45),
    valor_total INT,
    quantidade_total INT,
    data_venda DATETIME NOT NULL
);

-- Criar a tabela de itens da venda
CREATE TABLE item_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT,
    produto_id INT,
    quantidade INT,
    valor DECIMAL(10, 2),
    FOREIGN KEY (venda_id) REFERENCES venda(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);

INSERT INTO produtos (nome, preco, estoque, custo, lucro, margem) VALUES
('Produto A', 25.50, 100, 15, 10, 40),
('Produto B', 10.00, 200, 5, 5, 50),
('Produto C', 7.75, 150, 4, 3.75, 48.39);

INSERT INTO venda (obs, valor_total, quantidade_total, data_venda) VALUES
('Venda realizada com sucesso', 52, 3, '2024-08-30 14:00:00');

INSERT INTO item_venda (venda_id, produto_id, quantidade, valor) VALUES
(1, 1, 1, 25.50),
(1, 2, 2, 20.00),
(1, 3, 1, 7.75);