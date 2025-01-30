CREATE DATABASE TAR;

USE TAR;
CREATE TABLE film(
filmID int PRIMARY KEY identity(1,1),
filmNimetus varchar(30) not null,
aasta int,
eelarveHind decimal(7,1)
);
SELECT * FROM film;

--tabeli kustutamine
--DROP TABLE film;

--andmete sisestamine tabelisse
INSERT INTO film(filmNimetus,aasta,eelarveHind)
VALUES('Barby', 2023, 10000.5)

DELETE FROM film WHERE filmID=5;

CREATE TABLE zanr(
zanrID int PRIMARY KEY identity(1,1),
zanrNimetus varchar(20) UNIQUE
)
DROP TABLE zanr

INSERT INTO zanr(zanrNimetus)
VALUES('draama'), ('detektiiv'), ('fantasy');
SELECT * FROM zanr;

--tabeli film struktuuri muutmine --> uue veergu lisamine
ALTER TABLE film ADD zanrID int;
SELECT * FROM film;
--tabeli film struktuuri muutmine -->
--FK lisamine mis on seotud tabeliga zanr(zanrID)
ALTER TABLE film ADD CONSTRAINT fk_zanr
FOREIGN KEY(zanrID) REFERENCES zanr(zanrID);

select *from film;
select *from zanr;
UPDATE film SET zanrID=1 where filmID=3
