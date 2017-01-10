@extends('layouts.app')
@section('content')
	<div class="container">
	<h1>Users</h1>
		<div>
		<h5>Search</h5>
		<form action="#" method="POST">
			{{ csrf_field() }}
			<input type="text" name="id" placeholder="user id" class="form-control">
			<input type="text" name="email" placeholder="email" class="form-control">
			<input type="text" name="name" placeholder="nickname" class="form-control">
			<input type="text" name="first_name" placeholder="first name" class="form-control">
			<input type="text" name="last_name" placeholder="last name" class="form-control">
			<select name="type" class="form-control">
				<option value="">All</option>
				<option value="librarian">Librarian</option>
				<option value="borrower">Borrower</option>
			</select>
			<input type="submit" name="Search" class="btn btn-success">
		</form>
		</div>
		</br>
		<h2>List Users</h2>
		<table class="table table-stripped table-bordered">
			<tr>
				<thead>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>CONTACT</th>
					<th>AGE</th>
					<th>TYPE</th>
					<th>TOTAL BOOKS LENT</th>
					<th>CURRENT</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($model as $m)
					<tr data-key= "{{$m->id}}">
						<td>{{$m->name}}</td>
						<td>{{$m->email}}</td>
						<td>{{$m->contact}}</td>
						<td>{{$m->age}}</td>
						<td>{{$m->type}}</td>
						<td>{{$m->total}}</td>
						<td>{{$m->current}}</td>
						<td>
							<a href="/users/view/{{$m->id}}"><span class="glyphicon glyphicon-eye-open"></span></a>
							@if(Auth::user()->type=='librarian')
							<a href="/users/update/{{$m->id}}"><span class="glyphicon glyphicon-pencil"></span></a> 
							<a href="#"><span>delete</span></a>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</tr>
		</table>
		<center>{!! $model->links() !!}</center>
	</div>

@stop