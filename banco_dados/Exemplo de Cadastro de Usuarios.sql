USE mercearia;

# Cadastro de cargos
INSERT INTO cargo(id_cargo,nome) VALUES(1,'caixa');
INSERT INTO cargo(id_cargo,nome) VALUES(2,'estoque');
INSERT INTO cargo(id_cargo,nome) VALUES(3,'entregador');
INSERT INTO cargo(id_cargo,nome) VALUES(4,'gerente');
INSERT INTO cargo(id_cargo,nome) VALUES(5,'proprietário');
INSERT INTO cargo(id_cargo,nome) VALUES(6,'administrador');

# Cadastro de usuários
INSERT INTO usuarios(cpf,nome_completo,email,senha,data_nascimento,sexo,cep,endereco,numero,complemento,bairro,cidade,uf,nivel,cargo,data_cadastro,data_finalizacao)
VALUES('07821928909','Gustavo Rattmann','gustavo_rattmann@hotmail.com.br','teste','1995/12/20',1,'83065540','Rua Pedro Cordeiro da Cruz',146,NULL,'Iná','São José dos Pinhais','PR','func',6,NOW(),NULL);
INSERT INTO usuarios(cpf,nome_completo,email,senha,data_nascimento,sexo,cep,endereco,numero,complemento,bairro,cidade,uf,nivel,cargo,data_cadastro,data_finalizacao)
VALUES('59960566900','Lucia Delvani do Nascimento','lucia_delvani@hotmail.com.br','12345','1961/08/25',0,'83065540','Rua Pedro Cordeiro da Cruz',146,NULL,'Iná','São José dos Pinhais','PR','func',1,NOW(),NULL);
/*INSERT INTO usuarios(cpf,nome_completo,email,senha,data_nascimento,sexo,cep,endereco,numero,complemento,bairro,cidade,uf,nivel,cargo,data_cadastro,data_finalizacao)
VALUES('12345678901','Rene Renato Rattmann','renato_sapo@hotmail.com','54321','1962/09/14',1,'83065540','Rua Pedro Cordeiro da Cruz',146,NULL,'Iná','São José dos Pinhais','PR','cliente',NULL,NOW(),NULL);*/

SELECT * FROM usuarios;