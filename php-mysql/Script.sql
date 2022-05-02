CREATE table contact_form (
id INT NOT NULL auto_increment,
name VARCHAR(45) NOT NULL,
email VARCHAR(60) NOT NULL,
message TEXT NOT NULL,
visualized BOOL NOT NULL,
moment datetime NOT NULL default NOW(),
PRIMARY KEY (id))