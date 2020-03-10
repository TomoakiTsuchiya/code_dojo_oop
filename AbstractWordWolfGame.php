<?php
require_once "AbstractThemeWordsManager.php";
require_once "User.php";
abstract class AbstractWordWolfGame
{
    protected $themeWordsManager;
    protected $users = [];
    protected $playerCount = 6;
    function __construct(AbstractThemeWordsManager $themeWordsManager)
    {
        $this->themeWordsManager = $themeWordsManager;
    }


    abstract function readyToStart();

    abstract function startGame();

    abstract function confirmPlayer($playerNumber);
    abstract function confirmWord($playerNumber);
    abstract function talking();
    abstract function confirmResult();
    function action($action, $playerNumber = null)
    {
        switch ($action) {
            case "ready":
                $this->readyToStart();
                break;
            case "start_game":
                $this->startGame();
                break;
            case "confirm_player":
                $this->confirmPlayer($playerNumber);
                break;
            case "confirm_word":
                $this->confirmWord($playerNumber);
                break;
            case "talking":
                $this->talking();
                break;
            case "confirm_result":
                $this->confirmResult();
                break;
        }
    }
}
