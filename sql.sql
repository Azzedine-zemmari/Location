use location;

create table location.client(
id int not null primary key auto_increment,
nom varchar(40) ,
prenom varchar(40),
email varchar(60) unique ,
password text,
role enum('admin','user') default 'user'
);
select * from location.client;
insert into location.client(nom,prenom,email,password,role) values('zemmari','azzedine','azzedine@gmail.com','azzedine2004','admin');
drop table location.vehicule;
create table location.vehicule(
id int not null primary key auto_increment,
categorieId int,
model varchar(40),
mark varchar(40),
prix decimal,
disponibilite boolean,
color varchar(20),
porte int,
transmition varchar(30),
personne int,
image text,
foreign key (categorieId) references category(id)
);
insert into location.vehicule(categorieId,model,mark,prix,disponibilite,color,porte,transmition,personne,image) values(2,'Mercedes-Benz CLE
','Mercedes-Benz',5000,true,'Gris alpin',2,'automatic',2,'./image/mercedes.webp');
insert into location.vehicule(categorieId,model,mark,prix,disponibilite,color,porte,transmition,personne,image) values(1,'G 63 AMG
','Mercedes-Benz Classe G',5000,true,'Gris Monza magno ',4,'automatic',2,'./image/Gclass.webp');
create table location.category(
id int not null primary key auto_increment,
nom varchar(30) unique
);
insert into location.category(nom) values('sport');
select * from category;
use location;
select vehicule.*,category.nom AS category_name  from vehicule join category on category.id = vehicule.categorieId;
insert into location.category(nom) values('lux');
insert into location.vehicule(categorieId,model,mark,prix,disponibilite,color,porte,transmition,personne,image) values(1,'718 Cayman','porsche',300,true,'GT Silver Metallic',2,'automatic',2,'./image/718-cayman-style-edition-front.avif');
drop table location.reservation;
create table location.reservation(
id int not null primary key auto_increment,
userId int,
vehiculeId int,
date_debut date,
date_fin date,
lieuId int,
foreign key (lieuId) references lieu(id),
foreign key (userId) references client(id),
foreign key (vehiculeId) references vehicule(id)
);

create table location.lieu(
id int not null primary key auto_increment,
lieuName varchar(40) unique
);
select * from location.reservation;
insert into location.lieu(lieuName) values("tanger");
drop table location.avis;
create table location.avis(
id int not null primary key auto_increment,
userId int,
vehiculeId int,
avis enum('null','pas mal','bien','satisfer'),
updated_at TIMESTAMP,
deleted_at TIMESTAMP,
foreign key (userId) references client(id),
foreign key (vehiculeId) references vehicule(id)
);

select * from location.avis;
ALTER TABLE location.avis
ADD comment varchar(255);

create view getReviews as select avis.*,client.nom from location.avis join location.client on location.avis.userId = location.client.id;
	select * from getReviews;
CREATE or replace  VIEW ListeVehicules AS 
        SELECT vehicule.*, category.nom AS category_name  
        FROM vehicule 
        JOIN category 
        ON category.id = vehicule.categorieId;
        
select * from ListeVehicules;


create view Vehicule_Category_View as select vehicule.*,category.nom AS category_name  
        from vehicule 
        join category on
        category.id = vehicule.categorieId;

select * from Vehicule_Category_View;