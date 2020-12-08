CREATE TABLE pessoa
(
	id_pessoa INTEGER PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	cpf VARCHAR(20) NOT NULL UNIQUE,
  telefone VARCHAR(80) UNIQUE,
  email VARCHAR(30) UNIQUE, 
	CHECK((INSTR(email,'@') > 0) AND (INSTR(email,'.') > 0)),
	data_nascimento DATE NOT NULL,
  comprovante BLOB,
	tipo_pessoa INTEGER, 
	status_cadastro INT NOT NULL,
  descricao VARCHAR(80) NOT NULL,
	senha VARCHAR(80) NOT NULL,
  foto BLOB,
  sexo INT,
  cidade VARCHAR(80) NOT NULL
);

CREATE TABLE diaria_prestador
(
	id_diaria INTEGER PRIMARY KEY AUTO_INCREMENT,
	descricao_diaria VARCHAR(400) NOT NULL,
	valor DECIMAL(10,2) NOT NULL,
	id_pessoa INTEGER,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);

CREATE TABLE administrador 
(
	id_adm INT NOT NULL AUTO_INCREMENT,
	nome_adm VARCHAR(55) NULL,
	PRIMARY KEY (id_adm)
 );
 
 ALTER TABLE administrador 
CHANGE COLUMN nome_adm sessao VARCHAR(55) NOT NULL;

INSERT INTO administrador (id_adm, sessao) VALUES ('1', 'Adm_Teste');

CREATE TABLE endereco (
  id_endereco INT NOT NULL AUTO_INCREMENT,
  bairro VARCHAR(100) NOT NULL,
  rua VARCHAR(100) NOT NULL,
  numero INT NOT NULL,
  complemento VARCHAR(100) NULL,
  cep VARCHAR(10) NULL,
  PRIMARY KEY (id_endereco),
  id_pessoa INTEGER,
  FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);

CREATE TABLE servico
 (
  id_servico INT NOT NULL,
  data_servico DATE NOT NULL,
  hora TIME NULL,
  valor DECIMAL(10,2),
  id_endereco INT NOT NULL,
  forma_pagamento VARCHAR(55) NOT NULL,
  avaliacao INT NULL,
  status_servico INT NULL DEFAULT 1 ,
  id_prestador INT NOT NULL,
  id_contratante INT NOT NULL,
  id_diaria INT NOT NULL,
  PRIMARY KEY (id_servico)
);

ALTER TABLE servico
ADD FOREIGN KEY (id_contratante) REFERENCES pessoa(id_pessoa);

ALTER TABLE servico
ADD FOREIGN KEY (id_prestador) REFERENCES pessoa(id_pessoa);

ALTER TABLE servico
ADD FOREIGN KEY (id_diaria) REFERENCES diaria_prestador(id_diaria);

ALTER TABLE servico
ADD FOREIGN KEY (id_endereco) REFERENCES endereco(id_endereco);