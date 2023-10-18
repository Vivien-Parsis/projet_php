DROP DATABASE IF EXISTS project_php;
CREATE DATABASE project_php;
USE project_php;
DROP TABLE IF EXISTS todo;
DROP TABLE IF EXISTS agenda;
DROP TABLE IF EXISTS utilisateurs;

CREATE TABLE utilisateurs(
  id_utilisateurs int PRIMARY KEY AUTO_INCREMENT NOT NULL,
  mail_utilisateurs varchar(100) NOT NULL,
  password_utilisateurs varchar(100) NOT NULL,
  prenom_utilisateurs varchar(100) NOT NULL,
  nom_utilisateurs varchar(100) NOT NULL
);

INSERT INTO utilisateurs (id_utilisateurs, mail_utilisateurs, password_utilisateurs, prenom_utilisateurs, nom_utilisateurs) VALUES
(1,'vivien.parsis@todo.com','Viv13Todo!','Vivien','PARSIS'),(2,'lucas.hugo@gmail.com','Hug27Luc','Lucas','HUGO'),(3,'MathieuT@outlook.com','Thieu89Todo.','Mathieu','Thieu'); 

CREATE TABLE todo (
  id_todo int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  objectif_todo varchar(1000) NOT NULL,
  done_todo tinyint(1) NOT NULL,
  id_utilisateurs int NOT NULL,
  FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs(id_utilisateurs) ON DELETE CASCADE
);

INSERT INTO todo (id_todo,done_todo,id_utilisateurs,objectif_todo) VALUES
(1,0,2,'Integer at odio porta, finibus mi vel, bibendum orci. Duis elit est, ornare in ornare eu, dictum et nulla. Pellentesque libero enim, consectetur sed lectus vitae, tristique interdum nisi. Suspendisse eget tempor erat, et cursus risus. Nam purus velit, facilisis a placerat tempus, consequat vitae mi. Nulla rhoncus, quam non imperdiet malesuada, erat enim sollicitudin nisi, in interdum orci mauris sit amet leo. Donec sagittis ligula ipsum, et pharetra augue porta ut. Donec vel posuere quam. Phasellus facilisis ligula a sem pretium, eu consequat nibh mattis. Fusce id turpis eget elit maximus laoreet eget nec turpis. Duis id sem lobortis, ornare turpis in, tempor augue. Donec at magna vel leo varius ullamcorper non ut elit.'),
(2,1,2,'Nulla facilisi. Maecenas tristique dolor in enim porttitor laoreet. Duis venenatis tincidunt purus, sed suscipit lorem rutrum ac. Proin mauris massa, blandit sit amet porttitor fermentum, pharetra sit amet diam. Aliquam id pulvinar orci, id condimentum lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed elementum risus tellus, nec pharetra tortor feugiat id. Fusce pretium tincidunt efficitur. Praesent ut sodales neque. Duis imperdiet, risus vitae commodo fringilla, metus nibh egestas lectus, sed congue lorem enim nec ex. Duis nec porttitor diam. Donec aliquet metus eu ante cursus tempor. Nunc malesuada mi venenatis, tincidunt est suscipit, tempor nunc. Sed scelerisque erat id magna dictum, ut posuere mauris sodales. Suspendisse interdum posuere tellus, ut commodo metus sagittis ut.'),
(3,0,1,'Nulla facilisi. Maecenas tristique dolor in enim porttitor laoreet. Duis venenatis tincidunt purus, sed suscipit lorem rutrum ac. Proin mauris massa, blandit sit amet porttitor fermentum, pharetra sit amet diam. Aliquam id pulvinar orci, id condimentum lorem. Interdum et malesuada fames ac ante ipsum primis in faucibus. Sed elementum risus tellus, nec pharetra tortor feugiat id. Fusce pretium tincidunt efficitur. Praesent ut sodales neque. Duis imperdiet, risus vitae commodo fringilla, metus nibh egestas lectus, sed congue lorem enim nec ex. Duis nec porttitor diam. Donec aliquet metus eu ante cursus tempor. Nunc malesuada mi venenatis, tincidunt est suscipit, tempor nunc. Sed scelerisque erat id magna dictum, ut posuere mauris sodales. Suspendisse interdum posuere tellus, ut commodo metus sagittis ut.');

CREATE TABLE agenda (
  id_agenda int PRIMARY KEY NOT NULL AUTO_INCREMENT,
  evenement_agenda varchar(150) NOT NULL,
  date_debut_agenda datetime NOT NULL,
  date_fin_agenda datetime NOT NULL,
  id_utilisateurs int NOT NULL,
  FOREIGN KEY (id_utilisateurs) REFERENCES utilisateurs(id_utilisateurs) ON DELETE CASCADE 
);

INSERT INTO agenda (id_agenda,id_utilisateurs,evenement_agenda,date_debut_agenda,date_fin_agenda) values 
(1,2,"cours français", "2023-04-23 12:00:00","2023-04-23 13:00:00"),(2,2,"cours philo", "2023-04-23 08:00:00","2023-04-23 09:00:00"),
(3,1,"cours math", "2023-11-02 16:00:00","2023-11-02 18:00:00"),(4,1,"cours info", "2023-10-25 11:00:00","2023-10-25 17:00:00"),
(5,3,"anniversaire de untel", "2023-12-23 12:00:00","2023-12-23 13:00:00");