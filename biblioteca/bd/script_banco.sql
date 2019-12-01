CREATE DATABASE basemodaslm;

USE basemodaslm;

CREATE TABLE cliente(
cod_cliente int(11) auto_increment not null,
nome varchar(60) not null,
email varchar(60) not null,
senha varchar(60) not null,
cpf varchar(11) not null,
dataNasc date not null,
sexo varchar(60) not null,
tipousuario varchar(5) not null,
PRIMARY KEY (cod_cliente)
);

CREATE TABLE endereco(
idEndereco int(11) auto_increment not null,
cod_cliente int(11) not null,
logradouro varchar(50) not null,
numero varchar(7) not null,
complemento varchar(60) not null,
bairro varchar(60) not null,
cidade varchar(60) not null,
cep varchar(10) not null,
PRIMARY KEY (idEndereco),
FOREIGN KEY (cod_cliente) REFERENCES cliente (cod_cliente)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE log_produto(
id_log int(11) auto_increment not null,
tabela varchar(45) not null,
usuario varchar(45) not null,
data_hora DATETIME not null,
acao varchar(45) not null,
dados varchar(1000) not null,
PRIMARY KEY (id_log)
);

CREATE TABLE cupom(
id_cupom int(11) auto_increment not null,
nomeCupom varchar(60) not null,
desconto int(11) not null,
PRIMARY KEY (id_cupom)
);

CREATE TABLE categoria(
cod_categoria INT not null auto_increment,
nome VARCHAR(50) NOT NULL,
primary key(cod_categoria)
);

CREATE TABLE forma_de_pagamento(
cod_formadepagamento INT not null auto_increment,
descricao VARCHAR(50) NOT NULL,
primary key(cod_formadepagamento)
);

CREATE TABLE produto(
cod_produto INT(11) unsigned auto_increment NOT NULL,
cod_categoria INT not null,
preco DOUBLE(10,2) NOT NULL,
nome VARCHAR(30) NOT NULL,
descricao VARCHAR(60) NOT NULL,
imagem VARCHAR(60) NOT NULL,
estoque_minimo INT(11),
estoque_maximo INT(11),
PRIMARY KEY(cod_produto),
FOREIGN KEY (cod_categoria) REFERENCES categoria (cod_categoria)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE estoque(
idestoque INT(11) unsigned auto_increment NOT NULL,
cod_produto INT(11) unsigned NOT NULL,
quantidade INT(11),
PRIMARY KEY(idestoque),
FOREIGN KEY (cod_produto) REFERENCES produto (cod_produto)
ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE pedido(
id_pedido INT(11) unsigned auto_increment NOT NULL,
cod_cliente INT(11) NOT NULL,
cod_formadepagamento INT NOT NULL,
total INT(11) NOT NULL,
logradouro varchar(50) not null,
datacompra DATE NOT NULL,
PRIMARY KEY(id_pedido),
FOREIGN KEY (cod_cliente) REFERENCES cliente (cod_cliente)
ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (cod_formadepagamento) REFERENCES forma_de_pagamento (cod_formadepagamento)
ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (logradouro) REFERENCES endereco (logradouro)
ON DELETE CASCADE ON UPDATE CASCADE
);


CREATE TABLE pedido_produto(
cod_produto INT(11) unsigned NOT NULL,
id_pedido INT(11) unsigned NOT NULL,
quantidade INT(11) NOT NULL,
FOREIGN KEY (cod_produto) REFERENCES produto (cod_produto)
ON DELETE CASCADE ON UPDATE CASCADE,
FOREIGN KEY (id_pedido) REFERENCES pedido (id_pedido)
ON DELETE CASCADE ON UPDATE CASCADE
);

-- admin

INSERT INTO cliente VALUES (1,"Modas LM","modaslm@gmail.com","123","50366664883",'2003-06-09',"F","admin");

-- PROCEDURE

-- faturamento semanal

DROP PROCEDURE IF EXISTS faturamento_semanal;
DELIMITER $$
CREATE PROCEDURE faturamento_semanal()
BEGIN
SELECT WEEK(pedido.datacompra) AS data, SUM(produto.preco * pedido_produto.quantidade) AS fatura
FROM produto 
INNER JOIN pedido_produto 
ON produto.cod_produto = pedido_produto.cod_produto
INNER JOIN pedido 
ON pedido_produto.id_pedido = pedido.id_pedido
GROUP BY WEEK(pedido.datacompra, 0);
END $$ 
DELIMITER ;

call faturamento_semanal;

-- faturamento mensal

DROP PROCEDURE IF EXISTS faturamento_mensal;
DELIMITER $$
CREATE PROCEDURE faturamento_mensal()
BEGIN
SELECT MONTH(pedido.datacompra) AS data, SUM(produto.preco * pedido_produto.quantidade) AS fatura
FROM produto 
INNER JOIN pedido_produto 
ON produto.cod_produto = pedido_produto.cod_produto
INNER JOIN pedido 
ON pedido_produto.id_pedido = pedido.id_pedido
GROUP BY MONTH(pedido.datacompra);
END $$ 
DELIMITER ;

call faturamento_mensal;

-- faturamento anual

DROP PROCEDURE IF EXISTS faturamento_anual;
DELIMITER $$
CREATE PROCEDURE faturamento_anual()
BEGIN
SELECT YEAR(pedido.datacompra) AS data, SUM(produto.preco * pedido_produto.quantidade) AS fatura
FROM produto 
INNER JOIN pedido_produto 
ON produto.cod_produto = pedido_produto.cod_produto
INNER JOIN pedido 
ON pedido_produto.id_pedido = pedido.id_pedido
GROUP BY YEAR(pedido.datacompra);
END $$ 
DELIMITER ;

call faturamento_anual;

-- TRIGGER

-- diminuir estoque 

DROP TRIGGER IF EXISTS tgr_diminuiestoque;
DELIMITER $$
CREATE TRIGGER tgr_diminuiestoque
AFTER INSERT ON pedido_produto
FOR EACH ROW
BEGIN
update produto set produto.estoque_maximo = produto.estoque_maximo - New.quantidade
where produto.cod_produto = new.cod_produto;
END $$
DELIMITER ;

-- restaurar estoque

DROP TRIGGER IF EXISTS tgr_restauraestoque;
DELIMITER $$
CREATE TRIGGER tgr_restauraestoque
AFTER DELETE ON pedido_produto
FOR EACH ROW
BEGIN
update produto set produto.estoque_maximo = produto.estoque_maximo + Old.quantidade
where produto.cod_produto = Old.cod_produto;
END $$
DELIMITER ;

-- cancela venda 

DROP TRIGGER IF EXISTS tr_cancelvenda;
DELIMITER $$ 
CREATE TRIGGER tgr_cancelvenda
BEFORE INSERT ON pedido 
FOR EACH ROW 
BEGIN 
IF(New.datacompra != CURDATE())THEN
SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = "Data de Venda inválida!";
END IF;
END $$ 
DELIMITER ;

