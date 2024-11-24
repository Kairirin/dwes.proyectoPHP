<?php
namespace dwes\app\utils;

header('Content-Type: image/png'); //De esta forma los transformará en imagen
session_start(); //Al abrir el navegador, entre una llamada y otra guarda variables en memoria. 
$captcha = ""; //Donde guardamos el código que generará el servidor.
$totalCharacteres = rand(5, 8); // Longitud máxima del captcha
$possiblesLetras = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$captchaFont = "CartoonBlocks.ttf"; //Tipo de fuente que emplearemos, hay que descargar el ttf en la carpeta donde esté el archivo utils. Intentar usar fuentes complejas que el OCR no pueda reconocer
$captchaFontSize = rand(30, 40); // Tamaño de la fuente
$caracter = 0;
while ($caracter < $totalCharacteres) { //Aquí vamos creando el captcha hasta que tenga la cantidad de caracteres que hemos indicado
    $captcha .= substr(str_shuffle($possiblesLetras), 0, 1); // Se extrae 1 letra de $possiblesLetras de la posición aleatoria según el tamaño de la variable.
    $caracter++;
}
$text_box = imagettfbbox($captchaFontSize, 0, $captchaFont, $captcha);
$ancho = abs($text_box[2] - $text_box[0]) + 10;
$alto = abs($text_box[5] - $text_box[1]);
if ($captchaFontSize > 35)
    $randomLineas = 10;
else
    $randomLineas = 14;
$imagen = imagecreatetruecolor($ancho, $alto + 20);
$colorBlanco = imagecolorallocate($imagen, 255, 255, 255);
$colorAzul = imagecolorallocate($imagen, 0, 0, 250);
$colorNegro = imagecolorallocate($imagen, 0, 0, 0);
// Dibujamos la imagen
imagefill($imagen, 0, 0, $colorAzul); //Rellena la imagen de color azul
$backgroundColor = imagecolorallocate($imagen, 255, 255, 255);
for ($contadorLineas = 0; $contadorLineas < $randomLineas; $contadorLineas++) {
    imageline($imagen, rand(0, $ancho), rand(0, $alto), rand(0, $ancho), rand(0, $alto + 20), $colorNegro);
}
imagettftext($imagen, $captchaFontSize, 0, 4, $alto, $colorNegro, $captchaFont, $captcha); //Rellena la imagen con el captcha
imagepng($imagen); //Transforma en png
imagedestroy($imagen); //Borra la memoria de la imagen
$_SESSION['captchaGenerado'] = $captcha; // Guardamos el captcha generado en una variable de sesión
