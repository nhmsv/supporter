<?PHP

define("_VALID_PHP", true);
require_once("../../init.php");
$id = post('id');

?>
<?PHP

if($pref->lang == "Arabic"){
    $data['reply_start'] = $id;
}else{
    $data['reply_start_eng'] = $id;
}

$db->update(Preferences::TableName, $data , "uid = 26");

$sql = "SELECT * FROM `tstartreplay` WHERE 1 AND Language = '".$pref->lang."' ORDER BY `id` ASC";
$pref = new Preferences(UID);
$result = $db->fetch_all($sql);
//$db->pre($result);
foreach ($result as $row):
    $link = "text text-muted";

    if($row->id == $pref->reply_start && $pref->lang == 'Arabic')
        $link = 'btn-primary bg-blue-darker';

    if($row->id == $pref->reply_start_eng && $pref->lang == 'English')
        $link = 'btn-primary bg-blue-darker';

    echo " <button class=\"btn btn-white-without-border $link  text-".$pref->dir_text." f-s-12 \" value=\"$row->StartReplay\" onclick='ajax_replies_start($row->id, this.value);callPreparing();' style='margin: 4px'>$row->StartReplay </button>";

endforeach;
?>

