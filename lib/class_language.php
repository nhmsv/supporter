<?php

class Language {

    private $UserLng;
    private $langSelected;
    public $lang = array();


    public function __construct($userLanguage = 'en'){


        $this->UserLng = $userLanguage;
        //construct lang file
        $langFile = BASEPATH.'lib/lang/'. $this->UserLng . '.ini';
        if(!file_exists($langFile)){
            throw new Execption("Language could not be loaded"); //or default to a language
        }

        $this->lang = parse_ini_file($langFile);
    }

    public function userLanguage(){
        return $this->lang;
    }

}