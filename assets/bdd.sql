USE mycavev2;

CREATE TABLE `role` (
    `id` INT(1) PRIMARY KEY AUTO_INCREMENT,
    `role_name` VARCHAR(32) NOT  NULL,
) ENGINE= INNODB;

CREATE TABLE `couleur` (
    `id` INT(1) PRIMARY KEY AUTO_INCREMENT,
    `type` VARCHAR(8) NOT NULL,
) ENGINE=INNODB;

CREATE TABLE `mille` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `annee` BIGINT(4) NOT NULL,
    `description` VARCHAR(532) NOT NULL,
    `image` VARCHAR(96) NOT NULL,
    `couleur_id` INT,
    FOREIGN KEY (couleur_id) REFERENCES couleur(id) ON DELETE SET NULL
) ENGINE=INNODB;

CREATE TABLE `bouteille` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(64) NOT NULL,
    `pays` VARCHAR(64) NOT NULL,
    `region` VARCHAR(64) NOT NULL,
    `cepage` VARCHAR(64) NOT NULL,
    `mille_id` BIGINT,
    FOREIGN KEY (mille_id) REFERENCES mille(id) ON DELETE SET NULL
) ENGINE=INNODB;

CREATE TABLE `user` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `nom` VARCHAR(64) NOT NULL,
    `prenom` VARCHAR(64) NOT NULL,
    `email` VARCHAR(64) NOT NULL,
    `password` VARCHAR(64) NOT NULL,
    `bouteille_id` BIGINT,
    FOREIGN KEY (bouteille_id) REFERENCES bouteille(id) ON DELETE SET NULL,
    `role_id` INT,
    FOREIGN KEY (role_id) REFERENCES role(id) ON DELETE SET NULL
) ENGINE=INNODB;

CREATE TABLE `note` (
    `id` BIGINT PRIMARY KEY AUTO_INCREMENT,
    `valeur` INT(1) NOT NULL,
    `user_id` BIGINT UNSIGNE,
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE,
    `mille_id` BIGINT,
    FOREIGN KEY (mille_id) REFERENCES mille(id) ON DELETE CASCADE
) ENGINE=INNODB;

INSERT INTO role (role) VALUES 
('administrateur'),
('visiteur');

INSERT INTO couleur (type) VALUES 
('blanc'),
('rouge'),
('rose');

INSERT INTO user (nom, prenom, email, password,role_id ) VALUES 
('Lefebvre', 'Kevin', 'klefebvre.dev@gmail.com', '$2y$10$AXUl.64tnp4GZoFoDQ8Ev.xlamwKoixBeuLHbgv11B4K6KyM98cne','1');

INSERT INTO mille (annee, description, image, couleur_id) VALUES 
('2009','The aromas of fruit and spice give one a hint of the light drinkability of this lovely wine, which makes an excellent complement to fish dishes.','saint_cosme','2'),
('2006','A resurgence of interest in boutique vineyards has opened the door for this excellent foray into the dessert wine market. Light and bouncy, with a hint of black truffle, this wine will not fail to tickle the taste buds.','lan_rioja','2'),
('2010','The cache of a fine Cabernet in ones wine cellar can now be replaced with a childishly playful wine bubbling over with tempting tastes of black cherry and licorice. This is a taste sure to transport you back in time.','margerum','1'),
('2009',"A one-two punch of black pepper and jalapeno will send your senses reeling, as the orange essence snaps you back to reality. Don't miss this award-winning taste sensation.",'ex_umbris','2'),
('2009',"One cannot doubt that this will be the wine served at the Hollywood award shows, because it has undeniable star power. Be the first to catch the debut that everyone will be talking about tomorrow.",'rex_hill','2'),
('2007',"Though soft and rounded in texture, the body of this wine is full and rich and oh-so-appealing. This delivery is even more impressive when one takes note of the tender tannins that leave the taste buds wholly satisfied.",'viticcio','2'),
('2005',"Though dense and chewy, this wine does not overpower with its finely balanced depth and structure. It is a truly luxurious experience for the senses.",'le_doyenne','2'),
('2009',"The light golden color of this wine belies the bright flavor it holds. A true summer wine, it begs for a picnic lunch in a sun-soaked vineyard.",'bouscat','2'),
('2009',"With hints of ginger and spice, this wine makes an excellent complement to light appetizer and dessert fare for a holiday gathering.",'block_nine','2'),
('2007',"Though subtle in its complexities, this wine is sure to please a wide range of enthusiasts. Notes of pomegranate will delight as the nutty finish completes the picture of a fine sipping experience.",'le_doyenne','2'),
('2011',"Solid notes of black currant blended with a light citrus make this wine an easy pour for varied palates.",'bodega_lurton','1'),
('2009',"Breaking the mold of the classics, this offering will surprise and undoubtedly get tongues wagging with the hints of coffee and tobacco in perfect alignment with more traditional notes. Breaking the mold of the classics, this offering will surprise and undoubtedly get tongues wagging with the hints of coffee and tobacco in perfect alignment with more traditional notes. Sure to please the late-night crowd with the slight jolt of adrenaline it brings.",'morizottes','1');

