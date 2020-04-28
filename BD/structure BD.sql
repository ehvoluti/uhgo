DROP TABLE empresa 
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
CONSTRAINT pk_cliente PRIMARY KEY (idcliente));
ALTER TABLE cliente ADD COLUMN idtabela integer;
ALTER TABLE cliente ADD COLUMN idvendedor integer;



DROP TABLE produto 
CREATE TABLE produto (
idproduto INTEGER NOT NULL,
nomeprod CHARACTER VARYING(100),
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
status CHARACTER VARYING(1) DEFAULT 'D',
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

CREATE TABLE tabela(
idtabela INTEGER NOT NULL,
descricaotab CHARACTER VARYING (100),
idtabelaorig INTEGER NOT NULL,
percentual DECIMAL (12,2),
dataalt DATE,
CONSTRAINT pk_tabela PRIMARY KEY (idtabela))

CREATE TABLE ittabela(
idtabela INTEGER,
idproduto INTEGER,
valor DECIMAL(12,2),
CONSTRAINT fk_ittabela_tabela FOREIGN KEY (idtabela)
	REFERENCES tabela (idtabela) MATCH SIMPLE ON UPDATE CASCADE ON DELETE NO ACTION
)

/*-------Select do Sankhya
--Tabela
SELECT 'INSERT INTO tabela VALUES ('||codtab||','''||nometab||''','||codtaborig||','||REPLACE(COALESCE(percentual,1),',','.')||','''||dtvigor||''');' FROM vgftab WHERE codtab>20 ORDER BY codtab
--Itens
SELECT 'INSERT INTO ittabela VALUES ('||vgftab.codtab||','||tgfexc.codprod||','||REPLACE(vlrvenda,',','.')||');' FROM vgftab  INNER JOIN tgfexc ON (vgftab.nutab = tgfexc.nutab) WHERE codtab>20 
-----------------------*/

/* Criando tabela para controle de status (continuar...)
CREATE TABLE controlestatus (
status CHARACTER VARYING(1), 
camponome CHARACTER VARYING(50), 
tabelanome CHARACTER VARYING(50),
descrstatus CHARACTER VARYING(50),
)
*/

-- Function: stpr_incluiritem()

-- DROP FUNCTION stpr_incluiritem();

CREATE OR REPLACE FUNCTION stpr_incluiritem()
  RETURNS trigger AS
$BODY$
	DECLARE var_seqitem INTEGER;
	DECLARE var_total numeric(12,2);
	DECLARE var_total_ped numeric(12,2);
BEGIN
	SELECT COALESCE(COUNT(seqitem),0) INTO var_seqitem FROM itpedido WHERE idpedido=new.idpedido;
	IF var_seqitem=0 THEN
		var_seqitem := 1;
	ELSE 
		var_seqitem := var_seqitem+1;
	END IF;
		new.seqitem := var_seqitem;
	--Atualizando totais
	var_total := new.quant * new.valor;
	new.totalit := var_total;
	SELECT COALESCE(SUM(totalit),0) INTO var_total_ped FROM itpedido WHERE idpedido=new.idpedido;
	var_total_ped := var_total_ped + var_total;
	UPDATE pedido SET totalped=var_total_ped WHERE idpedido=new.idpedido;

	RETURN new;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION stpr_incluiritem()
  OWNER TO postgres;



  -- Função para buscar Preço
 -- DROP FUNCTION buscapreco(integer, integer);
CREATE OR REPLACE FUNCTION buscapreco(
    var_idcliente integer,
    var_idproduto integer)
  RETURNS numeric AS
$BODY$
DECLARE
	var_preco DECIMAL(12, 4);
BEGIN
	var_preco := COALESCE((SELECT ROUND (valor*(100+cli.percentual)/100,2) FROM tabela AS orig LEFT JOIN  tabela AS cli ON (orig.idtabela = cli.idtabelaorig) INNER JOIN ittabela ON (orig.idtabela = ittabela.idtabela) WHERE ittabela.idproduto=var_idproduto AND cli.idtabela=(SELECT idtabela FROM cliente WHERE idcliente=var_idcliente)),0);
	RETURN var_preco;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION buscapreco(integer, integer)
  OWNER TO postgres;



--- Teste ---
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
