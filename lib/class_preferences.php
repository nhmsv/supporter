<?php

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Preferences
  {
      
	  const TableName = "tb_preferences";
	  private static $db;

      function __construct($uid = 0 )
      {

		  self::$db = Registry::get("Database");

          if($uid == 0)
              $uid = UID;

          if($uid){

            $this->getPreferences($uid);

          }else{

            $this->getPreferencesDefault();

          }

      }

      private function getPreferences($uid){

          $row = Core::getRowByUid(self::TableName,$uid);

          $this->id = $row->id;
          $this->uid = $row->uid;
          $this->lang = $row->lang;
          $this->reply_start = $row->reply_start;
          $this->reply_start_eng = $row->reply_start_eng;
          $this->reply_end = $row->reply_end;
          $this->reply_end_eng = $row->reply_end_eng;

            $this->getgetPreferencesLang();

      }

      public function getStartReply(){
          if($this->lang == 'English'){
              return  getValue("StartReplay","tstartreplay","id = ".$this->reply_start_eng);
          }else{
              return  getValue("StartReplay","tstartreplay","id = ".$this->reply_start);
          }

      }

      public function getEndReply(){
          if($this->lang == 'English'){
              return  getValue("EndReplay","tendreplay","id = ".$this->reply_end_eng);
          }else{
              return  getValue("EndReplay","tendreplay","id = ".$this->reply_end);
          }

      }

      private function getPreferencesDefault(){

          $this->id = 1;
          $this->uid = 1;
          $this->lang = "English";
          $this->reply_start = 1;
          $this->reply_start_eng = 1;
          $this->reply_end = 1;
          $this->reply_end_eng = 1;
      }

      private function getgetPreferencesLang(){

          switch ($this->lang):
                case 'Arabic':

                    $this->dir = "rtl";
                    $this->dir_text = "right";
                    $this->pull = "right";
                    $this->pull_reverse = "left";

                    $this->reply_start_name = getValue("StartReplay","tstartreplay","id = ".$this->reply_start);
                    $this->reply_end_name = getValue("EndReplay","tendreplay","id = ".$this->reply_end);

                break;

              case 'English':
                  $this->dir = "ltr";
                  $this->dir_text = "left";
                  $this->pull = "left";
                  $this->pull_reverse = "right";

                  $this->reply_start_name = getValue("StartReplay","tstartreplay","id = ".$this->reply_start_eng);
                  $this->reply_end_name = getValue("EndReplay","tendreplay","id = ".$this->reply_end_eng);

                  break;
              endswitch;
      }
      public function changeLang(){

          $newLang = ($this->lang == 'Arabic')? 'English' : 'Arabic';
          $data['lang'] = $newLang;
          self::$db->update(self::TableName, $data , "id = " . $this->id);


      }

  }
?>