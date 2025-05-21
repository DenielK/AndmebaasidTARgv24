<?php if (isset($_GET['code'])) {die(highlight_file(__FILE__));}?>
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
        <?php
        require('zoneconf.php');
        global $yhendus;

        // Обработка формы
        if(isSet($_REQUEST["nimetus"]) && !empty($_REQUEST["nimetus"])) {
            $paring = $yhendus->prepare("INSERT INTO fotokonkurss (fotoNimetus, Autor, pilt, lisamisAeg) 
        VALUES (?, ?, ?, NOW())");
            $paring->bind_param("sss", $_REQUEST['nimetus'], $_REQUEST['autor'], $_REQUEST['pilt']);
            $paring->execute();
            header("Location:$_SERVER[PHP_SELF]");
        }
        ?>
        <div id="formDiv">
            <h2>Foto lisamine hääletamisele</h2>
            <form action="?" method="POST">
                <label for="nimetus">FotoNimetus</label>
                <input type="text" id="nimetus" name="nimetus" placeholder="Kirjuta ilus fotonimetus">
                <br>
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" placeholder="Autori nimi">
                <br>
                <label for="pilt">Pildifoto</label>
                <textarea name="pilt" id="pilt" cols="30" rows="10"> </textarea>
                <br>
                <input type="submit" value="Lisa">
            </form>
        </div>
</main>
<footer>
    leht tegi õpilane
</footer>
</body>
</html>
