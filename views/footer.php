
    <!-- begin theme-panel -->
    <div class="theme-panel">
        <a href="javascript:;" data-click="theme-panel-expand" class="theme-collapse-btn"><i class="fa fa-cog"></i></a>
        <div class="theme-panel-content">
            <h5 class="m-t-0">Color Theme</h5>
            <ul class="theme-list clearfix">
                <li class="active"><a href="javascript:;" class="bg-green" data-theme="default" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Default">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-red" data-theme="red" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Red">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-blue" data-theme="blue" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Blue">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-purple" data-theme="purple" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Purple">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-orange" data-theme="orange" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Orange">&nbsp;</a></li>
                <li><a href="javascript:;" class="bg-black" data-theme="black" data-click="theme-selector" data-toggle="tooltip" data-trigger="hover" data-container="body" data-title="Black">&nbsp;</a></li>
            </ul>
            <div class="divider"></div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Header Styling</div>
                <div class="col-md-7">
                    <select name="header-styling" class="form-control input-sm">
                        <option value="1">default</option>
                        <option value="2">inverse</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label">Header</div>
                <div class="col-md-7">
                    <select name="header-fixed" class="form-control input-sm">
                        <option value="1">fixed</option>
                        <option value="2">default</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Sidebar Styling</div>
                <div class="col-md-7">
                    <select name="sidebar-styling" class="form-control input-sm">
                        <option value="1">default</option>
                        <option value="2">grid</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label">Sidebar</div>
                <div class="col-md-7">
                    <select name="sidebar-fixed" class="form-control input-sm">
                        <option value="1">fixed</option>
                        <option value="2">default</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Sidebar Gradient</div>
                <div class="col-md-7">
                    <select name="content-gradient" class="form-control input-sm">
                        <option value="1">disabled</option>
                        <option value="2">enabled</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-5 control-label double-line">Content Styling</div>
                <div class="col-md-7">
                    <select name="content-styling" class="form-control input-sm">
                        <option value="1">default</option>
                        <option value="2">black</option>
                    </select>
                </div>
            </div>
            <div class="row m-t-10">
                <div class="col-md-12">
                    <a href="#" class="btn btn-inverse btn-block btn-sm" data-click="reset-local-storage"><i class="fa fa-refresh m-r-3"></i> Reset Local Storage</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end theme-panel -->

    <!-- begin scroll to top btn -->
    <a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
    <!-- end scroll to top btn -->
</div>
<!-- end page container -->

<!-- ================== BEGIN BASE JS ================== -->
<script src="assets/plugins/jquery/jquery-1.9.1.min.js"></script>
<script src="assets/plugins/jquery/jquery-migrate-1.1.0.min.js"></script>
<script src="assets/plugins/jquery-ui/ui/minified/jquery-ui.min.js"></script>
<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
<!--[if lt IE 9]>
<script src="assets/crossbrowserjs/html5shiv.js"></script>
<script src="assets/crossbrowserjs/respond.min.js"></script>
<script src="assets/crossbrowserjs/excanvas.min.js"></script>
<![endif]-->
<script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="assets/plugins/jquery-cookie/jquery.cookie.js"></script>
<!-- ================== END BASE JS ================== -->

    <script src="assets/plugins/clipboard/clipboard.min.js"></script>

    <script src="assets/js/myajax.js"></script>
<!-- ================== BEGIN PAGE LEVEL JS ================== -->
<script src="assets/js/apps.js"></script>
<!-- ================== END PAGE LEVEL JS ================== -->

<script>

    var handleJqueryAutocomplete = function() {
        var availableTags1 = [
            <?PHP
            $sql = "select `rShort` from treplay Where (username = 'Admin' OR username = '".USERNAME."') AND (Language = '".$pref->lang."' ) ORDER BY `treplay`.`usedCount` DESC ";
            $result = $db->fetch_all($sql);
            foreach ($result as $row):
            echo "'$row->rShort',\n";
            endforeach;
            ?>
        ];

        $('#jquery-autocomplete').autocomplete({
            source: availableTags1
        });
    };

    var handleJqueryAutocomplete2 = function() {
        var availableTags = [
            <?PHP
            $sql2 = "select `text` from  tb_autocomplete Where (username = 'Admin' OR username = '" . USERNAME . "') AND (Language = '" . $pref->lang . "' ) ORDER BY id DESC ";
            $result2 = $db->fetch_all($sql2);

            foreach ($result2 as $row2):
                echo "'$row2->text',\n";
            endforeach;
            ?>

        ];
        var minWordLength = 2;

        function split(val) {
            return val.split(' ');
        }

        function extractLast(term) {
            return split(term).pop();
        }

        $("#mainTextArea")
        // don't navigate away from the field on tab when selecting an item
            .bind("keydown", function (event) {
                if (event.keyCode === $.ui.keyCode.TAB && $(this).data("ui-autocomplete").menu.active) {
                    event.preventDefault();
                }
            }).autocomplete({
            minLength: minWordLength,
            source: function (request, response) {
                // delegate back to autocomplete, but extract the last term
                var term = extractLast(request.term);
                if (term.length >= minWordLength) {
                    response($.ui.autocomplete.filter(availableTags, term));
                }
            },
            focus: function () {
                // prevent value inserted on focus
                return false;
            },
            select: function (event, ui) {
                var terms = split(this.value);
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push(ui.item.value);
                // add placeholder to get the comma-and-space at the end
                terms.push("");
                this.value = terms.join(" ");
                return false;
            }
        });
    };

    $(document).ready(function() {
        App.init();

       // handleJqueryAutocomplete();
        handleJqueryAutocomplete2();
        <?PHP if($pref->lang == 'Arabic'){?>
        ajax_replies_start(<?PHP echo $pref->reply_start; ?>);
        ajax_replies_end(<?PHP echo $pref->reply_end; ?>);
        <?PHP }else{?>
        ajax_replies_start(<?PHP echo $pref->reply_start_eng; ?>);
        ajax_replies_end(<?PHP echo $pref->reply_end_eng; ?>);

        <?PHP }?>

        startOfReply('<?PHP echo $pref->reply_start_name; ?>');
        endOfReply('<?PHP echo $pref->reply_end_name; ?>');
        getSignature('<?PHP echo getSignature(); ?>')

        callPreparing();

    });

    function copyReplay() {

        $('#btnCopyReply').trigger('click');

    }

    $('#searchByPrice').focus();


</script>
</body>
</html>
