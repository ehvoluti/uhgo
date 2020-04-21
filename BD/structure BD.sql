﻿DROP TABLE empresa 
CREATE TABLE empresa (
idempresa INTEGER NOT NULL,
nomeemp CHARACTER VARYING(50),
cnpj CHARACTER VARYING(15),
CONSTRAINT pk_empresa PRIMARY KEY (idempresa))

DROP TABLE cliente
CREATE TABLE cliente (
idcliente INTEGER NOT NULL,
nomecli CHARACTER VARYING(50),
cnpj CHARACTER VARYING(15),
CONSTRAINT pk_cliente PRIMARY KEY (idcliente))


DROP TABLE produto 
CREATE TABLE produto (
idproduto INTEGER NOT NULL,
nomeprod CHARACTER VARYING(50),
sku CHARACTER VARYING(15),
CONSTRAINT pk_produto PRIMARY KEY (idproduto))

CREATE TABLE usuario (
idlogin INTEGER,	
login CHARACTER VARYING(30),
senha CHARACTER VARYING(30),
CONSTRAINT pk_usuario PRIMARY KEY (idlogin))


DROP TABLE pedido 
CREATE TABLE pedido (
idpedido SERIAL,
idempresa INTEGER,
idcliente INTEGER,
idlogin INTEGER,
dtneg TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
totalped DECIMAL (12,2) DEFAULT 0.00,
CONSTRAINT pk_pedido PRIMARY KEY (idpedido),
CONSTRAINT fk_pedido_empresa FOREIGN KEY (idempresa)
	REFERENCES empresa (idempresa) MATCH SIMPLE ON UPDATE CASCADE ON DELETE NO ACTION,
CONSTRAINT fk_pedido_cliente FOREIGN KEY (idcliente)
	REFERENCES cliente (idcliente) MATCH SIMPLE ON UPDATE CASCADE ON DELETE NO ACTION,
CONSTRAINT fk_pedido_usuario FOREIGN KEY (idlogin)
	REFERENCES usuario (idlogin) MATCH SIMPLE ON UPDATE CASCADE ON DELETE NO ACTION)

DROP TABLE itpedido
CREATE TABLE itpedido (
idpedido INTEGER NOT NULL,
idproduto INTEGER NOT NULL,
seqit INTEGER NOT NULL,
quant	DECIMAL (12,2),
valor DECIMAL (12,2),
totalit DECIMAL (12,2),
CONSTRAINT fk_itpedido_pedido FOREIGN KEY (idpedido)
	REFERENCES pedido (idpedido) MATCH SIMPLE ON UPDATE CASCADE ON DELETE NO ACTION,
CONSTRAINT fk_itpedido_produto FOREIGN KEY (idproduto)
	REFERENCES produto (idproduto) MATCH SIMPLE ON UPDATE CASCADE ON DELETE NO ACTION
)


--Dados
INSERT INTO usuario VALUES (1,'hugo', '123')
INSERT INTO usuario VALUES (2,'helo', '123')

SELECT * FROM pedido
SELECT * FROM usuario
 INSERT INTO pedido (idempresa, idcliente, idlogin) VALUES ('10', '6706', '1')﻿


INSERT INTO empresa VALUES (9,'M QUEST - SP',34425796000146);
INSERT INTO empresa VALUES (501,'EMPRESA DE CONSOLIDAÇÃO',24742869000170);
INSERT INTO empresa VALUES (3,'EKOS - SP',34472293000121);
INSERT INTO empresa VALUES (5,'QUALITY - RJ',22104417000218);
INSERT INTO empresa VALUES (11,'SL ONLINE - SP',28879206000152);
INSERT INTO empresa VALUES (1,'MCR - SP',24742869000170);
INSERT INTO empresa VALUES (2,'MCR - SC',24742869000250);
INSERT INTO empresa VALUES (4,'QUALITY - SP',2210441700013);
INSERT INTO empresa VALUES (6,'AGGP - SP',30025907000176);
INSERT INTO empresa VALUES (10,'EA88 - SC',33890465000114);
