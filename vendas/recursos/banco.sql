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

CREATE TABLE escola(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    nome VARCHAR(45),
    endereco VARCHAR(45),
    bairro VARCHAR(45),
    telefone VARCHAR(15),
    celular VARCHAR(15),
    descricao VARCHAR(255),
    imagem VARCHAR(255),
    cidade INT
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

INSERT INTO escola(nome, endereco, bairro, telefone, celular, descricao, imagem, cidade) VALUES
('Colégio Estadual Princesa Isabel','Rua Recife, 1171','Centro','(44)3448-1767','n','teste','imagem', 2),
('Colégio Ary João Dresch','Praça Matriz, 143','Centro','(44)3432-1178','n','teste','imagem', 1);

CREATE TABLE cardapio(
	id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    serie VARCHAR(45),
    nutricionista VARCHAR(45),
   	pdf VARCHAR(255),
    escola int
)ENGINE=MyISAM DEFAULT CHARSET=latin1;;

INSERT INTO cardapio(serie, nutricionista, pdf, escola) VALUES
('6º ao 9º ano fundamental','Ana Laura','endereço do pdf', 1),
('1º ao 3º ano ensino médio','Juliana','endereço do pdf', 2);

-- Criar a tabela de produtos
CREATE TABLE produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    estoque INT NOT NULL
);

-- Criar a tabela de vendas
CREATE TABLE venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    data_venda DATETIME NOT NULL
);

-- Criar a tabela de itens da venda
CREATE TABLE item_venda (
    id INT AUTO_INCREMENT PRIMARY KEY,
    venda_id INT,
    produto_id INT,
    quantidade INT,
    total DECIMAL(10, 2),
    FOREIGN KEY (venda_id) REFERENCES venda(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);