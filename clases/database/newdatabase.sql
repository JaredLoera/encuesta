drop database tercerEjemplo;
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
    nombre_examen varchar(255) not null,
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
    calsificacion int not null,
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


DELIMITER $$ 
DROP PROCEDURE IF EXISTS `crearCapitulos` $$
CREATE PROCEDURE `crearCapitulos`(IN empresa_id INT)
BEGIN
    INSERT INTO capitulo (numcapitulo, company_id, descripcion, nombre_examen) VALUES 
    (1, empresa_id, "El trabajador considerara las condiciones de su centro de trabajo asi como la calidad y ritmo de trabajo", "Condiciones del centro de trabajo"),
    (2, empresa_id, "Las siguientes preguntas están relacionadas con las actividades que realiza en us trabajo y las responsabilidades que tiene", "responsabilidades- del trabajo"),
    (3, empresa_id, "Las siguientes preguntas están relacionadas con el tiempo destinado a su trabajo y a sus responsabilidades familiares", "Tiempo en el trabajo y casa"),
    (4, empresa_id, "Las siguientes preguntas están relacionadas con las decisiones que puede tomar en su trabajo", "Decisiones en el trabajo"),
    (5, empresa_id, "Las preguntas siguientes están relacionadas con la capacitación e información que recibe su trabajo", "Capacitación e información en el trabajo"),
    (6, empresa_id, "Las preguntas siguientes están relacionadas con las relaciones con sus compañeros de trabajo y su jefe", "Relaciones en el trabajo"),
    (7, empresa_id, "Las siguientes preguntas están relacionadas con las actitudes de los trabajadores que supervisa","Supervisiones con empelados");
      
END$$
DELIMITER ;

DELIMITER $$ 
DROP PROCEDURE IF EXISTS `preguntasCapitulo1` $$
CREATE PROCEDURE `preguntasCapitulo1`(IN capitulo_id INT)
BEGIN
	INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi trabajo me exige hacer mucho esfuerzo físico",capitulo_id,1);/*1*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("me preocupa sufrir un accidente en mi trabajo",capitulo_id,1);/*2*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("considero que las actividades que realizo son peligrosas",capitulo_id,1);/*3*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("por la cantidad de trabajo que tengo debo quedarme tiempo adicional a mi turno",capitulo_id,1);/*4*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("por la cantidad de trabajo que tengo debo trabajar sin parar",capitulo_id,1);/*5*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("considero que es necesario mantener un ritmo de trabajo acelerado",capitulo_id,1);/*6*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi trabajo exige que esté muy concentrado",capitulo_id,1);/*7*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi trabajo requiere que memorice mucha información",capitulo_id,1);/*8*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi trabajo exige que atienda varios asuntos al mismo tiempo",capitulo_id,1);/*9*/

    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("en mi trabajo soy responsable de cosas de mucho valor",capitulo_id,1);/*10*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("respondo ante mi jefe por los resultados de toda mi área de trabajo",capitulo_id,1);/*11*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("en mi trabajo me dan órdenes contradictorias",capitulo_id,1);/*12*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("considero que en mi trabajo me piden hacer cosas innecesarias",capitulo_id,1);/*13*/
    
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("trabajo horas extras más de tres veces a la semana",capitulo_id,1);/*14*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi trabajo me exige laborar en días de descanso, festivos o fines de semana",capitulo_id,1);/*15*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("considero que el tiempo en el trabajo es mucho y perjudica mis actividades familiares o personales",capitulo_id,1);/*16*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("pienso en las actividades familiares o personales cuando estoy en mi trabajo",capitulo_id,1);/*17*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi trabajo permite que desarrolle nuevas habilidades",capitulo_id,2);/*18*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("en mi trabajo puedo aspirar a un mejor puesto",capitulo_id,2);/*19*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("durante mi jornada de trabajo puedo tomar pausas cuando las necesito",capitulo_id,2);/*20*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("puedo decidir cuánto trabajo realizo durante la jornada laboral",capitulo_id,2);/*21*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("puedo decidir la velocidad a la que realizo mis actividades en mi trabajo",capitulo_id,2);/*22*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("me informan con claridad cuáles son mis funciones",capitulo_id,2);/*23*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("me explican claramente los resultados que debo obtener en mi trabajo",capitulo_id,2);/*24*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("me informan con quién puedo resolver problemas o asuntos de trabajo",capitulo_id,2);/*25*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("me permiten asistir a capacitaciones relacionadas con mi trabajo",capitulo_id,2);/*26*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("recibo capacitación útil para hacer mi trabajo",capitulo_id,2);/*27*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi jefe tiene en cuenta mis puntos de vista y opiniones",capitulo_id,2);/*28*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mi jefe ayuda a solucionar los problemas que se presentan en el trabajo",capitulo_id,2);/*29*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("puedo confiar en mis compañeros de trabajo",capitulo_id,2);/*30*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("cuando tenemos que realizar trabajo de equipo los compañeros colaboran",capitulo_id,2);/*31*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("mis compañeros de trabajo me ayudan cuando tengo dificultades",capitulo_id,2);/*32*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("en mi trabajo puedo expresarme libremente sin interrupciones",capitulo_id,2);/*33*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("recibo críticas constantes a mi persona y/o trabajo",capitulo_id,1);/*34*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("recibo burlas, calumnias, difamaciones, humillaciones o ridiculizaciones",capitulo_id,1);/*35*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("se ignora mi presencia o se me excluye de las reuniones de trabajo y en la toma de decisiones",capitulo_id,1);/*36*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("se manipulan las situaciones de trabajo para hacerme parecer un mal trabajador",capitulo_id,1);/*37*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("se ignoran mis éxitos laborales y se atribuyen a otros trabajadores",capitulo_id,1);/*38*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("me bloquean o impiden las oportunidades que tengo para obtener ascenso o mejora en mi trabajo",capitulo_id,1);/*39*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("he presenciado actos de violencia en mi centro de trabajo",capitulo_id,1);/*40*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("comunican tarde los asuntos del trabajo",capitulo_id,1);/*41*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("dificultan el logro de los resultados del trabajo",capitulo_id,1);/*42*/
    INSERT INTO question (pregunta,capitulo_id,calsificacion) VALUE("ignoran las sugerencias para mejorar su trabajo",capitulo_id,1);/*43*/
END$$
DELIMITER ;

