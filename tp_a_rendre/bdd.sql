CREATE DATABASE reseau_social;
USE reseau_social;

CREATE TABLE membres (
    email TEXT PRIMARY KEY, 
    nom TEXT, 
    prenom TEXT, 
    date_naissance DATE
);

CREATE TABLE discussions (
    email1 TEXT PRIMARY KEY,
    email2 TEXT PRIMARY KEY,
    FOREIGN KEY(email1) REFERENCES membres(email),
    FOREIGN KEY(email2) REFERENCES membres(email)
);

CREATE TABLE groupe (
    id INT PRIMARY KEY,
    nom TEXT
);

CREATE TABLE message_groupe (
    email_envoyeur TEXT PRIMARY KEY,
    id_groupe INT PRIMARY KEY,
    msg TEXT, 
    date_msg DATE
);