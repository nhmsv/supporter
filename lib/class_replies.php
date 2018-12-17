<?php

  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  class Replies
  {
      
	  const TableName = "treplay_history";
	  private static $db;

      function __construct()
      {
		  self::$db = Registry::get("Database");
      }

      public function getMyRepliesHistoryById($id = 0){
            if($id == 0)
                $id = Filter::$id;

          if($id){

              $row = Core::getRowById(self::TableName, $id, "username = 101737");

              return ($row)? $row : null;
              }

          return null;
      }



      public function getMyRepliesHistoryFirst($PF = ""){

          if($PF == "")
              $PF = "101737";

          if($PF){
              $sql = "SELECT * FROM `treplay_history` WHERE `username` LIKE '$PF' ORDER BY `treplay_history`.`ID` ASC LIMIT 1";
              $result = self::$db->fetch_all($sql);

              return ($result)? $result[0]->ID : null;
          }

          return null;
      }

      public function getMyRepliesHistoryLast($PF = ""){

          if($PF == "")
              $PF = "101737";

          if($PF){
              $sql = "SELECT * FROM `treplay_history` WHERE `username` LIKE '$PF' ORDER BY `treplay_history`.`ID` DESC LIMIT 1";
              $result = self::$db->fetch_all($sql);

              return ($result)? $result[0]->ID : null;
          }

          return null;
      }

      public function getMyRepliesHistoryNext($PF = ""){

          if(Filter::$id) {
              if ($PF == "")
                  $PF = "101737";

              if ($PF) {
                  $sql = "SELECT * FROM `treplay_history` WHERE `username` LIKE '$PF' AND id > " . Filter::$id . " ORDER BY `treplay_history`.`ID` ASC LIMIT 1";
                  $result = self::$db->fetch_all($sql);

                  return ($result) ? $result[0]->ID : null;
              }

          }

          return null;
      }

      public function getMyRepliesHistoryPre($PF = ""){

          if(Filter::$id){

          if($PF == "")
              $PF = "101737";

          if($PF){
              $sql = "SELECT * FROM `treplay_history` WHERE `username` LIKE '$PF' AND id < ".Filter::$id." ORDER BY `treplay_history`.`ID` DESC LIMIT 1";
              $result = self::$db->fetch_all($sql);

              return ($result)? $result[0]->ID : null;
          }

          }
          return null;
      }

      public function updateCounter($id = 0 ){

          $table = 'treplay';

          if(!$id)
              $id = Filter::$id;

          $row = Core::getRowById($table, $id);
          $usedCount = $row->usedCount;
          $newUsedCount = $usedCount + 1;

          $sql = "SELECT * FROM `treplay` WHERE 
                  Language = '".$row->Language."' 
                  AND (username = '".USERNAME."' OR username = 'Admin') AND usedCount >= ".$usedCount." AND ID != $id ORDER BY `usedCount` ASC LIMIT 1";

          $result = self::$db->fetch_all($sql);



          if($result) {
              $topCount = $result[0]->usedCount;

           //   self::$db->pre($result);

              if ($topCount <= $newUsedCount) {

                  $lower['arrow'] = 'down';
                  $hair['arrow'] = 'up';

                  self::$db->update("treplay", $lower, "ID = " . $result[0]->ID);
                  self::$db->update("treplay", $hair, "ID = " . $id);

              }else{

                  $lower['arrow'] = 'up';
                  $hair['arrow'] = 'down';

                  self::$db->update("treplay", $lower, "ID = " . $result[0]->ID);
                  self::$db->update("treplay", $hair, "ID = " . $id);

              }

          }

          $data2['usedCount'] = $newUsedCount;
          self::$db->update("treplay", $data2 , "ID = " . $id);


      }



  }
?>