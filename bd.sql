create database simulado;
use simulado;

create table usuarios(
id int auto_increment primary key,
nome varchar(40),
email varchar(40),
senha varchar(50)
);

create table clientes(
id_cliente int auto_increment primary key,
nome varchar(40),
cpf varbinary(40),
telefone varchar(20)
);

create table veiculos(
id int auto_increment primary key,
placa varchar(10),
modelo varchar(50),
cliente_id int, foreign key(cliente_id) references clientes(id_cliente)
);

create table agendamentos(
id int auto_increment primary key,
data_agendamento datetime,
descricao text,
cliente_id int,
veiculo_id int,
foreign key (cliente_id) references clientes(id_cliente),
foreign key (veiculo_id) references veiculos(id)
);

insert into usuarios (nome, email, senha) values
('Admin','admin@oficina.com',MD5('123456')),
('Maria','maria@oficina.com',MD5('123456')),
('Carlos','admin@oficina.com',MD5('123456'));

select * from usuarios

insert into clientes (nome, cpf, telefone) values
('João', aes_encrypt('111.222.333-44', 'chave'), '(11) 99999-1111'),
('Paulo', aes_encrypt('222.333.444-55', 'chave'), '(11) 99999-2222'),
('Pedro', aes_encrypt('333.444.555-66', 'chave'), '(11) 99999-3333');

select * from clientes


insert into veiculos (placa, modelo, cliente_id) values
('ABC1234','GOL', 1),
('XYZ9876','Civic', 2),
('XGY5544','Corolla', 3);

select * from veiculos

insert into agendamentos (data_agendamento, descricao, cliente_id, veiculo_id) values
('2026-10-15 09:00:00', 'Troca de oleo', 1, 1),
('2026-10-16 14:00:00', 'Revisao freios', 2, 2),
('2026-10-17 10:30:00', 'Alinhamento', 3, 3);


select * from agendamentos

drop database simulado

-- A primeira chave é a primeira chave estrangeira a ser usada--

-- varbinary bloquea o acesso para ver a informação--