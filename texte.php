<?php
header('Content-Type: text/html; charset=utf-8');

require_once("Emoji/Emoji.php");
use Emoji\EmojiReplace\Emoji as EmojiClass;

$Emoji = new EmojiClass();

//Set Dir Assets (Ex: http://domain.com/Emoji/AssetsEmoji/)
$Emoji->setDirAssets("./Emoji/AssetsEmoji/");

//Set Pack Icons
// Options -> IconsB&W, IconsIphone, IconsAndroid, IconsTwitter, IconsWind
$Emoji->setDirPack("IconsIphone");

// Generate Emojis (important)
$Emoji->generateEmoji();

//$Emoji->getCss() 

//Exemplo
echo '<link rel="stylesheet" href="'.$Emoji->getCss().'" />';
echo '<p style="font-size:40px"> Olá ';
echo $Emoji->TextReplace('😄');
echo '</p>';