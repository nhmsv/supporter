<?php
  /**
   * Functions
   *
   * @package Advamced Login System
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: functions.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
  
  /**
   * redirect_to()
   * 
   * @param mixed $location
   * @return
   */
  function redirect_to($location)
  {
      if (!headers_sent()) {
          header('Location: ' . $location);
		  exit;
	  } else
          echo '<script type="text/javascript">';
          echo 'window.location.href="' . $location . '";';
          echo '</script>';
          echo '<noscript>';
          echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
          echo '</noscript>';
  }
  
  /**
   * countEntries()
   * 
   * @param mixed $table
   * @param string $where
   * @param string $what
   * @return
   */
  function countEntries($table, $where = '', $what = '')
  {
      if (!empty($where) && isset($what)) {
          $q = "SELECT COUNT(*) FROM " . $table . "  WHERE " . $where . " = '" . $what . "' LIMIT 1";
      } else
          $q = "SELECT COUNT(*) FROM " . $table . " LIMIT 1";
      
      $record = Registry::get("Database")->query($q);
      $total = Registry::get("Database")->fetchrow($record);
      return $total[0];
  }
  
  /**
   * getChecked()
   * 
   * @param mixed $row
   * @param mixed $status
   * @return
   */
  function getChecked($row, $status)
  {
      if ($row == $status) {
          echo "checked=\"checked\"";
      }
  }
  
  /**
   * post()
   * 
   * @param mixed $var
   * @return
   */
  function post($var)
  {
      if (isset($_POST[$var]))
          return $_POST[$var];
  }
  
  /**
   * get()
   * 
   * @param mixed $var
   * @return
   */
  function get($var)
  {
      if (isset($_GET[$var]))
          return $_GET[$var];
  }
  
  /**
   * sanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function sanitize($string, $trim = false, $int = false, $str = false)
  {
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim)
          $string = substr($string, 0, $trim);
      if ($int)
		  $string = preg_replace("/[^0-9\s]/", "", $string);
      if ($str)
		  $string = preg_replace("/[^a-zA-Z\s]/", "", $string);
		  
      return $string;
  }

  /**
   * cleanSanitize()
   * 
   * @param mixed $string
   * @param bool $trim
   * @return
   */
  function cleanSanitize($string, $trim = false,  $end_char = '&#8230;')
  {
	  $string = cleanOut($string);
      $string = filter_var($string, FILTER_SANITIZE_STRING);
      $string = trim($string);
      $string = stripslashes($string);
      $string = strip_tags($string);
      $string = str_replace(array('‘', '’', '“', '”'), array("'", "'", '"', '"'), $string);
      
	  if ($trim) {
        if (strlen($string) < $trim)
        {
            return $string;
        }

        $string = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $string));

        if (strlen($string) <= $trim)
        {
            return $string;
        }

        $out = "";
        foreach (explode(' ', trim($string)) as $val)
        {
            $out .= $val.' ';

            if (strlen($out) >= $trim)
            {
                $out = trim($out);
                return (strlen($out) == strlen($string)) ? $out : $out.$end_char;
            }       
        }
	  }
      return $string;
  }

  /**
   * truncate()
   * 
   * @param mixed $string
   * @param mixed $length
   * @param bool $ellipsis
   * @return
   */
  function truncate($string, $length, $ellipsis = true)
  {
      $wide = strlen(preg_replace('/[^A-Z0-9_@#%$&]/', '', $string));
      $length = round($length - $wide * 0.2);
      $clean_string = preg_replace('/&[^;]+;/', '-', $string);
      if (strlen($clean_string) <= $length)
          return $string;
      $difference = $length - strlen($clean_string);
      $result = substr($string, 0, $difference);
      if ($result != $string and $ellipsis) {
          $result = add_ellipsis($result);
      }
      return $result;
  }
  
  /**
   * getValue()
   * 
   * @param mixed $stwhatring
   * @param mixed $table
   * @param mixed $where
   * @return
   */
  function getValue($what, $table, $where)
  {
      $sql = "SELECT $what FROM $table WHERE $where";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  }  

  /**
   * getValueById()
   * 
   * @param mixed $what
   * @param mixed $table
   * @param mixed $id
   * @return
   */
  function getValueById($what, $table, $id)
  {
      $sql = "SELECT $what FROM $table WHERE id = $id";
      $row = Registry::get("Database")->first($sql);
      return ($row) ? $row->$what : '';
  } 
  
  /**
   * tooltip()
   * 
   * @param mixed $tip
   * @return
   */
  function tooltip($tip)
  {
      return '<img src="'.SITEURL.'/images/tooltip.png" alt="Tip" class="tooltip" title="' . $tip . '" />';
  }
  
  /**
   * required()
   * 
   * @return
   */
  function required()
  {
      return '<img src="' . SITEURL . '/images/required.png" alt="Required Field" class="tooltip" title="Required Field" />';
  }

  /**
   * cleanOut()
   * 
   * @param mixed $text
   * @return
   */
  function cleanOut($text) {
	 $text =  strtr($text, array('\r\n' => "", '\r' => "", '\n' => ""));
	 $text = html_entity_decode($text, ENT_QUOTES, 'UTF-8');
	 $text = str_replace('<br>', '<br />', $text);
	 return stripslashes($text);
  }
    

  /**
   * isAdmin()
   * 
   * @param mixed $userlevel
   * @return
   */
  function isAdmin($userlevel)
  {
	  switch ($userlevel) {
		  case 9:
			 $display = '<i class="icon-user tooltip text-red" data-title="Super Admin"></i>';
			 break;

		  case 7:
		     $display = '<i class="icon-user tooltip text-green" data-title="User Level 7"></i>';
			 break;

		  case 6:
		     $$display = '<i class="icon-user tooltip text-orange" data-title="User Level 6"></i>';
			 break;

		  case 5:
		     $display = '<i class="icon-user tooltip text-blue" data-title="User Level 5"></i>';
			 break;
			 
		  case 4:
		     $$display = '<i class="icon-user tooltip text-green" data-title="User Level 4"></i>';
			 break;		  

		  case 3:
		     $display = '<i class="icon-user tooltip text-orange" data-title="User Level 3"></i>';
			 break;

		  case 2:
		     $display = '<i class="icon-user tooltip text-blue" data-title="User Level 2"></i>';
			 break;
			 
		  case 1:
		     $display = '<i class="icon-user tooltip text-green" data-title="User Level 1"></i>';
			 break;			  
	  }

      return $display;;
  }

  /**
   * getSize()
   * 
   * @param mixed $size
   * @param integer $precision
   * @param bool $long_name
   * @param bool $real_size
   * @return
   */
  function getSize($size, $precision = 2, $long_name = false, $real_size = true)
  {
      if ($size == 0) {
          return '-/-';
      } else {
          $base = $real_size ? 1024 : 1000;
          $pos = 0;
          while ($size > $base) {
              $size /= $base;
              $pos++;
          }
          $prefix = _getSizePrefix($pos);
          $size_name = $long_name ? $prefix . "bytes" : $prefix[0] . 'B';
          return round($size, $precision) . ' ' . ucfirst($size_name);


      }
  }

  /**
   * _getSizePrefix()
   * 
   * @param mixed $pos
   * @return
   */  
  function _getSizePrefix($pos)
  {
      switch ($pos) {
          case 00:
              return "";
          case 01:
              return "kilo";

          case 02:
              return "mega";
          case 03:
              return "giga";
          default:
              return "?-";
      }
  }
  
  /**
   * userStatus()
   * 
   * @param mixed $id
   * @return
   */
  function userStatus($status, $id)
  {
	  switch ($status) {
		  case "y":
			  $display = '<i class="icon-ok-sign text-green"></i> Active';
			  break;
			  
		  case "n":
			  $display = '<a class="activate" id="act_' . $id . '"><i class="icon-adjust text-orange"></i> Inactive</a>';
			  break;
			  
		  case "t":
			  $display = '<i class="icon-time text-blue"></i> Pending';
			  break;
			  
		  case "b":
			  $display = '<i class="icon-ban-circle text-red"></i> Banned';
			  break;
	  }
	  
      return $display;;
  }

  /**
   * isActive()
   * 
   * @param mixed $id
   * @return
   */
  function isActive($id)
  {
	  if ($id == 1) {
		  $display = '<span class="tbicon"><a class="tooltip" data-title="Yes"><i class="icon-check"></i></a></span>';
	  } else {
		  $display = '<span class="tbicon"><a class="tooltip" data-title="No"><i class="icon-time"></i></a></span>';
	  }

      return $display;;
  }

    function randName() {
	  $code = '';
	  for($x = 0; $x<6; $x++) {
		  $code .= '-'.substr(strtoupper(sha1(rand(0,999999999999999))),2,6);
	  }
	  $code = substr($code,1);
	  return $code;
  }

    function colorSearchString($pieces = null, $text = ""){
global $pref;
        $myWorld = array();
        $myWorld2 = array();
        if(!empty($text)){

            $myWorld = explode(" ", $text);
            $Count =  count($myWorld) ;
        }

        for($c = 0; $c <= $Count - 1; $c++){

            $string = $myWorld[$c];
            foreach ($pieces as $url) {

                    if(strtolower($string) == strtolower($url) || strpos($string, $url) !== FALSE){

                    if (in_array_case_insensitive($myWorld[$c], $myWorld)) {

                        if (in_array_case_insensitive($myWorld[$c], $pieces)) {

                            if(is_numeric($myWorld[$c])){

                                $myWorld[$c] =  str_replace($url,"<span class='text-primary'><strong>$url</strong></span>",$myWorld[$c]);;

                            }else{

                                $myWorld[$c] =  str_replace(case_insensitive($url, $myWorld[$c]),"<span class='text-danger'>".$url."</span>",$myWorld[$c]);

                            }


                        }else{

                            $myWorld[$c] =  str_replace(case_insensitive($url,$myWorld[$c]),"<span class='text-warning'><strong>".$url."</strong></span>",$myWorld[$c]);
                        }


                    }

                }else{

                        if($pref->lang == 'English') {

                            $myWorld[$c] =  str_replace(case_insensitive($url, $myWorld[$c]),"<span class='text-warning'><strong>".$url."</strong></span>",strtolower($myWorld[$c]));

                        }else{
                            $myWorld[$c] =  str_replace(case_insensitive($url, $myWorld[$c]),"<span class='text-warning'><strong>".$url."</strong></span>",$myWorld[$c]);
                        }

                    }

            }

            array_push($myWorld2 , findURLTurnToClickableLink($myWorld[$c]));



        }

        $lastText = implode(" " ,$myWorld2);

        return ($myWorld2) ?  $lastText : '';

    }

    function in_array_case_insensitive($needle, $haystack )
{
    global $pref;
    if($pref->lang == 'English'){
        return in_array(strtolower($needle), array_map('strtolower', $haystack) );
    }else{
        return in_array($needle,  $haystack);
    }



}


    function case_insensitive($val, $val2 ){

    return ($val == $val2 || $val == strtolower($val2) )? $val2 : $val;
}

    function findURLTurnToClickableLink($string){

        //FIND URLS INSIDE TEXT
        //The Regular Expression filter
        $reg_exUrl = "/(?i)\b((?:https?:\/\/|www\d{0,3}[.]|[a-z0-9.\-]+[.][a-z]{2,4}\/)(?:[^\s()<>]+|\(([^\s()<>]+|(\([^\s()<>]+\)))*\))+(?:\(([^\s()<>]+|(\([^\s()<>]+\)))*\)|[^\s`!()\[\]{};:'\".,<>?«»“”‘’]))/";

        // Check if there is a url in the text
        if(preg_match($reg_exUrl, $string, $url)) {

            if(strpos( $url[0], ":" ) === false){
                $link = 'http://'.$url[0];
            }else{
                $link = $url[0];
            }

            // make the urls hyper links
            $string = preg_replace($reg_exUrl, '<a href="'.$link.'" title="'.$url[0].'" target="_blank">'.$url[0].'</a>', $string);

        }

        return $string;
    }


    function getSignature(){
        global $pref;
        if($pref->lang == 'English'){
            return getValue("tCode_eng",Users::uTable, "id = " . UID);
        }else{
            return getValue("tCode",Users::uTable, "id = " . UID);
        }

    }
?>