<?php
interface ThemeWordsProvider{
    function getThemeWords() : array;
}

class ThemeWords implements ThemeWordsProvider{
    protected $themeWordProvider;

    function __construct(ThemeWordsProvider $themeWordProvider)
    {
        $this->themeWordProvider = $themeWordProvider;
    }
    public function getThemeWords()
    {
        return $this->themeWordProvider;         
    }
}