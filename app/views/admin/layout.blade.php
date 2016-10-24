<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Portfolio Writer</title>	
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
			padding: 0 .75em 0;
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
			color: black;
			padding: 0 1em 0;
			text-decoration: none;
			cursor: pointer;
		}
		
		form {
			display: inline-block;
		}
		
		label {
			display: inline-block;
			min-width: 5em;
		}
	
		.container, .subsection, .section {
			border: solid 1px gray;
			padding: .5em;
			margin: .25em;
			border-radius: .25em;
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
		div, span, .editable, .moveable {
			transition: background-color 3s;
		}
		
		h1.editable input {
			font-size: 100%;
		}
		
		.editable {
			padding: .2em;
			border: solid 2px rgb(225,225,225);
			cursor: pointer;
		}

		span.editable{
			display: inline-block;
			min-width: 2em;
		}

		div.editable{
			display: block;
			min-width: 2em;
			min-height: 2em;
		}		
		
		.editable textarea {
			width: 99%;
			min-height: 9em; 
		}
		
		.editable input[type=text] {
			width: 25%;
			min-width: 30em;
		}
		
		.errorResult{
			background-color: red;
		}

		.warningResult{
			background-color: yellow;
		}
		
		.successResult{
			background-color: green;
		}
		
		.adminThumb {
			height: 50px;
			max-width: 100px;
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

function updateThumbnail(id, value) {
	$('#thumb-'+id).attr('src', value);
}

function doEditUpdate( element) {
	console.log('doing edit update');
	var parent = element.parent();
	var newval = element.val();
	var updateCallback = parent.data('postupdate');
	var id = parent.data('id');
	var fieldname = parent.data('field');	

	$.ajax( '{{route('api')}}', {
		method: "post",
		dataType: "json",
		data: {
			'operation-type': parent.data('operation'),
			'id': id,
			'field': fieldname,
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
				if (typeof(updateCallback) !== 'undefined') {
					window[updateCallback](id, newval);
				}
			}
		},
		error: function(xhr, status, errorThrown){
			alert( 'Unkown error: '+JSON.stringify(xhr));
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
			alert( 'Unkown error: '+JSON.stringify(xhr));
			console.dir(xhr);
		},
	});			
	return false;
}

function doAjaxCreateItem(){
	var formdata = {};
	var form = $(this);	
	form.find('textarea, input[type=hidden], input[type=text]').each(function(){
		var field = $(this).attr('name');
		var value = $(this).val();
		formdata[field] = value;
	});
	var module = form.data('module');
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
				enhance(false);				
				
				form.find('textarea, input[type=text]').each(function(){
					$(this).val('');
				});
				firstchild = form.find('input[type=text]').first().focus();
			}
		},
		error: function(xhr, status, errorThrown){
			alert( 'Unkown error: '+JSON.stringify(xhr));
			console.dir(xhr);
		},
	});		
	return false;
}

function moveItem(element, direction) {
	if (direction === 'up') {
		element.prev().before( element);
	}
	else if (direction === 'down') {
		element.next().after( element);
	}
	else {
		alert("Invalid direction: "+direction);
	}
}

function enhance(firstpass){
	if (firstpass) {
		$('.container').addClass('collapse');
	}
	
	$('.enhanceHide').hide();
	$('.enhanceShow').show();
	
	$('.js-showhide').off('click').click(function(){
		$(this).closest('.container').toggleClass('collapse');
	});
	
	$('.needsConfirm').off('click').click(function(event){
		if ( !confirm('Are you sure')){
			event.preventDefault();
			return false;
		}
	});
	
	$('.ajaxMove').submit(function(event){
		event.preventDefault();

		var thisMov = $(this).closest('.moveable');
		var direction = $(this).data('direction');
		
		$.ajax( $(this).attr('action'), {
			method: "post",
			dataType: "json",
			data: $(this).serialize(),
			success: function( data){
				if (data['status'] == 'success') {			
					flashClass( thisMov, "successResult");				
					moveItem(thisMov, direction);
				}
				else if ( data['status'] == 'error') {
					alert("Operation failed: "+data['message']);
					flashClass( thisMov, "errorResult");					
				}
				else if ( data['status'] == 'warning') {
					flashClass( thisMov, "warningResult");
				}
			},
			error: function(xhr, status, errorThrown){
				alert( 'Unkown error: '+JSON.stringify(xhr));
				console.dir(xhr);
			},
		});		
	
		return false;
	});
	
	$('.editable').off('click').click(function(){
		var oldval = $(this).html();
		
		if ( $(this).hasClass('editing')) {
			return false;
		}
		$(this).addClass('editing');
		if ( $(this).prop('tagName') == 'DIV') {
			$(this).html('<textarea>'+oldval+'</textarea>');
			var ta = $(this).children().first();			
		}
		else {
			$(this).html("<input type='text'/>");
			var ta = $(this).children().first();						
			ta.val( oldval);			
		}
		
		ta.focus();
		ta.blur(function(){
			doEditUpdate( $(this));
		});
	});
	
	$('.ajax-form').off('submit').submit(doAjaxCreateItem);	
	$('.ajaxDelete').off('submit').submit(doAjaxDeleteItem);	
}

$(document).ready(function(){ enhance(true); });
</script>

</html>
