<?php
  /**
   * Init
   *
   * @package Advanced Login System
   * @author wojoscripts.com
   * @copyright 2010
   * @version $Id: init.php, v2.00 2011-07-10 10:12:05 gewa Exp $
   */
  if (!defined("_VALID_PHP"))
      die('Direct access to this location is not allowed.');
?>
<?php //error_reporting(E_ALL);
  
  $BASEPATH = str_replace("init.php", "", realpath(__FILE__));
  
  define("BASEPATH", $BASEPATH);
  
  $configFile = BASEPATH . "lib/config.ini.php";
  if (file_exists($configFile)) {
      require_once($configFile);
  } else {
      header("Location: setup/");
  }
  
  require_once(BASEPATH . "lib/class_db.php");
  
  require_once(BASEPATH . "lib/class_registry.php");
  Registry::set('Database',new Database(DB_SERVER, DB_USER, DB_PASS, DB_DATABASE));
  $db = Registry::get("Database");
  $db->connect();
  
  //Include Functions
  require_once(BASEPATH . "lib/functions.php");
  
  require_once(BASEPATH . "lib/class_filter.php");
  $request = new Filter();
	
  //Start Core Class 
  require_once(BASEPATH . "lib/class_core.php");
  Registry::set('Core',new Core());
  $core = Registry::get("Core");


    require_once(BASEPATH . "lib/class_replies.php");
    Registry::set('Replies',new Replies());
    $replies = Registry::get("Replies");


  
  //StartUser Class 
  require_once(BASEPATH . "lib/class_user.php");
  Registry::set('Users',new Users());
  $user = Registry::get("Users");

    define("SITEURL", $core->site_url);
    define("ADMINURL", $core->site_url."/admin");
    define("SITENAME", $core->site_name);
    define("UPLOADS", BASEPATH."uploads/");
    define("UPLOADURL", SITEURL."/uploads/");


    define("UID", 26);
    define("USERNAME", 101737);

    //Start Core Class
    require_once(BASEPATH . "lib/class_preferences.php");
    Registry::set('Preferences',new Preferences(UID));
//    $pref = Registry::get("Preferences");
    $pref = new Preferences(UID);

    $lg = ($pref->lang == 'English')? 'en' : 'ar' ;

    require_once(BASEPATH . "lib/class_language.php");
    Registry::set('Language',new Language($lg));
    $lang = Registry::get("Language");

//var_dump($lang);

    //$db->pre($pref);
?>