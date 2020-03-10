<?php
require_once "AbstractThemeWordsManager.php";
require_once "AbstractWordWolfGame.php";
require_once "User.php";
class WordWolf extends AbstractWordWolfGame
{

    function readyToStart()
    {
        echo "プレーヤーは";
        echo "<br />";
        for ($i = 1; $i <= $this->playerCount; $i++) {
            echo $i . "さん";
        }
        echo "です。";
        echo "<br />";
        echo "<a href='/?action=start_game'>始める</a>";
    }

    function startGame()
    {
        $this->themeWordsManager->initThemeWords();
        $this->users = [];
        $minorNumber = random_int(1, $this->playerCount);
        for ($i = 1; $i <= $this->playerCount; $i++) {
            array_push($this->users, new User($i, $i === $minorNumber));
        }
        $this->action("confirm_player", 1);
    }

    function confirmPlayer($playerNumber)
    {
        echo $this->users[$playerNumber - 1]->name . "さんですか?";
        echo "<br />";
        echo "<a href='/?action=confirm_word&player_number={$playerNumber}'>yes</a>";
    }
    function confirmWord($playerNumber)
    {
        $user = $this->users[$playerNumber - 1];
        $word = $user->isMinority ? $this->themeWordsManager->getMinorWord() : $this->themeWordsManager->getMajarWord();
        echo "あなたのワードは{$word}です";
        echo "<br />";
        if ($playerNumber < $this->playerCount) {
            $playerNumber++;
            echo "<a href='/?action=confirm_player&player_number={$playerNumber}'>進む</a>";
        } else {
            echo "<a href='/?action=talking'>進む</a>";
        }
    }
    function talking()
    {
        echo "話し合ってください";
        echo "<br />";
        echo "<a href='/?action=confirm_result'>結果を確認する</a>";
    }
    function confirmResult()
    {
        echo "結果";
        echo "<br />";
        foreach($this->users as $user){
            if($user->isMinority){
                $type = "少数派";
                $word = $this->themeWordsManager->getMinorWord();
            }else{
                $type = "多数派";
                $word = $this->themeWordsManager->getMajarWord();
            }
            echo $user->name."さんは".$type."で、テーマは\"".$word."\"でした";
            echo "<br />";
        }
        echo "<a href='/?action=ready'>トップに戻る</a>";
    }
}
