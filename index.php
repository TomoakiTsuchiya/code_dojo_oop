<?php
require_once("WordWolf.php");
$playerNumber = $_GET["player_number"] ?: 0;
$action = $_GET["action"] ?: "ready";

session_start();
if(isset($_SESSION['game'])){
    $wordWolf = unserialize($_SESSION['game']);
}else{
    $manager = new ConcreteWordsManager(new getThemeWordsProvider("https://script.google.com/macros/s/AKfycbyrMcORGEDZe44pD_tgd7EoUd-lZJ48OO5MKkPmajHU_RNLDhPM/exec"));
    $wordWolf = new WordWolf($manager);
}
$wordWolf->action($action, $playerNumber);
$_SESSION['game'] = serialize($wordWolf);
