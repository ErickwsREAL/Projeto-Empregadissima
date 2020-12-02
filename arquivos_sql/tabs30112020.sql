CREATE TABLE pessoa
(
	pessoa INTEGER PRIMARY KEY AUTO_INCREMENT,
	nome VARCHAR(100) NOT NULL,
	cpf VARCHAR(20) NOT NULL UNIQUE,
   	telefone VARCHAR(80) UNIQUE,
    email VARCHAR(30) UNIQUE, 
	CHECK((INSTR(email,'@') > 0) AND (INSTR(DS_EMAIL,'.') > 0)),
	data_nascimento DATE NOT NULL,
   	comprovante BLOB,
	tipo_pessoa INTEGER, /**/
	status_cadastro DATE NOT NULL,
    descricao VARCHAR(80) NOT NULL,
   	email VARCHAR(80) NOT NULL,
	senha INTEGER NOT NULL,
    foto BLOB,
    sexo INT
);

CREATE TABLE diaria_prestador
(
	id_diaria INTEGER PRIMARY KEY AUTO_INCREMENT,
	descricao_diaria VARCHAR(400) NOT NULL,
	valor DECIMAL(10,2) NOT NULL,
	id_pessoa INTEGER,
	FOREIGN KEY(id_pessoa) REFERENCES pessoa(id_pessoa)
);
