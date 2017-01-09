@extends('layouts.app')
@section('content')
	<div class="container">

		<div class="jumbotron">
		<center><h1>Book List</h1></center>
	</div>
		<table class="table table-stripped table-bordered">
			<tr>
				<thead>
					<th>TITLE</th>
					<th>AUTHOR</th>
					<th>ISBN</th>
					<th>STATUS</th>
					<th></th>
				</thead>
				<tbody>
					@foreach($model as $m)
					<tr data-key= "{{$m->id}}">
						<td>{{$m->title}}</td>
						<td>{{$m->author}}</td>
						<td>{{$m->isbn}}</td>
						<td>{{$m->status}}</td>
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