function clearFields() {


	$('#searchBy-rShort').val('');
	$('#searchBy-rLong').val('');
	$('#searchBy-Price').val('');
	$('#searchBy-General').val('');


}

	function startOfReply(myVal) {
		$('#input-startOfReply').val(myVal);
	}

	function endOfReply(myVal) {
		$('#input-endOfReply').val(myVal);
	}

	function getSignature(myVal) {
	$('#input-tCode').val(myVal);
	}

	function callPreparing() {

		var fullText = "";
		fullText += $('#input-startOfReply').val();
		fullText += ' ';
		fullText += $('#mainTextArea').val();
		fullText += ' ';
		fullText += $('#input-endOfReply').val();
		fullText += ' ';
		fullText += $('#input-tCode').val();

		$('#mainTextArea-copy').val(fullText);

		$('#btnCopyReply').html('<i class="fa fa-copy fa-x2"></i>');

	}

	function copyText() {

		var org = $('#mainTextArea').val();
		var fullText = "";

		var copyText = document.getElementById("mainTextArea");

		fullText  = $('#input-startOfReply').val();
		fullText += ' ';
		fullText  += $('#mainTextArea').val();
		fullText += ' ';
		fullText  += $('#input-endOfReply').val();
		fullText += ' ';
		fullText  += $('#input-tCode').val();


		 $('#mainTextArea').val(fullText);
		 copyText.select();

		document.execCommand("copy");

		$('#mainTextArea').val(org);
		//$('#COPY_MESSAGE').slideToggle();
		$('#btnCopyReply').html('<i class="fa fa-check"></i>');


	}

function searchGeneral(val){

	if(val != ""){

		$.post('views/actions/replies.php',{
				type:'searchGeneral',
				text:val.trim()
			},
			function(data){

				if(data){
					$('#RepliesList').html(data);
					$('#cPanel').hide();
				}else{
					$('#RepliesList').html('');
					$('#cPanel').show();
				}
			});

	}else{

		$('#RepliesList').html('');
		$('#cPanel').show();


	}

}



function doCopy(){

		$.post('views/actions/ajax.php',{
				type:'copy',
				body: $('#mainTextArea').val(),
			},
			function(data){

				$('#mainTextArea-copy').val(data);

			});
	callPreparing();
	$('#btnFinalCopyReply').trigger('click');

}

function Action_All(val,type){

	$.post('views/actions/replies.php',{
			text:val,
			type:type
		},
		function(data){

			$('#RepliesList').html(data);
		});
}

function searchReplyHistory(val){

	$.post('views/actions/replies-history.php',{
			type:'searchGeneral',
			text:val
		},
		function(data){

			$('#RepliesHistory').html(data);
		});
}


function changeLang(){

	$.post('views/actions/ajax.php',{
			type:'changeLang'
		},
		function(data){
			window.location.reload();
		});
}

function getLastRepliesFromHistory(id){

	$('#sid').val(id);

	$.post('views/actions/ajax.php',{
			id:id,
			type:'getLastRepliesFromHistory',

		},
		function(data){

			$('#mainTextArea').html(data);
		});
}

function textAjax(id){

	$('#sid').val(id);

	$.post('views/actions/ajax.php',{
			id:id
		},
		function(data){

			$('#mainTextArea').html(data);
		});
}


function ajax_replies_start(id, myValue){

	startOfReply(myValue);

	$.post('views/actions/ajax-replies-start.php',{
			id:id
		},
		function(data){

			$('#ajax-replies-start').html(data);

		});
}

function ajax_replies_end(id, myValue){

	endOfReply(myValue);

	$.post('views/actions/ajax-replies-end.php',{
			id:id
		},
		function(data){

			$('#ajax-replies-end').html(data);

		});
}

function insertReplyById(id) {

	$.post('views/actions/ajax.php',{
			type:'insertReplyById',
			id:id
		},
		function(data){

			if(data){
				appendToReplies(data);
				updateCounter(id);

				//doCopy();
			}

		});
}

function insertReplyByHistoryId(id) {

	$.post('views/actions/ajax.php',{
			type:'insertReplyByHistoryId',
			id:id
		},
		function(data){

			if(data){
				appendToReplies(data);

			}

		});
}

function appendToReplies(val) {

	insertAtCaret('mainTextArea',val);
	$('#cPanel').show();
}

function updateCounter(id) {

	$.post('views/actions/ajax.php',{
			type:'updateCounter',
			id:id,
		},
		function(data){
			$('#show-ajax').html(data);
		});
}

function upWindow() {

	$('html, body').animate({
		scrollTop: $("body").offset().top
	}, 500);
}

function insertAtCaret(areaId, text) {

	var txtarea = document.getElementById(areaId);
	if (!txtarea) {
		return;
	}

	var scrollPos = txtarea.scrollTop;
	var strPos = 0;
	var br = ((txtarea.selectionStart || txtarea.selectionStart == '0') ?
		"ff" : (document.selection ? "ie" : false));
	if (br == "ie") {
		txtarea.focus();
		var range = document.selection.createRange();
		range.moveStart('character', -txtarea.value.length);
		strPos = range.text.length;
	} else if (br == "ff") {
		strPos = txtarea.selectionStart;
	}

	var front = (txtarea.value).substring(0, strPos);
	var back = (txtarea.value).substring(strPos, txtarea.value.length);
	txtarea.value = front + text + back;
	strPos = strPos + text.length;
	if (br == "ie") {
		txtarea.focus();
		var ieRange = document.selection.createRange();
		ieRange.moveStart('character', -txtarea.value.length);
		ieRange.moveStart('character', strPos);
		ieRange.moveEnd('character', 0);
		ieRange.select();
	} else if (br == "ff") {
		txtarea.selectionStart = strPos;
		txtarea.selectionEnd = strPos;
		txtarea.focus();
	}

	txtarea.scrollTop = scrollPos;
	$('#mainDiv').show();
	$('#searchByPrice').val('');

	upWindow();
}

function resetReply() {
	$('#btnCopyReply').html('<i class="fa fa-copy fa-2x"></i>');
	$('#mainTextArea').val('');
	$( "#mainTextArea" ).focus();
}