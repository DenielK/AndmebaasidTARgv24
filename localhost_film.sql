Create table film(
    filmID int PRIMARY KEY AUTO_INCREMENT,
    filmNimetus varchar(30) not null,
    aasta int,
    eelarveHind decimal(7.1)
    

Insert into film(filmNimetus,aasta,eelarveHind)
    values

Create TABLE zanr(
    zanrID int primary key auto_increment,
    zanrNimetus varchar(20) unique
    );

insert into zanr(zanrNimetus)
values ('draama'),('detektiiv')

----------------------------------------------------------------------------
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

CREATE TABLE rezisoor(
rezID int PRIMARY KEY identity(1,1),
nimi varchar(50) not null,
synniaeg date,
riik varchar(30)
);

ALTER TABLE film ADD rezID int;
SELECT * from rezisoor
SELECT * from film
Select * from rezisoor
SELECT * from kinokava
ALTER TABLE film ADD CONSTRAINT fk_rezID
FOREIGN KEY(rezID) REFERENCES rezisoor(rezID);

INSERT INTO rezisoor(nimi, synniaeg, riik)
VALUES('Test Testov', '2001-05-15', 'Spain')

Select * from rezisoor

CREATE TABLE kinokava(
kavaID int PRIMARY KEY identity(1,1),
kuupaevAeg datetime,
saal varchar(20),
koht varchar(30)
);

SELECT * from kinokava


ALTER TABLE kinokava ADD filmID int;
SELECT * from kinokava
SELECT * from film

ALTER TABLE kinokava ADD CONSTRAINT fk_filmID
FOREIGN KEY(filmID) REFERENCES film(filmID);

UPDATE film SET zanrID=2 where filmID=5

INSERT INTO kinokava(kuupaevAeg, saal, koht, filmID)
VALUES('2025-01-30 17:00:00', 'Saal 2', 'Solaris', 2);
