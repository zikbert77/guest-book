<?php
session_start();
define('CAPTCHA_NUMCHAR', 6);
define('CAPTCHA_WIDTH', 116);
define('CAPTCHA_HEIGHT', 40);

$letters = 'abzdefghkijklmnoprqrstuvwxyz1234567890';
$fontsize = 20;

$img = imageCreateTrueColor(CAPTCHA_WIDTH, CAPTCHA_HEIGHT);
$bg_color = imagecolorallocate($img, 255, 255, 255);  //White
$text_color = imagecolorallocate($img, rand(0,255), rand(0,255), rand(0,255));      //Black
$graphic_color = imagecolorallocate($img, 64, 64, 64);

imageFilledRectangle($img, 0, 0, CAPTCHA_WIDTH, CAPTCHA_HEIGHT, $bg_color);

$pass_phrase = "";
for($i = 0; $i < CAPTCHA_NUMCHAR; $i++){
    $pass_phrase .= $letters[ rand(0, strlen($letters)-1) ];

    $x = (CAPTCHA_WIDTH - 20) / CAPTCHA_NUMCHAR * $i + 10;
    $x = rand($x, $x+4);
    $y = CAPTCHA_HEIGHT - ( (CAPTCHA_HEIGHT- $fontsize) / 2 );
    $curcolor = imagecolorallocate( $img, rand(0, 100), rand(0, 100), rand(0, 100) );
    $angle = rand(-10, 10);
    imagettftext($img, $fontsize, $angle, $x, $y, $curcolor, 'Roboto-Bold.ttf', $pass_phrase[$i]);
}

$_SESSION['captcha'] = md5($pass_phrase);



//Random lines
for($i = 0; $i < 5; $i++){
    imageLine($img, 0, rand() % CAPTCHA_HEIGHT, CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
}
//Random points
for($i = 0; $i < 50; $i++){
    imageSetPixel($img, rand() % CAPTCHA_WIDTH, rand() % CAPTCHA_HEIGHT, $graphic_color);
}
//Text
//imagettftext($img, $fontsize, 0, 5, CAPTCHA_HEIGHT - 10, $text_color, 'Roboto-Bold.ttf', $pass_phrase);
//get Img
header("Content-type: image/png");
imagepng($img);
imagedestroy($img);
