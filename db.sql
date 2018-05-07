#Criação do banco de dados MYSQL
#==========================================

#CREATE DATABASE crud_oo DEFAULT CHARSET utf8 DEFAULT COLLATE utf8_general_ci;

#USE crud_oo;

#tabela produtos
#==========================================
CREATE TABLE produtos(
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  categoria VARCHAR(100) NOT NULL,
  data_ DATETIME NOT NULL
) DEFAULT CHARSET utf8;

drop TABLE produtos;

SELECT * FROM produtos;

desc produtos;
