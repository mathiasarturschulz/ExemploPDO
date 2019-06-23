
-- -----------------------------------------------------
-- DB VENDA
-- -----------------------------------------------------
CREATE DATABASE IF NOT EXISTS venda;
USE venda;

CREATE TABLE IF NOT EXISTS Marca (
	idMarca INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(45) NOT NULL
);

CREATE TABLE IF NOT EXISTS Produto (
	idProduto INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	descricao VARCHAR(45) NOT NULL,
	valor DECIMAL(8,2) NOT NULL,
	estoque INT NOT NULL,
	imagem VARCHAR(100) NULL,
	idMarca INT NOT NULL,
	CONSTRAINT fk_Produto_Marca FOREIGN KEY (idMarca) REFERENCES Marca(idMarca)
);

CREATE TABLE IF NOT EXISTS Cliente (
	idCliente INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(45) NOT NULL,
	cpf INT(11) NOT NULL,
	rg VARCHAR(15) NOT NULL,
	usuario VARCHAR(45) NOT NULL,
	senha VARCHAR(45) NOT NULL,
	fone VARCHAR(45) NULL,
	email VARCHAR(45) NULL,
	endereco VARCHAR(45) NULL,
	numero VARCHAR(45) NULL,
	bairro VARCHAR(45) NULL,
	cidade VARCHAR(45) NULL,
	estado VARCHAR(45) NULL
);

CREATE TABLE IF NOT EXISTS Vendedor (
	idVendedor INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(45) NOT NULL,
	usuario VARCHAR(45) NOT NULL,
	senha VARCHAR(45) NOT NULL
);

CREATE TABLE IF NOT EXISTS Venda (
	idVenda INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	data DATE NOT NULL,
	dataVencimento DATE NOT NULL,
	dataPagamento DATE NOT NULL,
	idVendedor INT NOT NULL,
	idCliente INT NOT NULL,
	CONSTRAINT fk_Venda_Vendedor1 FOREIGN KEY (idVendedor) REFERENCES Vendedor(idVendedor),
	CONSTRAINT fk_Venda_Cliente1 FOREIGN KEY (idCliente) REFERENCES Cliente(idCliente)
);

CREATE TABLE IF NOT EXISTS ProdutoVenda (
	idProduto INT NOT NULL,
	idVenda INT NOT NULL,
	quantidadeProduto VARCHAR(45) NULL,
    PRIMARY KEY (idProduto, idVenda),
	CONSTRAINT fk_Produto_has_Venda_Produto1 FOREIGN KEY (idProduto) REFERENCES Produto(idProduto),
	CONSTRAINT fk_Produto_has_Venda_Venda1 FOREIGN KEY (idVenda) REFERENCES Venda(idVenda)
);

-- TESTE
-- select * from marca;
-- select * from produto;
-- insert into marca(descricao) values ('teste');
-- INSERT INTO produto(descricao,valor,estoque,imagem,idMarca) VALUES("Smartphone", 1500, 30, "abc", 1);






