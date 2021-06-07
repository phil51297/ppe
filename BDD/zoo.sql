drop database if exists zoo;
create database zoo;
use zoo

CREATE TABLE users (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL UNIQUE,
    nom varchar(25) DEFAULT NULL,
    prenom varchar(25) DEFAULT NULL,
    date_naissance date DEFAULT NULL,
    tel char(14) DEFAULT NULL,
    adresse varchar(100) DEFAULT NULL,
    email varchar(30) DEFAULT NULL,
    user_type varchar(30) DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE `products` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `price` float(10,2) NOT NULL,
 `status` tinyint(1) NOT NULL DEFAULT 1,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `orders` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `total_qty` int(11) NOT NULL,
 `total_amount` float(10,2) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `order_items` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `product_id` int(11) NOT NULL,
 `quantity` int(5) NOT NULL,
 `gross_amount` float(10,2) NOT NULL,
 PRIMARY KEY (`id`),
 KEY `order_id` (`order_id`),
 KEY `product_id` (`product_id`),
 CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
 CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `payments` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `order_id` int(11) NOT NULL,
 `payer_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `payer_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
 `txn_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
 `payment_gross` float(10,2) NOT NULL,
 `currency_code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
 `payment_status` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
 PRIMARY KEY (`id`),
 KEY `order_id` (`order_id`),
 CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

create table contact (
  id_contact int(3) not null auto_increment,
  nomcontact varchar(30),
  tel char(15),
  email varchar(30),
  message text(400),
  primary key(id_contact)
  )ENGINE=INNODB DEFAULT CHARSET=utf8;

create table espece (
  id_espece int(2) not null,
  nomespece varchar(25),
  primary key(id_espece)
  )ENGINE=INNODB DEFAULT CHARSET=utf8;

create table enclos (
  num_enclos int(2) not null,
  zone varchar(20),
  primary key(num_enclos)
  )ENGINE=INNODB DEFAULT CHARSET=utf8;

create table animal (
  id_animal int(3) not null auto_increment,
  nomanimal varchar(30),
  datenaiss date,
  datedeces date,
  sexe char(1),
  id_espece int(2),
  num_enclos int(2),
  primary key(id_animal),
  foreign key(num_enclos) REFERENCES enclos(num_enclos),
  foreign key(id_espece) REFERENCES espece(id_espece)
  ON DELETE CASCADE
  ON UPDATE CASCADE
)ENGINE=INNODB DEFAULT CHARSET=utf8;

create table evenement (
  id_evenement int not null auto_increment,
  nom_evenement varchar (30),
  datedeb date,
  datefin date,
  primary key(id_evenement)
  )ENGINE=INNODB DEFAULT CHARSET=utf8;

CREATE VIEW Animalvue AS
SELECT animal.nomanimal, animal.datenaiss, animal.sexe, animal.num_enclos
FROM animal
WHERE datedeces IS null
ORDER BY animal.num_enclos;

CREATE VIEW Evenementvue AS
SELECT nom_evenement, datedeb, datefin
FROM evenement
ORDER BY datedeb;


INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 'ticket -18', 'product_image1.jpg', '6.00');
INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 'ticket +18', 'product_image1.jpg', '12.00');
INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 'offre familial', 'product_image1.jpg', '26.00');
INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 'offre etudiant', 'product_image1.jpg', '9.00');
INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 't-shirt', 'product_image2.jpg', '15.00');
INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 'pass mensuel', 'product_image3.jpg', '30.00');
INSERT INTO products (`id`, `name`, `image`, `price`) VALUES (NULL, 'pass annuel', 'product_image3.jpg', '260.00');

INSERT INTO enclos (num_enclos, zone) VALUES ('1', 'safari');
INSERT INTO enclos (num_enclos, zone) VALUES ('2', 'safari');
INSERT INTO enclos (num_enclos, zone) VALUES ('3', 'jungle');
INSERT INTO enclos (num_enclos, zone) VALUES ('4', 'jungle');
INSERT INTO enclos (num_enclos, zone) VALUES ('5', 'aquatique');
INSERT INTO enclos (num_enclos, zone) VALUES ('6', 'aquatique');

INSERT INTO espece (id_espece, nomespece) VALUES ('1', 'vertébré');
INSERT INTO espece (id_espece, nomespece) VALUES ('2', 'arthropode');
INSERT INTO espece (id_espece, nomespece) VALUES ('3', 'mollusque');

INSERT INTO evenement (id_evenement, nom_evenement, datedeb, datefin) 
  VALUES (null, 'Chasse aux oeufs 2021', '2021-06-12', '2021-06-12');
INSERT INTO evenement (id_evenement, nom_evenement, datedeb, datefin) 
  VALUES (null, 'Diners Safari', '2021-06-11', '2021-09-03');
INSERT INTO evenement (id_evenement, nom_evenement, datedeb, datefin) 
  VALUES (null, 'Orleans Wild Race', '2021-09-19', '2021-09-19');
INSERT INTO evenement (id_evenement, nom_evenement, datedeb, datefin) 
  VALUES (null, "Concert au Zoo d'Orleans", '2022-06-12', '2022-06-12');

INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Tigre', '2015-11-12', null, 'M', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='3'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Gorille', '2009-05-19', null, 'M', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='4'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Lion', '2014-11-09', '2020-07-15', 'F', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='1'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Elephant', '1998-03-29', null, 'M', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='4'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Leopard', '2018-07-09', null, 'F', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='1'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Singe', '2012-01-27', null, 'M', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='3'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Requin', '2016-09-05', null, 'F', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='5'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Giraffe', '2008-09-17', null, 'M', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='2'));
INSERT INTO animal (id_animal, nomanimal, datenaiss, datedeces, sexe, id_espece, num_enclos) 
VALUES (NULL, 'Hyene', '2011-09-05', null, 'M', (SELECT id_espece from espece WHERE nomespece='vertébré'), 
  (SELECT num_enclos from enclos WHERE num_enclos='1'));

INSERT INTO users (id, username, nom, prenom, date_naissance, tel, adresse, email, user_type, password) 
  VALUES (null, 'usertest', 'Talcot', 'Charles', '1988-01-25', '0654872695', '5 avenue des moulins', 'jui@gmail.com', 'user','123orleans');

INSERT INTO users (id, username, nom, prenom, date_naissance, tel, adresse, email, user_type, password) 
  VALUES (null, 'admintest', 'Dubois', 'Jean', '1985-08-25', '0679278455', '5 rue des rois', 'cab@gmail.com', 'admin','456orleans');