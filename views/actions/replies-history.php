<?PHP

define("_VALID_PHP", true);
require_once("../../init.php");

$type = post('type');
$text = post('text');
$sql = "";

if(trim($text)){
switch ($type):
    case 'searchGeneral':

        $pieces = array();
        if(!empty($text)){
            $pieces = explode(" ", strtolower($text));

            $pieces = array_unique($pieces);
            $pieces = (array_filter($pieces));
            $Count =  count($pieces) ;
        }

        $FullString = "";

        if(!empty($pieces)):
            for($c = 0; $c <= $Count - 1; $c++){
                if(isset($pieces) && $pieces[$c]):
                    $FullString .= " AND `rLong` LIKE '%".$pieces[$c]."%'   ";
                endif;

            }
        endif;

        if($text)
        $sql = "SELECT * FROM `treplay_history` Where username = '".USERNAME."' $FullString  ORDER BY `id` DESC LIMIT 100";

        break;

    case 'searchPrice':

        break;

    default:
        break;
endswitch;
?>

<?PHP

if($sql){
$result = $db->fetch_all($sql);
//$db->pre($result);

?>
<span class="text text-left pull-left bg-white text-danger f-s-18" dir="ltr"><?PHP //echo $sql;?></span>
        <div class="row">
            <div class="col-md-12 ui-sortable">
                <div class="panel panel-inverse">

                    <div class="panel-body" dir="rtl">


                        <div class="table-responsive">

                            <div class="form-group">
                                <?PHP
                                if(!empty($pieces)):
                                    for($c = 0; $c <= $Count - 1; $c++){
                                        if(isset($pieces) && $pieces[$c]):
                                            echo "<label class=\"clearfix\">$pieces[$c]</label> ";
                                        endif;

                                    }
                                endif;
                                ?>
                            </div>


                            <table class="table table-hover table-bordered table-responsive table-email" dir="rtl">
                                <thead>
                                <tr>
                                    <th class="text-right">التفاصيل</th>
                                    <th class="text-right">آخر تحديث</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?PHP foreach ($result as $row):?>
                                    <tr ondblclick="insertReplyByHistoryId(<?PHP echo $row->ID ;?>);" >

                                        <td width="100%" class="f-s-14 text-<?PHP echo $pref->dir_text;?>">
                                            <?PHP
                                            //$db->pre($pieces);
                                            if(!empty($pieces)):

                                                echo colorSearchString($pieces, $row->rLong);

                                            endif;

                                            ?>
                                        </td>

                                        <td nowrap="" dir="ltr"><?PHP echo $row->cDate;?></td>
                                    </tr>
                                <?PHP endforeach;?>


                                </tbody>
                            </table>



                    </div>
                </div>
            </div>
        </div>
<?PHP }else{
  //  echo "<script>$('#mainDiv').show();</script>";
}

}
?>
