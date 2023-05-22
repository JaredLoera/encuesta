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
alter table user add column telefono varchar(10) not null;
alter table user add column ap_paterno varchar(255);
alter table user add column ap_materno varchar(255);
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

INSERT INTO `encuestas`.`pregunta` (`pregunta`) VALUES 
('Mi trabajo me exige hace mucho esfuerzo'),
("Me preocupa sufrir un accidente laboral"),
("Considero que las actividades que realizo son peligrosas"),
("Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno"),
("Por la cantidad de trabajo que tengo debo trabajar sin parar"),
("Considero que es necesario mantener un ritmo de trabajo acelerado"),
("Mi trabajo exige que esté muy concentrado"),
("Mi trabajo requiere que memorice mucha información"),
("Mi trabajo exige que atienda varios asuntos al mismo tiempo");

SELECT COUNT(*) as num FROM user LEFT JOIN respuestasuser on user.id = respuestasuser.user_id WHERE respuestasuser.user_id is null;

SELECT count(DISTINCT user.id) as sum from user join respuestasuser on user.id =respuestasuser.user_id group by user.id;
SELECT * FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id WHERE pregunta.id = 1;
SELECT COUNT(*) as num FROM respuestasuser JOIN pregunta on respuestasuser.pregunta_id = pregunta.id WHERE respuestasuser.respuesta = "siempre" AND pregunta.id = 1;
SELECT * FROM respuestasuser WHERE respuestasuser.user_id = 15;