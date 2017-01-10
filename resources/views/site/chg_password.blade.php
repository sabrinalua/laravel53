@extends('layouts.app')
@section('content')
<div class="container">

@if(Session::has('pw_error'))
<p style="color: red">{{Session::get('pw_error')}}</p>           
@endif
<h1>change password</h1>
	<form action="/password" method="POST">
		{{ csrf_field() }}
		<input required type="password" name="Pw[old]" placeholder="old password" class="form-control" id="old_pw">
		<input required title="passwords must be 6 characters minimum" pattern=".{6,}" type="password" name="Pw[p1]" placeholder="new password" class="form-control" id="p1">
		<input required title="passwords must be 6 characters minimum" pattern=".{6,}" type="password" name="Pw[p2]" placeholder="type your new password again" class="form-control" id="p2">
		<p id="validate" style="color: red"></p>
		<button id="sub_btn" disabled class="btn btn-success">Submit</button>
	</form>
</div>
@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#p2").keyup(validate);
});

function validate(){
	var p1 = $('#p1').val();
	var p2 = $('#p2').val();

	var lp1 = p1.length;
	var lp2 = p2.length;
	var lp0 = $('#old_pw').val().length;

	// if(p1==p2 && lp1 > 5 && lp2 > 5 && lp0!=0){
	// 	$('#sub_btn').prop("disabled", false);
	// }else{
	// 	$('#sub_btn').prop("disabled", true);
	// }

	if(p1 == p2){ //password match,
		if(lp1 > 5 && lp2 > 5 && lp0!=0){ //check for length
			$('#sub_btn').prop("disabled", false);
			$('#validate').text('');
		}
	}else{
		$('#sub_btn').prop("disabled", true);
		$('#validate').text('password doesnt match');
	}


}
</script>
