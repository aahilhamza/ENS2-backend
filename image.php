<?php
$domain = $_GET['domain'];
$token  = intval($_GET['tokenId']);

if (strlen($domain) > 20 || !preg_match('/^[a-zA-Z0-9-_]+$/', $domain)) exit("Invalid Name!");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$dest = imagecreatefromjpeg('bg.jpg');
error_reporting(E_ALL);
$color = imagecolorallocate($dest, 255, 255, 255);
$font_path = 'TwCenClassMTStd-Regular.ttf';
$string = $domain.".ethereum";
$length = strlen($string) ;
if($length < 15){
    $fontSize= 80;
} elseif($length < 20){
    $fontSize = 50;
} else {
    $fontSize = 40;
}
$image_width= 1080;
$image_height= 1080;
$text_box = imagettfbbox($fontSize,0,$font_path,$string);

$text_width = $text_box[2]-$text_box[0];
$text_height = $text_box[7]-$text_box[1];

$x = ($image_width/2) - ($text_width/2);

imagettftext($dest, $fontSize, 0, $x, 900, $color, $font_path, $string);
header('Content-Type: image/jpg');
imagejpeg($dest);
imagedestroy($dest);

