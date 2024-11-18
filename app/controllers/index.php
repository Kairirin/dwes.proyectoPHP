<?php
require_once __DIR__ . "/../utils/Utils.php";
$imagenesIndice = ["imagen1.png", "imagen2.png", "imagen3.png"];

//Obtener los cinco juegos con mejor categoria y guardarlos en una variable que luego utilizarmos en topfive
$listaProv = [];
$lista = Utils::extraerTopFive($listaProv);
//La lista tiene que recuperarla de la base de datos

require __DIR__ . '/../views/index.view.php';
