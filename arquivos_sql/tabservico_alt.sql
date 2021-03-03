/*Alterando a coluna hora para hora entrada e adicionando a hora saida na tabela serviço 03/03/2021*/
ALTER TABLE servico 
ADD COLUMN hora_saida TIME NOT NULL AFTER id_diaria,
CHANGE COLUMN hora hora_entrada TIME NOT NULL;