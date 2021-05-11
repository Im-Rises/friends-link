CREATE DATABASE qdc_livre;
USE qdc_livre;

CREATE TABLE livre(
    id int primary key auto_increment, 
    titre text, 
    auteur text, 
    date_creation date
);

