DROP DATABASE IF EXISTS reseau_social;
CREATE DATABASE IF NOT EXISTS reseau_social; USE reseau_social;

CREATE TABLE membre (adresse_mail VARCHAR(320) PRIMARY KEY, nom VARCHAR(50) NOT NULL , prenom VARCHAR(50) NOT NULL, date_naissance DATE);

CREATE TABLE message_discussion (id_message BIGINT PRIMARY KEY AUTO_INCREMENT, email_envoyeur VARCHAR(320) NOT NULL, email_receveur VARCHAR(320) NOT NULL, message_text VARCHAR(1000) NOT NULL, date_envoie DATE NOT NULL, FOREIGN KEY (email_envoyeur) REFERENCES membre(adresse_mail), FOREIGN KEY (email_receveur) REFERENCES membre(adresse_mail));

CREATE TABLE ami(email VARCHAR(320), email_ami VARCHAR(320), amitie_validee BOOLEAN NOT NULL, PRIMARY KEY (email, email_ami), FOREIGN KEY (email) REFERENCES membre(adresse_mail), FOREIGN KEY (email) REFERENCES membre(adresse_mail));

CREATE TABLE groupe (id BIGINT PRIMARY KEY, nom VARCHAR(25) NOT NULL);

CREATE TABLE groupe_membre (id_groupe BIGINT, mail_membre VARCHAR(320), date_creation DATE, PRIMARY KEY(id_groupe, mail_membre), FOREIGN KEY (id_groupe) REFERENCES groupe(id), FOREIGN KEY (mail_membre) REFERENCES membre(adresse_mail));

CREATE TABLE message_groupe (id_message BIGINT PRIMARY KEY AUTO_INCREMENT, email_envoyeur VARCHAR(320), id_groupe BIGINT, text_message VARCHAR(1000) NOT NULL, date_envoie DATE, FOREIGN KEY (email_envoyeur) REFERENCES membre(adresse_mail), FOREIGN KEY (id_groupe) REFERENCES groupe(id)); 