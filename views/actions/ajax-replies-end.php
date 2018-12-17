<?PHP

define("_VALID_PHP", true);
require_once("../../init.php");
$id = post('id');

?>
<?PHP

if($pref->lang == "Arabic"){
    $data['reply_end'] = $id;
}else{
    $data['reply_end_eng'] = $id;
}

$db->update(Preferences::TableName, $data , "uid = 26");

$sql = "SELECT * FROM `tendreplay` WHERE 1 AND Language = '".$pref->lang."' ORDER BY `id` ASC";
$pref = new Preferences(UID);
$result = $db->fetch_all($sql);

foreach ($result as $row):
    $link = "btn-default";

    if($row->id == $pref->reply_end && $pref->lang == 'Arabic')
        $link = 'btn-danger bg-red-darker';

    if($row->id == $pref->reply_end_eng && $pref->lang == 'English')
        $link = 'btn-danger bg-red-darker';


    echo " <button class=\"btn  btn-white-without-border $link  text-".$pref->dir_text." \" value=\"$row->EndReplay\" onclick='ajax_replies_end($row->id, this.value);callPreparing();' style='margin: 2px'>$row->EndReplay </button>";

endforeach;



?>

