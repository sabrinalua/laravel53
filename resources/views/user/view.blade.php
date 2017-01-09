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
					<th>Name</th>
					<td>{{$user->name}}</td>
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
