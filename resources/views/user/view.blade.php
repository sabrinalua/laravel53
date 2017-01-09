@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>{{$user->title}}</h1>
		@if(Auth::user()->type=='librarian')
		<a class="btn btn-primary" href="/users/update/{{$user->id}}">Update</a>
		<a class="btn btn-danger" href="#">Delete</a>
		@endif
		<table class="table table-stripped table-bordered">
			<tbody>
			<tr>
					<th>Designation</th>
					<td>{{$user->designation}}</td>
				</tr>
				<tr>
					<th>Name</th>
					<td>{{$user->first_name}} {{$user->last_name}}</td>
				</tr>
				<tr>
					<th>DOB</th>
					<td>{{$user->dob}}</td>
				</tr>
				<tr>
					<th>Email</th>
					<td>{{$user->email}}</td>
				</tr>
				<tr>
					<th>Type</th>
					<td>{{$user->type}}</td>
				</tr>
				<tr>
					<th>Contact Info</th>
					<td>{{$user->contact}}</td>
				</tr>

			</tbody>
			
		</table>		
	</div>
@endsection
