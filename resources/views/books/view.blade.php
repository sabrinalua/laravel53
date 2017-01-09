@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>{{$book->title}}</h1>
		@if(Auth::user()->type=='librarian')
		<a class="btn btn-primary" href="/books/update/{{$book->id}}">Update</a>
		<a class="btn btn-danger" href="#">Delete</a>
		@endif
		<a class="btn btn-success" href="#">Borrow</a>
		<table class="table table-stripped table-bordered">
			<tbody>
				<tr>
					<th>title</th>
					<td>{{$book->title}}</td>
				</tr>
				<tr>
					<th>Author</th>
					<td>{{$book->author}}}</td>
				</tr>
				<tr>
					<th>ISBN</th>
					<td>{{$book->isbn}}</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>{{$book->status}}</td>
				</tr>

			</tbody>
			
		</table>		
	</div>

	<form id="borrow-form">
		{{ csrf_field() }}
	</form>

	<form id="return-form">
		{{ csrf_field() }}
	</form>
@endsection
