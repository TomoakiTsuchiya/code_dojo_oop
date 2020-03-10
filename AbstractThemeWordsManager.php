<?php
require_once "ThemeWordsProvider.php";

abstract class AbstractThemeWordsManager
{

    protected $themeWordProvider;
    private $minorWord;
    private $majorWord;

    function __construct(ThemeWordsProvider $themeWordProvider)
    {
        $this->themeWordProvider = $themeWordProvider;
    }

    function getThemeWordsProvider(): ThemeWordsProvider
    {
        return $this->themeWordProvider;
    }

    public function initThemeWords()
    {
        $themeCandidates = $this->getThemeWordsProvider()->getThemeWords();
        $this->themeCandidates =  $themeCandidates;
        $this->minorWord = $this->chooseMinorWord($themeCandidates);
        $this->removeMinorWordFromCandidates($this->minorWord, $themeCandidates);
        $this->majorWord = $this->chooseMajorWord($themeCandidates);
    }

    abstract protected function chooseMinorWord($candidates): string;
    abstract protected function chooseMajorWord($candidates): string;
    abstract protected function removeMinorWordFromCandidates($minorWord, &$themeCandidates);

    public function getMinorWord(): string
    {
        return $this->minorWord;
    }

    public function getMajarWord(): string
    {
        return $this->majorWord;
    }
}
