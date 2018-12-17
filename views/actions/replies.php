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
            if($pref->lang == 'English'){
                $pieces = explode(" ", strtolower($text));
            }else{
                $pieces = explode(" ", $text);
            }


            $pieces = array_unique($pieces);
            $pieces = (array_filter($pieces));
            $Count =  count($pieces) ;
        }

      //  $db->pre($pieces);

        $FullString = "";

        if(!empty($pieces)):
            for($c = 0; $c <= $Count - 1; $c++){
                if(isset($pieces) && $pieces[$c]):
                    $FullString .= " AND `rLong` LIKE '%".$pieces[$c]."%'   ";
                endif;

            }
        endif;

        $sql = "SELECT * FROM `treplay` Where (username = 'Admin' OR username = '".USERNAME."') AND (Language = '".$pref->lang."' $FullString ) ORDER BY `treplay`.`usedCount` DESC LIMIT 100";
        break;

        case 'Price':
        $sql = "SELECT * FROM `treplay` Where username = 'Admin' AND Language = '".$pref->lang."' AND Price = '$text' ORDER BY `treplay`.`usedCount` DESC LIMIT 100";
        break;

        case 'rShort':
        $sql = "SELECT * FROM `treplay` Where username = 'Admin' AND Language = '".$pref->lang."' AND rShort LIKE '%$text%' ORDER BY `treplay`.`usedCount` DESC LIMIT 100";
        break;

        case 'rLong':
        $sql = "SELECT * FROM `treplay` Where username = 'Admin' AND Language = '".$pref->lang."' AND rLong LIKE '%$text%' ORDER BY `treplay`.`usedCount` DESC LIMIT 100";
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


                            <table class="table table-hover table-bordered table-responsive table-email" dir="<?PHP echo $pref->dir;?>">
                                <thead>
                                <tr>
                                    <th class="text-right">العنوان</th>
                                    <th class="text-right">التفاصيل</th>
                                    <th class="text-right">السعر</th>
                                    <th class="text-right">الكاتب</th>
                                    <th class="text-right">آخر تحديث</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?PHP foreach ($result as $row):?>
                                    <tr ondblclick="insertReplyById(<?PHP echo  $row->ID ;?>);$('#RepliesList').html('');return false;" >
                                        <td class="text-muted f-w-600 f-s-14" width="20%">
                                           <?PHP
                                                echo $row->rShort;

                                                ?>

                                        </td>
                                        <td width="70%" class="f-s-14 text-<?PHP echo $pref->dir_text;?>">
                                            <?PHP

                                            //$db->pre($pieces);
                                            if(!empty($pieces)):
                                                echo colorSearchString($pieces, $row->rLong);
                                            endif;


                                           if($type == 'rLong' || $type == 'Price'){
                                               echo str_replace($text, "<strong class='text text-danger'>$text</strong>", $row->rLong);
                                           }


                                            if($type == 'rShort'){
                                                $my = explode(" ",strtolower($text));

                                                if(!empty($my)):
                                                echo colorSearchString($my, $row->rLong);
                                                    endif;
                                            }




                                            ?>
                                        </td>
                                        <td nowrap=""><strong class="text-danger"><?PHP echo $row->price;?></strong></td>
                                        <td nowrap="" dir="ltr"><?PHP      if($row->username == 'Admin'){
                                                echo "<span class=\"fa fa-check-circle text-success fa-2x pull-left\"></span>";
                                            }else{
                                                echo "<span class=\"fa fa-user text-muted fa-2x pull-left\" title='".$row->username."'></span>";
                                            }
                                            ;?></td>
                                        <td nowrap="" dir="ltr"><?PHP echo $row->luDate;?></td>
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