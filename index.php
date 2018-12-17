<?PHP
define("_VALID_PHP", true);
require_once("init.php");

$replies = new Replies();

?>
<?PHP include "views/header.php";?>



    <!-- begin #content -->
    <div id="content" class="content content-full-width m-t-20" >

        <div id="show-ajax"></div>

        <div class="m-b-15">
            <input type="text" id="input-startOfReply" value="">
            <input type="text" id="input-endOfReply" value="">
            <input type="text" id="input-tCode" value="">
        </div>


        <div class="col-lg-11 pull-<?PHP echo $pref->pull_reverse;?>" >
        <div id="RepliesList" ></div>

        <div id="cPanel">

        <div class="col-lg-7 pull-<?PHP echo $pref->pull_reverse;?> " dir="<?PHP echo $pref->dir;?>">

            <div class="col-lg-6 pull-<?PHP echo $pref->pull_reverse;?>">

                <?PHP
                $sql = "SELECT * FROM `treplay` Where username = 'Admin' AND Language = '".$pref->lang."' ORDER BY `treplay`.`usedCount` DESC LIMIT 10";
                $result = $db->fetch_all($sql);
                //$db->pre($result);
                ?>

                <div class="panel panel-success">



                        <h6 class="bg-green-darker modal-header f-w-700 text-white" style="margin-top: -10px;" align="<?PHP echo $pref->dir_text; ?>">
                            <i class="fa fa-user-circle"></i>
                            <?PHP echo $lang->lang['GENERAL_REPLIES']; ?>
                            <small class="pull-<?PHP echo $pref->pull_reverse; ?> text-white f-w-700 f-s-14">
                                <?PHP echo $lang->lang['TOP10']; ?>
                                <i class="fa fa-sort-numeric-desc"></i>
                            </small>
                        </h6>
                        <table class="table table-hover">

                            <tbody>
                            <?PHP $i= 0 ; foreach ($result as $row):$i++;?>
                                <tr>
                                    <th>

                                        <?PHP echo $i;?></th>
                                    <td style="cursor: pointer;"  ondblclick="insertReplyById(<?PHP echo $row->ID;?>);">
                                        <?PHP echo $row->rShort;?>
                                        <i class="pull-<?PHP echo $pref->pull_reverse;?> fa fa-arrow-circle-<?PHP echo $row->arrow;?> text text-<?PHP echo ($row->arrow == 'up')? 'success':'danger';?>" dir="ltr" title="<?PHP echo $row->luDate;?>"></i>
                                    </td>



                                </tr>
                            <?PHP endforeach;?>


                            </tbody>
                        </table>

                        <?PHP
                        $sql = "SELECT * FROM `treplay` Where username = '".USERNAME."' AND Language = '".$pref->lang."' ORDER BY `treplay`.`usedCount` DESC LIMIT 10";
                        $result = $db->fetch_all($sql);
                        ?>
                        <h6 class="bg-green-darker modal-header f-w-700 text-white" align="<?PHP echo $pref->dir_text; ?>">
                            <i class="fa fa-user"></i>
                            <?PHP echo $lang->lang['SPECIAL_REPLIES']; ?>
                            <small class="pull-<?PHP echo $pref->pull_reverse; ?> text-white f-w-700 f-s-14">

                                <?PHP echo $lang->lang['TOP10']; ?>
                                <i class="fa fa-sort-numeric-desc"></i>
                            </small>
                        </h6>
                        <table class="table table-hover">

                            <tbody>
                            <?PHP $i= 0 ; foreach ($result as $row):$i++;?>
                                <tr>
                                    <th><?PHP echo $i;?></th>
                                    <td style="cursor: pointer;" ondblclick="insertReplyById(<?PHP echo $row->ID;?>);">
                                        <?PHP echo $row->rShort;?>
                                        <i class="pull-<?PHP echo $pref->pull_reverse;?> fa fa-arrow-circle-<?PHP echo $row->arrow;?> text text-<?PHP echo ($row->arrow == 'up')? 'success':'danger';?>" dir="ltr" title="<?PHP echo $row->luDate;?>"></i>
                                    </td>

                                </tr>
                            <?PHP endforeach;?>


                            </tbody>
                        </table>


                </div>

            </div>

            <div class="col-lg-6 pull-<?PHP echo $pref->pull_reverse;?>">

                <?PHP
                $sql = "SELECT * FROM `treplay` Where username = 'Admin' AND Language = '".$pref->lang."' AND uFav = 1 ORDER BY `treplay`.`usedCount` DESC";
                $result = $db->fetch_all($sql);
                //$db->pre($result);
                ?>

                <div class="panel panel-primary">

                        <h6 onclick="alert('Change');" class="bg-blue-darker modal-header f-w-700 text-white" style="margin-top: -10px; cursor: pointer;" align="<?PHP echo $pref->dir_text; ?>">
                            <i class="fa fa-user-circle"></i>
                            <?PHP echo $lang->lang['GENERAL_FAVORITES']; ?>
                            <small class="pull-<?PHP echo $pref->pull_reverse; ?> text-white f-w-700 f-s-14">
                                <i class="fa fa-heart"></i>
                            </small>
                        </h6>

                        <table class="table table-hover">

                            <tbody>
                            <?PHP $f = 0 ;foreach ($result as $row):$f++;?>
                                <tr>
                                    <th><?PHP echo $f;?></th>


                                    <td =""  style="cursor: pointer;" ondblclick="insertReplyById(<?PHP echo $row->ID;?>);">
                                        <?PHP echo (strlen($row->rShort) <70)? $row->rShort : sanitize($row->rShort,75)."...";?>

                                    </td>
                                    <td width="100px;">
                                        <div class="btn-group pull-left">
                                            <button class="btn btn-xs  btn-info"><i class="fa fa-twitter"></i></button>
                                            <button class="btn btn-xs btn-default"><i class="fa fa-copy"></i></button>
                                        </div>
                                    </td>

                                </tr>
                            <?PHP endforeach;?>


                            </tbody>
                        </table>


                </div>

            </div>

        </div>


        <div class="col-lg-5 pull-<?PHP echo $pref->pull;?> " dir="<?PHP echo $pref->dir;?>">

                <div id="mainDiv">

                    <div class="panel panel-inverse bg-white">

                        <div class="panel-heading">

                            <div class="panel-heading-btn pull-<?PHP echo $pref->pull_reverse;?>" >

                                <div id="ajax-replies-rows"></div>

                            </div>

                            <h4 class="panel-title"> لوحد الرد</h4>
                        </div>

                        <div class="panel-body">

                            <div class="bg-white">
                                <legend>Search</legend>
                                <div id="ajax-replies-start"></div>

                            </div>

                            <div class="border-bottom-1" style="margin-top: 5px; margin-bottom: 5px;"></div>

                            <div class="bg-white">
                                <legend>Search</legend>
                                <div id="ajax-replies-end"></div>

                            </div>
                            <div class="border-bottom-1" style="margin-top: 5px; margin-bottom: 5px;"></div>

                            <h4 id="HEADER_TITLE" class="modal-header" align="center"><?PHP echo $lang->lang['HEADER_TITLE']; ?></h4>
                            <div id="COPY_MESSAGE" class="alert alert-success" style="display: none;">This Message has been Copy</div>
                            <div class="col-lg-12">
                                <?PHP

                                $rLong = $replies->getMyRepliesHistoryById();

                                ?>
                                <textarea dir="<?PHP echo $pref->dir;?>" class="form-control f-s-18" name="mainTextArea" id="mainTextArea" onkeyup="callPreparing();" rows="8" placeholder="<?PHP echo $lang->lang['WRITE_REPLY_HERE']; ?>" ><?PHP echo ($rLong)? $rLong->rLong :'';?></textarea>

                                <hr>

                                <div class="col-lg-3">
                                    <button id="btnClearReply" class="btn btn-lg btn-default btn-block pull-right" type="button" onclick="resetReply();">
                                        <i class="fa fa-close fa-2x "></i>
                                    </button>
                                </div>

                                <div class="col-lg-9">
                                    <button type="button" id="btnCopyReply" onclick="copyText();" class="btn btn-lg btn-success btn-block"></button>
                                </div>



                            </div>


                        </div>

                    </div>

                </div>
            </div>

        </div>

            <div class="col-lg-12">

                <div class="tab-pane tab-overflow  overflow-right">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#default-tab-1" data-toggle="tab" aria-expanded="true">
                                <span class="visible-xs">بحث عام</span>
                                <span class="hidden-xs">بحث عام</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#default-tab-2" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs">ردود اليوم</span>
                                <span class="hidden-xs">ردود اليوم</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#default-tab-3" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs">ردود الشهر</span>
                                <span class="hidden-xs">ردود الشهر</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="default-tab-1">
                            <h3 class="m-t-10"><i class="fa fa-cog"></i> Lorem ipsum dolor sit amet</h3>
                            <p>
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                Integer ac dui eu felis hendrerit lobortis. Phasellus elementum, nibh eget adipiscing porttitor,
                                est diam sagittis orci, a ornare nisi quam elementum tortor. Proin interdum ante porta est convallis
                                dapibus dictum in nibh. Aenean quis massa congue metus mollis fermentum eget et tellus.
                                Aenean tincidunt, mauris ut dignissim lacinia, nisi urna consectetur sapien, nec eleifend orci eros id lectus.
                            </p>
                            <p class="text-right m-b-0">
                                <a href="javascript:;" class="btn btn-white m-r-5">Default</a>
                                <a href="javascript:;" class="btn btn-primary">Primary</a>
                            </p>
                        </div>
                        <div class="tab-pane fade" id="default-tab-2">
                            <blockquote>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                                <small>Someone famous in <cite title="Source Title">Source Title</cite></small>
                            </blockquote>
                            <h4>Lorem ipsum dolor sit amet</h4>
                            <p>
                                Nullam ac sapien justo. Nam augue mauris, malesuada non magna sed, feugiat blandit ligula.
                                In tristique tincidunt purus id iaculis. Pellentesque volutpat tortor a mauris convallis,
                                sit amet scelerisque lectus adipiscing.
                            </p>
                        </div>
                        <div class="tab-pane fade" id="default-tab-3">
                            <p>
								<span class="fa-stack fa-4x pull-left m-r-10">
									<i class="fa fa-square-o fa-stack-2x"></i>
									<i class="fa fa-twitter fa-stack-1x"></i>
								</span>
                                Praesent tincidunt nulla ut elit vestibulum viverra. Sed placerat magna eget eros accumsan elementum.
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam quis lobortis neque.
                                Maecenas justo odio, bibendum fringilla quam nec, commodo rutrum quam.
                                Donec cursus erat in lacus congue sodales. Nunc bibendum id augue sit amet placerat.
                                Quisque et quam id felis tempus volutpat at at diam. Vivamus ac diam turpis.Sed at lacinia augue.
                                Nulla facilisi. Fusce at erat suscipit, dapibus elit quis, luctus nulla.
                                Quisque adipiscing dui nec orci fermentum blandit.
                                Sed at lacinia augue. Nulla facilisi. Fusce at erat suscipit, dapibus elit quis, luctus nulla.
                                Quisque adipiscing dui nec orci fermentum blandit.
                            </p>
                        </div>
                    </div>

                </div>

                <div class="panel panel-inverse">


                    <div class="panel-body">

                        <div class="col-lg-2 pull-<?PHP echo $pref->pull;?>">
                            <label>Search</label>
                            <input class="form-control" type="text" onkeyup="searchReplyHistory(this.value)">
                        </div>

                        <div id="RepliesHistory"></div>

                    </div>
                </div>



            </div>

        </div>

        <div class="col-lg-1 pull-left" dir="<?PHP echo $pref->dir;?>">

            <div class="panel panel-primary">
                <div class="panel-body">
                    <legend>Search</legend>


                    <div class="form-group">
                        <label >بحث في العناوين</label>
                        <input type="text" id="searchBy-rShort" class="form-control" placeholder="العنوان" onkeyup="Action_All(this.value,'rShort');" onfocus="clearFields();">
                    </div>

                    <div class="form-group">
                        <label >بحث التفاصيل</label>
                        <input type="text" id="searchBy-rLong" class="form-control" placeholder="التفاصيل" onkeyup="Action_All(this.value,'rLong');" onfocus="clearFields();">
                    </div>

                    <div class="form-group">
                        <label >بحث في الأسعار</label>
                        <input type="text" id="searchBy-Price" class="form-control" placeholder="السعر" onkeyup="Action_All(this.value,'Price');" onfocus="clearFields();">
                    </div>

                    <div class="form-group">
                        <label >بحث عام</label>
                        <input type="text" id="searchBy-General" class="form-control" placeholder="بحث عام" onkeyup="Action_All(this.value,'searchGeneral');" onfocus="clearFields();">
                    </div>


                </div>
            </div>

        </div>


    </div>
    <!-- end #content -->



<?PHP include "views/footer.php";?>