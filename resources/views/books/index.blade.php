@extends('layouts.app')
@section('content')
	<div class="container">
		<h5>Search</h5>
		<div id="searchdiv">
			<form action="#" method="POST">
			{{ csrf_field() }}
			<input type="text" name="title" placeholder="book title" class="form-control">
			<input type="text" name="author" placeholder="author" class="form-control" >
			<input type="text" name="isbn" placeholder="isbn" class="form-control">
			<select name="status" class="form-control">
				<option value="">All</option>
				<option value="borrowed">borrowed</option>
				<option value="available">available</option>
				<option value="lost">lost</option>
			</select>
				<button class="btn btn-success">submit</button>
			</form>
		</div>
		</br>
		<table class="table table-stripped table-bordered">
			<tr>
				<thead>
					<th>TITLE</th>
					<th>AUTHOR</th>
					<th>ISBN</th>
					<th>STATUS</th>
					<th>LOCATION/SECTION</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($model as $m)
					<tr data-key= "{{$m->id}}">
						<td>{{$m->title}}</td>
						<td>{{$m->author}}</td>
						<td>{{$m->isbn}}</td>
						<td>{{$m->status}}</td>
						<td>{{$m->location}}</td>
						<td>
							<a href="/books/view/{{$m->id}}"><span class="glyphicon glyphicon-eye-open"></span></a>
							@if(Auth::user()->type=='librarian')
							<a href="/books/update/{{$m->id}}"><span class="glyphicon glyphicon-pencil"></span></a> 
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
