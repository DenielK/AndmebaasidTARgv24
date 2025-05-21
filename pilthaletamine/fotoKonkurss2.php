<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__));}?>
<?php
// võtame ühendust conf.php failist
require ('zoneconf.php');

global $yhendus;

// update + 1 punkt
if(isSet($_REQUEST["lisa1punkt"])) {
    $paring=$yhendus->prepare("UPDATE fotokonkurss SET punktid=punktid+1 WHERE id=? AND punktid <100");
    $paring->bind_param("i", $_REQUEST["lisa1punkt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//update -1 punkt
if(isSet($_REQUEST["minus1punkt"])){
    $paring=$yhendus->prepare("UPDATE fotokonkurss SET punktid=punktid-1 where id=? AND punktid > 0");
    $paring->bind_param("i", $_REQUEST["minus1punkt"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

// update - lisa kommentaar
if(isSet($_REQUEST["uus_komment"]) && !empty($_REQUEST["komment"])) {
    $paring=$yhendus->prepare("UPDATE fotokonkurss SET 
                        kommentaarid=Concat(kommentaarid, ?) WHERE id=?");
    $komment2=$_REQUEST["komment"]."\n";
    $paring->bind_param("si", $komment2, $_REQUEST["uus_komment"]);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}

//lisamine andmetabelisse
if(isSet($_REQUEST["nimetus"]) && !empty($_REQUEST["nimetus"])) {
    $paring=$yhendus->prepare("INSERT INTO fotokonkurss (fotoNimetus, Autor, pilt, lisamisAeg) 
VALUES (?, ?, ?, NOW())");
    $paring->bind_param("sss", $_REQUEST['nimetus'], $_REQUEST['autor'], $_REQUEST['pilt']);
    $paring->execute();
    header("Location:$_SERVER[PHP_SELF]");
}
?>

<!DOCTYPE html>
<html lang="et">
<head>
    <meta charset="UTF-8">
    <title>Foto konkurss</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<main>
    <div id="mainDiv">
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
        <ul>
            <?php
            global $yhendus;
            $Menyy = $yhendus->prepare("SELECT id, fotoNimetus FROM fotokonkurss WHERE avalik=1");
            $Menyy->bind_result($menuId, $fotoNimetus);
            $Menyy->execute();
            while($Menyy->fetch()){
                echo "<li><a href='?valik=$menuId'>".htmlspecialchars($fotoNimetus)."</a></li>";
            }
            $Menyy->close();
            ?>
        </ul>
        <?php
        if(isSet($_REQUEST["valik"])) {
            $Valik = $yhendus->prepare("SELECT id, fotoNimetus, pilt, autor, punktid, lisamisAeg, kommentaarid FROM fotokonkurss WHERE id=?");
            $Valik->bind_param("i", $_REQUEST["valik"]);
            $Valik->bind_result($valikId, $valikFotoNimetus, $valikPilt, $valikAutor, $valikPunktid, $valikLisamisAeg, $valikKomment);
            $Valik->execute();
            if ($Valik->fetch()) {
                echo "<h2>" . htmlspecialchars($valikFotoNimetus) . "</h2>";
                echo "<br><img src='$valikPilt' alt='fotoPilt'>";
                echo "<p>" . $valikAutor . "</p>";
                echo "<p>" . $valikPunktid . "</p>";
                echo "<p>" . $valikLisamisAeg . "</p>";
                echo "<p>" . nl2br(htmlspecialchars($valikKomment)) ."</p>
<form action='?' method='POST' id='komment_form'>
<input type='hidden' name='uus_komment' value='$valikId'>
<input type='text' name='komment' id='komment'>
<input type='submit' value='ok'>
</form></p>";
                echo "<form action='?' method='POST'>
                <input type='hidden' name='lisa1punkt' value='$valikId'>
                <button type='submit' class='punkt-btn'>+1 punkt</button>
                <input type='hidden' name='minus1punkt' value='$valikId'>
                <button type='submit' class='punkt-btn'>-1 punkt</button>
              </form>";
            }
        }
        ?>
        <?php
        $yhendus->close();
        ?>
    </div>
</main>
<footer>
    leht tegi õpilane
</footer>
</body>
</html>