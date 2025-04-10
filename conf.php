<?php
$kasutaja="denielkruusman";
$parool="12345";
$andmebaas="denielkruusman";
$serverinimi="localhost";

$yhendus=new mysqli($serverinimi,$kasutaja,$parool,$andmebaas);
$yhendus->set_charset("utf8");
