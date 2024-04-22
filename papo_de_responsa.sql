create database papo_de_responsa;
use papo_de_responsa;

create table Multiplicador(
    id_multiplicador INT AUTO_INCREMENT PRIMARY KEY,
	nome_multiplicador VARCHAR(100) NOT NULL,
    email_multiplicador VARCHAR(100) UNIQUE NOT NULL,
    senha_multiplicador VARCHAR(100) NOT NULL,
    matricula varchar(100) not null,
    cpf_multiplicador varchar(20) not null,
    endereco_multiplicador varchar(255) not null,
    status_multiplicador char(1) DEFAULT 'A'
);-- STATUS: A = Ativo, I =Inativo

create table Solicitante(
    id_Solicitante INT AUTO_INCREMENT PRIMARY KEY,
	cnpj VARCHAR(30) NOT NULL,
    email_solicitante VARCHAR(100) UNIQUE NOT NULL,
    senha_solicitante VARCHAR(100) NOT NULL,
    responsavel varchar(100) not null,
    tipo_escola varchar(30) not null,
    endereco_solicitante varchar(255) not null,
    status_solicitante char(1) DEFAULT 'A'
);-- STATUS: A = Ativo, I =Inativo

create table Contato(
    id_contato INT AUTO_INCREMENT PRIMARY KEY,
    id_solicitante int not null,
    numero_contato varchar(20),
	status_contato CHAR(1) DEFAULT 'A',
	FOREIGN KEY (id_solicitante) REFERENCES Solicitante(id_Solicitante)
);-- STATUS: A = Ativo, I =Inativo

CREATE TABLE solicitacao (
    id_solicitacao INT AUTO_INCREMENT PRIMARY KEY,
    id_solicitante INT NOT NULL,
    id_multiplicador INT ,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    descricao TEXT,
    status_solicitacao CHAR(1) DEFAULT 'A',
    FOREIGN KEY (id_solicitante) REFERENCES Solicitante(id_Solicitante),
    FOREIGN KEY (id_multiplicador) REFERENCES Multiplicador(id_multiplicador)
);-- STATUS: A = Ativo, I =Inativo


INSERT INTO Multiplicador (nome_multiplicador, email_multiplicador, senha_multiplicador,matricula, cpf_multiplicador, endereco_multiplicador)
VALUES 
('João Silva', 'joao.silva@email.com', 'senha123','231213131', '123.456.789-00', 'Rua A, 123 - Cidade'),
('Maria Oliveira', 'maria.oliveira@email.com', 'senha456','123121321321', '987.654.321-00', 'Rua B, 456 - Cidade');


INSERT INTO Solicitante (cnpj, email_solicitante, senha_solicitante, responsavel, tipo_escola, endereco_solicitante)
VALUES 
('12.345.678/0001-01', 'escola@email.com', 'senha789', 'José', 'Escola Municipal', 'Rua X, 789 - Cidade'),
('98.765.432/0001-02', 'creche@email.com', 'senha012', 'Ana', 'Creche', 'Rua Y, 012 - Cidade');


INSERT INTO solicitacao (id_solicitante, id_multiplicador, descricao)
VALUES 
(1, 1, 'Solicitação de palestra sobre suicidio'),
(2, null, 'Solicitação de palestra sobre maconha');



