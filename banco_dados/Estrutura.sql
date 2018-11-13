DROP DATABASE IF EXISTS mercearia;

CREATE DATABASE mercearia DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE mercearia;

CREATE TABLE cargo
(
	id_cargo INTEGER NOT NULL,
    nome VARCHAR(50) NOT NULL,
    
    CONSTRAINT pk_cargo PRIMARY KEY (id_cargo)
) ENGINE = INNODB;

CREATE TABLE usuarios
(
	cpf VARCHAR(11) NOT NULL,
    nome_completo VARCHAR(75) NOT NULL,
    email VARCHAR(120) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    data_nascimento DATE NOT NULL,
    sexo BIT NOT NULL,
    cep VARCHAR(8) NOT NULL,
    endereco VARCHAR(200) NOT NULL,
    numero INTEGER NOT NULL,
    complemento VARCHAR(150) NULL,
    bairro VARCHAR(100) NOT NULL,
    cidade VARCHAR(100) NOT NULL,
    uf CHAR(2) NOT NULL,
    nivel ENUM('cliente','func','admin'),
    cargo INTEGER NULL,
    data_cadastro TIMESTAMP NOT NULL,
    data_finalizacao TIMESTAMP NULL,
    
    CONSTRAINT pk_usuarios PRIMARY KEY (cpf),
    CONSTRAINT un_cpf UNIQUE (cpf),
    CONSTRAINT un_email UNIQUE (email),
    CONSTRAINT fk_cargo FOREIGN KEY (cargo) REFERENCES cargo (id_cargo)
) ENGINE = INNODB;

CREATE TABLE estoque
(
	id_produto INTEGER NOT NULL,
    nome_produto VARCHAR(100) NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    posicao_estoque VARCHAR(50) NOT NULL,
    qtd_atual INTEGER NOT NULL,
    qtd_max INTEGER NOT NULL,
    qtd_min INTEGER NOT NULL,
    
    CONSTRAINT pk_estoque PRIMARY KEY (id_produto),
    CONSTRAINT un_produto UNIQUE (id_produto)
) ENGINE = INNODB;

CREATE TABLE historico_cadastro
(
	id_historico INTEGER NOT NULL,
    data_horario TIMESTAMP NOT NULL,
    funcionario VARCHAR(11) NOT NULL,
    produto INTEGER NOT NULL,
    operacao ENUM('add','editar','deletar') NOT NULL,
    
    CONSTRAINT pk_historico PRIMARY KEY (id_historico),
    CONSTRAINT un_historico UNIQUE (id_historico),
	CONSTRAINT fk_funcionario_historico FOREIGN KEY (funcionario) REFERENCES usuarios (cpf),
    CONSTRAINT fk_produto_historico FOREIGN KEY (produto) REFERENCES estoque (id_produto)
) ENGINE = INNODB;

CREATE TABLE venda
(
	id_venda INTEGER NOT NULL,
    produto INTEGER NOT NULL,
    cliente VARCHAR(11) NOT NULL,
    qtd_produto INTEGER NOT NULL,
    forma_pgto ENUM('dinheiro','cheque','debito','credito','transferencia','paypal','pagseguro','boacompra','mercado pago') NOT NULL,
    desconto INTEGER NULL,
    valor_total DECIMAL(10,2) NOT NULL,
    data_compra TIMESTAMP NOT NULL,
    relatorio BLOB NOT NULL,
    
    CONSTRAINT pk_venda PRIMARY KEY (id_venda),
    CONSTRAINT un_venda UNIQUE (id_venda),
    CONSTRAINT fk_cliente_venda FOREIGN KEY (cliente) REFERENCES usuarios (cpf),
    CONSTRAINT fk_produto_venda FOREIGN KEY (produto) REFERENCES estoque (id_produto)
) ENGINE = INNODB;