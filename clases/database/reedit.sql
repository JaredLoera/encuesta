create database 
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
    ap_paterno varchar(255) not null,
    ap_materno varchar(255) not null,
    rfc varchar(16) not null,
    correo varchar(255) not null unique,
    telefono varchar(10) not null,
    pass varchar(255) not null,
    company_id int not null,
    primary key(id),
    foreign key(company_id) references company(id)
);
create table quiz(){
    id int not null auto_increment,
    nombre varchar(255) not null,
    descripcion varchar(255) not null,
    company_id int not null,
    fecha_inicio date not null,
    primary key(id),
    foreign key(company_id) references company(id)
};
create table question(){
    id int not null auto_increment,
    pregunta varchar(255) not null,
    quiz_id int not null,
    estado boolean not null default true,
    primary key(id),
    foreign key(quiz_id) references quiz(id)
};
CREATE TABLE user_answer(
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    quiz_id INT NOT NULL,
    answers JSON NOT NULL,
    fecha_respondido DATE NOT NULL,
    PRIMARY KEY(id),
    FOREIGN KEY(user_id) REFERENCES user(id),
    FOREIGN KEY(quiz_id) REFERENCES quiz(id)
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


INSERT INTO userRoot (correo, pass) VALUES ('root@gmail.com', 'root');

INSERT INTO user_answer (user_id, quiz_id, answers)
VALUES (1, 1, '{"1": "Respuesta 1", "2": "Respuesta 2", "3": "Respuesta 3"}');