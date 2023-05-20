create database encuestas;
use encuestas;
create table userRoot(
    id int not null auto_increment,
    correo varchar(255) not null unique,
    pass varchar(255) not null,
    primary key(id)
);
create table company(
    id int not null auto_increment,
    nombre varchar(255) not null,
    refimenFiscal varchar(255) not null,
    domicilio varchar(255) not null,
    pass varchar(255) not null,
    correo varchar(255) not null unique,
    primary key(id)
);
create table user(
    id int not null auto_increment,
    nombre varchar(255) not null,
    rfc varchar(16) not null,
    correo varchar(255) not null unique,
    pass varchar(255) not null,
    company_id int not null,
    primary key(id),
    foreign key(company_id) references company(id)
);
create table pregunta(
    id int not null auto_increment,
    pregunta varchar(255) not null,
    /*company_id int not null,*/
    primary key(id),
    /*foreign key(company_id) references company(id)*/
);
create table respuestasUser(
    id int not null auto_increment,
    user_id int not null,
    pregunta_id int not null,
    respuesta varchar(255) not null,
    primary key(id),
    foreign key(user_id) references user(id),
    foreign key(pregunta_id) references pregunta(id)
);
