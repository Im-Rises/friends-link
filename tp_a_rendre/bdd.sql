DROP DATABASE IF EXISTS reseau_social;
CREATE DATABASE IF NOT EXISTS reseau_social CHARACTER SET utf8 COLLATE utf8_general_ci; 
USE reseau_social;

CREATE TABLE membre (adresse_mail VARCHAR(320) PRIMARY KEY NOT NULL, nom VARCHAR(50) NOT NULL , prenom VARCHAR(50) NOT NULL, date_naissance DATE NOT NULL, mdp TEXT NOT NULL, nomImage VARCHAR(400));

CREATE TABLE message_discussion (id_message BIGINT PRIMARY KEY AUTO_INCREMENT, email_envoyeur VARCHAR(320) NOT NULL, email_receveur VARCHAR(320) NOT NULL, message_text VARCHAR(1000) NOT NULL, date_envoie DATE NOT NULL, FOREIGN KEY (email_envoyeur) REFERENCES membre(adresse_mail), FOREIGN KEY (email_receveur) REFERENCES membre(adresse_mail));

CREATE TABLE ami(email VARCHAR(320), email_ami VARCHAR(320), amitie_validee BOOLEAN NOT NULL, date_ajout DATE NOT NULL ,PRIMARY KEY (email, email_ami), FOREIGN KEY (email) REFERENCES membre(adresse_mail), FOREIGN KEY (email_ami) REFERENCES membre(adresse_mail));

CREATE TABLE groupe (id BIGINT AUTO_INCREMENT, email_createur VARCHAR(320) NOT NULL, nom VARCHAR(25) NOT NULL, nomImage VARCHAR(400), PRIMARY KEY(id, email_createur), FOREIGN KEY(email_createur) REFERENCES membre(adresse_mail));

CREATE TABLE groupe_membre (id_groupe BIGINT, mail_membre VARCHAR(320), date_ajout DATE NOT NULL, PRIMARY KEY(id_groupe, mail_membre), FOREIGN KEY (id_groupe) REFERENCES groupe(id), FOREIGN KEY (mail_membre) REFERENCES membre(adresse_mail));

CREATE TABLE message_groupe (id_message BIGINT PRIMARY KEY AUTO_INCREMENT, email_envoyeur VARCHAR(320) NOT NULL, id_groupe BIGINT NOT NULL, text_message VARCHAR(1000) NOT NULL, date_envoie DATE NOT NULL, FOREIGN KEY (email_envoyeur) REFERENCES membre(adresse_mail), FOREIGN KEY (id_groupe) REFERENCES groupe(id)); 

CREATE TABLE admin_groupe (id_groupe BIGINT NOT NULL, email VARCHAR(320), PRIMARY KEY(id_groupe, email), FOREIGN KEY (id_groupe) REFERENCES groupe(id), FOREIGN KEY(email) REFERENCES membre(adresse_mail));


CREATE TABLE post (id_post BIGINT PRIMARY KEY AUTO_INCREMENT, email_posteur VARCHAR(230) NOT NULL, titre VARCHAR(30) NOT NULL, datePost DATETIME NOT NULL, post_text VARCHAR(1000) NOT NULL, image_post BOOLEAN NOT NULL, FOREIGN KEY (email_posteur) REFERENCES membre(adresse_mail));

CREATE TABLE post_message (id_message BIGINT PRIMARY KEY AUTO_INCREMENT, id_post BIGINT NOT NULL, email_posteur VARCHAR(230) NOT NULL, datePost DATETIME NOT NULL, message_post_text VARCHAR(1000) NOT NULL, FOREIGN KEY (id_post) REFERENCES post(id_post), FOREIGN KEY (email_posteur) REFERENCES membre(adresse_mail));

CREATE TABLE post_like (id_post BIGINT NOT NULL, adresse_mail VARCHAR(320) NOT NULL, PRIMARY KEY (id_post, adresse_mail), FOREIGN KEY (id_post) REFERENCES post(id_post), FOREIGN KEY (adresse_mail) REFERENCES membre(adresse_mail));

