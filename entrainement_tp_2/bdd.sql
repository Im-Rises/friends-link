DROP DATABASE gestion_livre;
CREATE DATABASE gestion_livre;

USE gestion_livre;

CREATE TABLE auteur ( 
    idAuteur INT PRIMARY KEY auto_increment, 
    nom TEXT 
);

CREATE TABLE livre( 
    idLivre INT PRIMARY KEY auto_increment, 
    titre TEXT, 
    idAuteur INT, 
    FOREIGN KEY(idAuteur) REFERENCES auteur(idAuteur) 
); 