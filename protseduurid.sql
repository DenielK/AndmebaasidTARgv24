--SQL SALVESTATUD PROTSEDUURID -- Funktsioonid - mitu SQL käsku käivitakse järjest
--SQL Server
Create database procTARgv24;

use procTARgv24;
Create table uudised(
uudisID int Primary key identity(1,1),
uudiseTeema varchar(50),
kuupaev date,
autor varchar(25),
kirjeldus text
)
Select * from uudised;
INSERT INTO uudised(
uudiseTeema, kuupaev, autor, kirjeldus)
VALUES(
'udune ilm', '2025-02-28', 'postimees', 'Lõunani on udune ilm')
--protseduuri loomine
--sisestab uudised tabelisse ja kohe näitab
CREATE PROCEDURE lisaUudis
@uusTeema varchar(50),
@paev date,
@autor varchar(20),
@kirjeldus text
AS
BEGIN
INSERT INTO uudised(
uudiseTeema, kuupaev, autor, kirjeldus)
VALUES(
@uusTeema, @paev, @autor, @kirjeldus);
Select * from uudised;
END;
--kutse
EXEC lisaUudis 'windows 11', '2025-02-06', 'õpetaja Pant', 'w11 ei tööta multimeedia klassis';
--teine kutse võimalus
EXEC lisaUudis 
@uusTeema='1.märts on juba kevad',
@paev='2025-02-06',
@autor='test',
@kirjeldus='puudub';

--protsedur, mis kustutab tabelist id järgi
create procedure kustutaUudis
@id int
AS
BEGIN
SELECT * from uudised;
DELETE FROM uudised WHERE uudisID=@id;
SELECT * from uudised;
END;
--kutse
EXEC kustutaUudis 3;
EXEC kustutaUudis @id=3;

UPDATE uudised SET kirjeldus='uus kirjeldus'
WHERE kirjeldus Like 'puudub';
SELECT * FROM uudised

--protseduur mis uuendab andmed tabelis/UPDATE
CREATE Procedure uuendaKirjeldus
@uuskirjeldus text
AS
BEGIN
SELECT * FROM uudised;
UPDATE uudised SET kirjeldus=@uuskirjeldus
WHERE kirjeldus Like 'puudub';
SELECT * FROM uudised
END;

--kutse
EXEC uuendaKirjeldus 'uus tekst kirjelduses';
EXEC uuendaKirjeldus @uuskirjeldus='uus tekst kirjelduses';
--protseduur mis otsib ja näitab uudist esimene tähte järgi

CREATE PROCEDURE otsingUudiseTeema
@taht char(1)
AS
BEGIN
SELECT * FROM uudised
WHERE uudiseTeema LIKE @taht+'%';
END;

--kutse
EXEC otsingUudiseTeema 'w';

--XAMPP/localhost

Create table uudised(
uudisID int PRIMARY KEY AUTO_INCREMENT,
uudiseTeema varchar(50),
kuupaev date,
autor varchar(25),
kirjeldus text
)

  --
CREATE PROCEDURE `lisaUudis`(IN `uusTeema` VARCHAR(50), IN `paev` DATE, IN `autor` VARCHAR(25), IN `kirjeldus` TEXT) NOT DETERMINISTIC CONTAINS SQL SQL SECURITY DEFINER BEGIN

INSERT INTO uudised(
uudiseTeema, kuupaev, autor, kirjeldus)
VALUES(
uusTeema, paev, autor, kirjeldus);
Select * from uudised;

END;

CALL lisauudis ('windows 11', '2025-02-06', 'õpetaja Pant', 'w11 ei tööta multimeedia klassis');
