<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Laravel PHP Framework</title>	
	<script src='https://code.jquery.com/jquery-1.11.1.min.js'></script>
	<style>
		body {
			margin: 0;
		}
	
		.adminHeader {
			background-color: rgb(149, 165, 166);
			padding: .5em;
			margin: 0;
		}
		
		.login {
			background-color: rgb(149, 165, 166);
			padding: 1em;
			width: 75%;
			max-width: 25em;
			margin: 3em auto 0;
			text-align: center;
		}
		
		a {
			appearance: button;
			color: black;
			text-decoration: none;
			padding: .125em .75em .125em;
			-o-button: button;
			-moz-appearance: button;
			-webkit-appearance: button;
			appearance: button;
		}
		
		.login label, .login input {
			display: inline-block;
			width: 10em;
		}
	
		.clr {
			clear: both;
			height: 0;
		}
		
		.outercontainer {
			padding: 0;
		}
	
		button, input[type=submit] {
			-webkit-appearance: button;
			-moz-appearance:    button;
			appearance:         button;
			/*background-color: white;
			border: solid 2px black;
			border-radius: 1em;
			color: black;
			padding: 2px;*/
			color: black;
			padding: 0 1em 0;
			text-decoration: none;
			cursor: pointer;
		}
		
		form {
			display: inline-block;
		}
	
		.container, .subsection, .section {
			border: solid 1px gray;
			padding: .5em;
			margin: .25em;
			border-radius: .75em;
		}
		
		.section {
			background-color: white;
		}
		
		.subsection {
			border: 0;
			padding: 0;
			margin: 0;
		}
		
		.container {
			background-color: rgb(149, 165, 166);
		}
		
		.collapse .subsection {
			display: none;
		}
		
		/*Editable styles*/
		div, span {
			transition: background-color 3s;
		}
		
		h1.editable input {
			font-size: 100%;
		}
		
		.editable textarea {
			width: 99%;
			min-height: 9em; 
		}
		
		.editable input[type=text] {
			width: 30%;
			min-width: 50em;
		}
		
		.errorResult{
			background-color: red;
		}
		
		.successResult{
			background-color: green;
		}
		
		/*for items that should only be shown when jquery runs*/
		.enhanceShow{
			display: none;
		}
	</style>
</head>
<body>
	<div class='adminHeader'>	
		@if (Auth::check())
			Logged in as {{Auth::user()->name}}
			{{link_to('logout', 'Log Out')}}
			<br class='clr'>
		@else
			You are not logged in.
		@endif
	</div>

	<div class='outercontainer'>
		@yield('content')
	</div>
</body>

<script>
function flashClass(domElem, className) {
	domElem.addClass(className).delay(750).queue(function(next){$(this).removeClass(className); next();});
}

function doEditUpdate( dom) {
	parent = dom.parent();
	newval = dom.val();

	$.ajax( '{{route('api')}}', {
		method: "post",
		dataType: "json",
		data: {
			'operation-type': parent.data('operation'),
			'id': parent.data('id'),
			'field': parent.data('field'),
			'value': newval,
		},
		success: function( data){
			parent.html( newval);
			parent.removeClass('editing');
			if (data['status'] != 'success') {
				flashClass(parent, 'errorResult');
			}
			else {
				flashClass(parent, 'successResult');
			}
		},
		error: function(xhr, status, errorThrown){
			alert( 'Unkown error: '+xhr);
			console.dir(xhr);
		},
	});
}

function doAjaxDeleteItem(){
	var id = $(this).data('id');
	var module = $(this).data('module');
	
	$.ajax( '{{route('api')}}', {
		method: "post",
		dataType: "json",
		data: {
			'operation-type': 'delete-'+module,
			'id': id,
		},
		success: function( data){
			if (data['status'] != 'success') {
				alert("Operation failed: "+data['message']);
			}
			else {
				var elementid = '#'+module+'-'+id;
				$(elementid).slideUp(200).queue(function(next){ $(this).remove(); next(); });
			}
		},
		error: function(xhr, status, errorThrown){
			alert( 'Unkown error: '+xhr);
			console.dir(xhr);
		},
	});			
	return false;
}

function doAjaxCreateItem(){
	var formdata = {};
	$(this).find('textarea, input[type=hidden], input[type=text]').each(function(){
		var field = $(this).attr('name');
		var value = $(this).val();
		formdata[field] = value;
	});
	var module = $(this).data('module');
	var optype = 'create-'+module;
	
	$.ajax( '{{route('api')}}', {
		method: "post",
		dataType: "json",
		data: {
			'operation-type': optype,
			'formdata': formdata,
		},
		success: function( data){
			if (data['status'] != 'success') {
				alert("Operation failed: "+data['message']);
			}
			else {
				var parentid = '#'+module+'s-'+formdata['project_id'];
				$(parentid).append( data['data']['html']);
				flashClass( $(parentid), "successResult");
				$(parentid + " .ajaxDelete").submit( doAjaxDeleteItem);
			}
		},
		error: function(xhr, status, errorThrown){
			alert( 'Unkown error: '+xhr);
			console.dir(xhr);
		},
	});		
	return false;
}

function enhance(){
	$('.js-showhide').off('click').click(function(){
		$(this).closest('.container').toggleClass('collapse');
	});
	
	$('.container').addClass('collapse');
	
	$('.needsConfirm').off('click').click(function(event){
		if ( !confirm('Are you sure')){
			event.preventDefault();
			return false;
		}
	});
	
	$('.editable').off('click').click(function(){
		var oldval = $(this).html();
		
		if ( $(this).hasClass('editing')) {
			return false;
		}
		$(this).addClass('editing');
		if ( $(this).prop('tagName') == 'DIV') {
			$(this).html('<textarea>'+oldval+'</textarea>');
		}
		else {
			$(this).html("<input type='text' value='"+oldval+"'/>");
		}
		var ta = $(this).children().first();
		ta.focus();
		ta.blur(function(){
			doEditUpdate( $(this));
		});
	});
	
	$('.enhanceHide').hide();
	$('.enhanceShow').show();
	
	$('.ajax-form').off('submit').submit(doAjaxCreateItem);
	
	$('.ajaxDelete').off('submit').submit(doAjaxDeleteItem);
}

$(document).ready(enhance);
</script>

</html>
