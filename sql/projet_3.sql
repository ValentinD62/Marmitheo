

Drop TABLE IF EXISTS Ingrédient;
CREATE TABLE Ingrédient(
                           pk_num_ing int NOT NULL AUTO_INCREMENT ,
                           nom_ing VARCHAR(20) NOT NULL,
                           image BLOB NOT NULL,
                           CONSTRAINT PK_ING PRIMARY KEY (pk_num_ing)
);

Drop TABLE IF EXISTS Recette;
CREATE TABLE Recette(
                        pk_num_rec int NOT NULL AUTO_INCREMENT ,
                        nom_rec VARCHAR(20) NOT NULL,
                        image_rec BLOB NOT NULL,
                        description VARCHAR(2000) NOT NULL,
                        CONSTRAINT PK_REC PRIMARY KEY (pk_num_rec)
);

Drop TABLE IF EXISTS Tag_Recette;
CREATE TABLE Tag_Recette(
                            pk_tag_rec int NOT NULL AUTO_INCREMENT,
                            fk_num_tag int NOT NULL,
                            fk_num_rec int NOT NULL,
                            CONSTRAINT PK_TAG_REC PRIMARY KEY (pk_tag_rec),
                            CONSTRAINT FK_NUM_TAG FOREIGN KEY (fk_num_tag) REFERENCES Tag (pk_num_tag)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE,
                            CONSTRAINT FK_NUM_REC FOREIGN KEY (fk_num_rec) REFERENCES Recette (pk_num_rec)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE
);


DROP TABLE IF EXISTS Tag;
CREATE TABLE Tag(
                    pk_num_tag int NOT NULL AUTO_INCREMENT,
                    nom_tag varchar(20),
                    CONSTRAINT PK_TAG PRIMARY KEY (pk_num_tag)
);

DROP TABLE IF EXISTS Ing_Recette;
CREATE TABLE Ing_Recette(
                            pk_id int NOT NULL AUTO_INCREMENT ,
                            fk_num_rec int NOT NULL,
                            fk_num_ing int NOT NULL,
                            CONSTRAINT PK_ID PRIMARY KEY (pk_id),
                            CONSTRAINT FK_REC FOREIGN KEY (fk_num_rec) REFERENCES Recette(pk_num_rec)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE,
                            CONSTRAINT FK_ING FOREIGN KEY (fk_num_ing) REFERENCES Ingrédient(pk_num_ing)
                                ON DELETE CASCADE
                                ON UPDATE CASCADE
);

INSERT INTO ingrédient(pk_num_ing, nom_ing, image) VALUES(1, 'chocolat', 'chocolat.png');

INSERT INTO tag( nom_tag) VALUES('four'), ('micro-onde'),('chaud'),('froid'),('rapide'),('long'), ('desert');


INSERT INTO Recette(nom_rec, image_rec, description) VALUES('chocolat fondu', 'Chocolat_Fondu.jpg', 'mettre chocolat au micro-onde pendant 1 heure');

INSERT INTO Tag_Recette(fk_num_tag, fk_num_rec) VALUES(( SELECT pk_num_tag FROM Tag WHERE nom_tag = 'micro-onde'),
                                                       (SELECT pk_num_rec FROM recette WHERE nom_rec = 'chocolat fondu' ));

INSERT INTO ing_recette(fk_num_rec, fk_num_ing) VALUES((SELECT pk_num_rec FROM recette WHERE nom_rec = 'chocolat fondu' ) ,
                                                       ( SELECT pk_num_ing FROM ingrédient WHERE nom_ing = 'chocolat'));
