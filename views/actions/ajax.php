<?PHP

define("_VALID_PHP", true);
require_once("../../init.php");
$id = post('id');
$type = post('type');

$replies = new Replies();
$pref = new Preferences();

switch ($type):

    case 'changeLang':
        $pref->changeLang();
    break;

    case 'updateCounter':

        $replies->updateCounter($id);

    break;

    case 'getLastRepliesFromHistory':
       echo getValue("rLong","treplay_history","ID = $id");
    break;

    case 'insertReplyById':
       echo getValue("rLong","treplay","ID = $id");
    break;

       case 'insertReplyByHistoryId':
       echo getValue("rLong","treplay_history","ID = $id");
    break;

    case 'copy':

        $out =  $pref->getStartReply() ;
        $out .=  ' ';
        $out .=  post('body') ;
        $out .=  ' ';
        $out .=  $pref->getEndReply() ;
        $out .=  ' ';
        $out .=  getSignature();
        echo cleanOut($out);
        break;

    default:
        break;

endswitch;
?>