INSERT INTO bouteille (nom, pays, region, cepage,mille_id ) VALUES 
('CHATEAU DE SAINT COSME', 'France', 'Vallée du Rhône', 'Grenache/Syrah','1'),
('LAN RIOJA CRIANZA', 'Espagne', 'Rioja', 'Tempranillo','2'),
('MARGERUM SYBARITE', 'USA', 'Californie', 'Sauvignon Blanc','3'),
('OWEN ROE "EX UMBRIS"', 'USA', 'Washington', 'Syrah','4'),
('REX HILL', 'USA', 'Oregon', 'Pinot Noir','5'),
('VITICCIO CLASSICO RISERVA', 'Italie', 'Toscane', 'Sangiovese Merlot','6'),
('CHATEAU LE DOYENNE', 'France', 'Bordeaux', 'Merlot','7'),
('DOMAINE DU BOUSCAT', 'France', 'Bordeaux', 'Merlot','8'),
('BLOCK NINE', 'USA', 'Californie', 'Pinot Noir','9'),
('DOMAINE SERENE', 'USA', 'Oregon', 'Pinot Noir','10'),
('BODEGA LURTON', 'Argentine', 'Mendoza', 'Pinot Gris','11'),
('LES MORIZOTTES', 'France', 'Bourgogne', 'Chardonnay','12');


-- INSERT INTO user (email, password, pseudo ) VALUES 
-- ('ibis@gmail.com', 'passwd', 'Ibis masta'),
-- ('zito@gmail.com', 'passwd', 'Zito masta'),
-- ('nvmonde@gmail.com', 'passwd', 'Didier du nouveau monde'),
-- ('titi@gmail.com', 'passwd', 'titi');

-- INSERT INTO office (name, user_id) VALUES
-- ('Ibis Gujan', 1),
-- ('Zito', 2),
-- ('Ibis Merignac', 1),
-- ('Le nouveau monde', 3);

-- INSERT INTO type (name) VALUES
-- ('bar'),
-- ('restau'),
-- ('hotel');

-- INSERT INTO office_type (office_id, type_id) VALUES 
-- (1,1),
-- (1,2),
-- (1,3),
-- (2,1),
-- (3,3),
-- (4,1),
-- (4,2);

-- INSERT INTO note (user_id,office_id, valeur,commentaire) VALUES
-- (1, 1, 5, "AMAZING"),
-- (1, 3, 5, "AMAZING"),
-- (4, 1, 1, "SHIT !!!"),
-- (4, 3, 1, "SHIT"),
-- (4, 2, 4, NULL),
-- (4, 4, 3, NULL),
-- (2, 2, 5, NULL),
-- (3, 4, 5, NULL);


-- SELECT * FROM note WHERE value <= 3; afficher note inférieur à 4
-- SELECT * FROM note WHERE value % 2 = 0; afficher chiffre paire
-- SELECT * FROM note WHERE value % 2 != 0; afficher chiffre impaire
-- SELECT COUNT(*) FROM note WHERE value % 2 != 0; afficher le nombre de note impaire

-- SELECT MIN(value) FROM note; afficher note minimal
-- SELECT MAX(value) FROM note; afficher note max
-- SELECT AVG(value) FROM note; afficher moyenne des notes
-- SELECT office_id, AVG(value) FROM note GROUP BY office_id; afficher moyenne des notes celon office
-- SELECT office_id, COUNT(*) FROM note GROUP BY office_id; afficher nombre de note celon office

-- SELECT * FROM note WHERE office_id=1; afficher nombre de note de l'office 1

-- SELECT * FROM note INNER JOIN office ON note.office_id = office.id; affiche jointure note et office 

-- SELECT office.name, note.value, note.commentaire FROM note INNER JOIN office ON note.office_id = office.id; affiche  le nom les notes, et commentaires des offices  

-- SELECT office.name, note.value, note.commentaire, AVG(note.value) FROM note INNER JOIN office ON note.office_id GROUP BY office.id = office.id; affiche le nom ,une note ( aléatoires), et commentaires des offices et moyennes des offices

-- SELECT * FROM note INNER JOIN user ON note.user_id = user_id affiche note et pseudo et tout 

-- SELECT * FROM note RIGHT OUTER JOIN user ON note.user_id = user_id affiche note et pseudo et tout même personnes qui n'a pas donner de note

-- SELECT * FROM note WHERE value (SELECT AVG(value) FROM note); afficher toutes les note supérieur à la moyenne global de toutes les offices 

-- SELECT * 
-- FROM office INNER JOIN office_type ON office.id = office_id
            -- INNER JOIN type ON office.id.type_id = type_id;

-- affiche toute les info sur les office et leur type ( id/type/nom ect ect )

-- SELECT office.name, type.name 
-- FROM office INNER JOIN office_type ON office.id = office_id
            -- INNER JOIN type ON office.id.type_id = type_id;

-- affiche les office et leur type

-- SELECT office.name, type.name 
-- FROM office INNER JOIN office_type ON office.id = office_id
            -- INNER JOIN type ON office.id.type_id = type_id;
-- WHERE type.name LIKE 'bar';

-- affiche les office et leur type

-- SELECT office.name, office.name, AVG(note.value)
-- FROM office INNER join note ON office.id = note.office
-- GROUP BY office.id
-- affiche le nom des offices, et leur moyenne chacune

-- CREATE VIEW office_average AS 
        -- SELECT office.name, office.name, AVG(note.value)
        -- FROM office INNER join note ON office.id = note.office
        -- GROUP BY office.id
        -- affiche le nom des offices, et leur moyenne chacune et creer une vue ( Alias en gros)