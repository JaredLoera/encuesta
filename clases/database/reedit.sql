create database tercerEjemplo;
use tercerEjemplo;

create table tipo_user(
    id int not null auto_increment,
    nombre varchar(255) not null,
    primary key(id)
);
INSERT INTO tipo_user (nombre) VALUES ('root'), ('company'), ('worker');
create table contacto(
    id int not null auto_increment,
    pass varchar(255) not null,
    correo varchar(255) not null unique,
    tipo_user_id int not null,
    foreign key(tipo_user_id) references tipo_user(id),
    primary key(id)
);
create table company(
    id int not null auto_increment,
    nombre varchar(255) not null,
    refimenFiscal varchar(255) not null,
    domicilio varchar(255) not null,
    contacto_id int not null,
    foreign key(contacto_id) references contacto(id),
    primary key(id)
);
create table user(
    id int not null auto_increment,
    nombre varchar(255) not null,
    ap_paterno varchar(255) not null,
    ap_materno varchar(255) not null,
    rfc varchar(16) not null,
    telefono varchar(10) not null,
    company_id int not null,
    contacto_id int not null,
    primary key(id),
    foreign key(company_id) references company(id),
    foreign key(contacto_id) references contacto(id)
);
create table capitulo(
    id int not null auto_increment,
    numcapitulo int not null,
    company_id int not null,
    descripcion varchar(255) not null,
    primary key(id),
    foreign key(company_id) references company(id)
);
create table quiz(
    id int not null auto_increment,
    capitulo_id int not null,
    fecha_inicio datetime not null default current_timestamp,
    primary key(id),
    foreign key(capitulo_id) references capitulo(id)
);
create table question(
    id int not null auto_increment,
    pregunta varchar(255) not null,
    capitulo_id int not null,
    estado boolean not null default true,
	fecha_pregunta datetime not null default current_timestamp,
    primary key(id),
    foreign key(capitulo_id) references capitulo(id)
);
CREATE TABLE user_answer(
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    answers JSON NOT NULL,
    fecha_respondido datetime not null default current_timestamp,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES user(id),
    FOREIGN KEY(quiz_id) REFERENCES quiz(id)
);