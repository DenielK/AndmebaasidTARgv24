<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__));}?>
<?php
require ('zoneconf.php');

global $yhendus;
// zero all punktid
if(isSet($_REQUEST["zeropunkt"])) {
    $paring = $yhendus->prepare("UPDATE fotokonkurss SET punktid=0 WHERE id=?");
    $paring->bind_param("i", $_REQUEST["zeropunkt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
//peitmine
if(isSet($_REQUEST["peida_id"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurss SET avalik=0 where id=?");
    $paring->bind_param("i", $_REQUEST["peida_id"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//delete only comments
if (isset($_REQUEST["kustuta_kommentaarid"])) {
    $paring = $yhendus->prepare("UPDATE fotokonkurss SET kommentaarid='' WHERE id=?");
    $paring->bind_param('i', $_REQUEST["kustuta_kommentaarid"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//delete
if(isSET($_REQUEST["kustuta"])){
    $paring=$yhendus->prepare("Delete from fotokonkurss WHERE id=?");
    $paring->bind_param('i',$_REQUEST["kustuta"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//lisamine andmebaaside
if (isSet($_REQUEST["nimetus"]) && !empty($_REQUEST["nimetus"])) {
    $paring=$yhendus->prepare("INSERT INTO fotokonkurss(fotoNimetus, autor, pilt, lisamisAeg)
VALUES(?, ?, ?, NOW())");
    $paring->bind_param("sss", $_REQUEST['nimetus'], $_REQUEST['autor'], $_REQUEST['pilt']);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Foto Konkurss</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Fotokonkurss</h1>
</header>
<nav>
    <ul>
        <li>
            <a href="fotoKonkurss.php">Adminileht</a>
        </li>
        <li>
            <a href="fotoKonkurss2.php">Kasutaja leht</a>
        </li>
        <li>
            <a href="fotoKonkurss3.php">Lisa form</a>
        </li>
    </ul>
</nav>
<main>
<h2>Foto lisamine ha aletamisele</h2>
<form action="?" method="post">
    <label for="nimetus">Fotonimetus</label>
    <input type="text" id="nimetus" name="nimetus" placeholder="Kirjuta ilus foto nimetus">
    <br>
    <label for="autor">Autor</label>
    <input type="text" id="autor" placeholder="Autori nimi" name="autor">
    <br>
    <label for="pilt">Pildifoto</label>
    <textarea name="pilt" id="pilt" cols="30" rows="10">
        Kooperi kujutise aadress
    </textarea>
    <input type="submit" value="Lisa"><!--Исполняет форму 15 line -->
</form>
<table>
    <tr>
        <th>Foto nimetus</th>
        <th>Pilt</th>
        <th>Autor</th>
        <th>Punktid</th>
        <th>Kustuta punktid</th>
        <th>Lisamis Aeg</th>
        <th>Kommentaarid</th>
        <th>Kustuta pilt</th>
    </tr>
    <?php
    global $yhendus;
    $paring=$yhendus->prepare('SELECT id, fotoNimetus, pilt, autor, punktid, lisamisAeg, kommentaarid, avalik from fotokonkurss');
    $paring->bind_result($id,$fotoNimetus, $pilt, $autor, $punktid, $aeg,$kommentaarid,$avalik);
    $paring->execute();
    while($paring->fetch()){
        echo "<tr>";
        echo "<td>".htmlspecialchars($fotoNimetus)."</td>";
        echo "<td><img src='$pilt' alt='fotoPilt'></td>";
        echo "<td>".$autor."</td>";
        echo "<td>".$punktid."</td>";
        echo "<td><a href='?zeropunkt=$id'> Kustuta punktid</a>";
        echo "<td>".$aeg."</td>";
        echo "<td>".nl2br(htmlspecialchars($kommentaarid));
        echo "<td><a href='?kustuta=$id' onclick='return confirm(\"Kas olete kindel, et soovite kustutada?\")'>Kustuta pilt</a></td>";
        echo "<td><a href='?kustuta_kommentaarid=$id' onclick='return confirm(\"Kas olete kindel, et soovite kustutada kõik kommentaarid?\")'>Kustuta kommentaarid</a></td>";
        $tekst="Näita";
        $avaparametr="kuva_id";
        $seis="Peidetud";
        if($avalik==1){
            $tekst="Peida";
            $avaparametr="peida_id";
            $seis="Kuvatud";
        }
        echo "<td><a href='?$avaparametr=$id'>$tekst</a></td>";
        echo "<td>$seis</td>";
        echo "</tr>";
    }

    ?>
</table>
</main>
<footer>
    leht tegi õpilane
</footer>
<?php
$yhendus->close();
?>

</body>
</html>