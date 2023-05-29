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


INSERT INTO quiz (nombre, descripcion, company_id, fecha_inicio) VALUES 
('capitulo 1', 'Cuestionario para identificar los factores de riesgo psicosocial en los centros de trabajo', 1, '2020-10-10');

INSERT INTO user (nombre, ap_paterno, ap_materno, rfc, correo, telefono, pass, company_id) VALUES 
('Juan', 'Perez', 'Lopez', 'PELJ920101', 'juan@gmail.com', '8711706749', '123456', 1);

INSERT INTO question (pregunta,quiz_id) VALUES 
('Mi trabajo me exige hace mucho esfuerzo',1),
("Me preocupa sufrir un accidente laboral",1),
("Considero que las actividades que realizo son peligrosas",1),
("Por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno",1),
("Por la cantidad de trabajo que tengo debo trabajar sin parar",1),
("Considero que es necesario mantener un ritmo de trabajo acelerado",1),
("Mi trabajo exige que esté muy concentrado",1),
("Mi trabajo requiere que memorice mucha información",1),
("Mi trabajo exige que atienda varios asuntos al mismo tiempo",1);

INSERT INTO company (nombre, regimenFiscal, domicilio, contacto_id) VALUES 
('Empresa 1', 'Regimen Fiscal 1', 'Domicilio 1', 1);

INSERT INTO userRoot (correo, pass) VALUES ('root@gmail.com', 'root');
INSERT INTO contacto (pass, correo, tipo_user_id) VALUES ('123456789', 'root@gmail.com', 1);

INSERT INTO user_answer (user_id, quiz_id, answers)
VALUES (1, 1, '{"1": "Respuesta 1", "2": "Respuesta 2", "3": "Respuesta 3"}');

alter table quiz add column capitulo_id int not null;
alter table quiz add foreign key(capitulo_id) references capitulo(id);


/*CONSULTAS*/

/*Examenes sin contestar de detemrinado usuario*/
SELECT * from (select CI.user_id_table,quiz_id,CI.empresa from (select user.id as user_id_table,company_id as empresa from user where contacto_id = 3 ) as CI join user_answer on user_answer.user_id = CI.user_id_table)as UUA right join quiz on quiz.id = UUA.quiz_id where quiz.capitulo_id=1 and user_id_table is null;


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