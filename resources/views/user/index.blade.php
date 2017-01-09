@extends('layouts.app')
@section('content')
	<div class="container">

		<div class="jumbotron">
		<center><h1>User List</h1></center>
	</div>
		<table class="table table-stripped table-bordered">
			<tr>
				<thead>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>CONTACT</th>
					<th>AGE</th>
					<th>TYPE</th>
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