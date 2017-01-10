@extends('layouts.app')
@section('content')
<div class="container">
	<form action="#" method="POST">
		<label>Nickname</label>
		<input type="text" name="User[name]" value="{{$user->name}}" class="form-control" required>
		<label>Designation</label>
		<select class="form-control" name="User[designation]">
			@foreach($designation as $d)
			<option value="{{$d}}" {{$user->designation ==$d ? 'selected="selected"':''}} >{{$d}}</option>
			@endforeach
		</select>
		<label>First Name</label>
		<input type="text" name="name" value="{{$user->first_name}}" class="form-control" readonly>
		<label>Last Name</label>
		<input type="text" name="name" value="{{$user->last_name}}" class="form-control" readonly>
		<label>E-mail</label>
		<input type="text" name="name" value="{{$user->email}}" class="form-control" readonly>
		<label>Contact</label>
		<input type="text" name="User['contact']" value="{{$user->contact}}" class="form-control" required=>
		<label>Address</label>
		<input type="text" name="User['address']" value="{{$user->address}}" class="form-control" required>
	</form>
</div>

@stop

<!-- <select>
@foreach($roles as $key => $value)
<option value="{{$key}}" {{$user->type ==$key ? 'selected="selected"':''}} >{{$value}}</option>
@endforeach
</select> -->