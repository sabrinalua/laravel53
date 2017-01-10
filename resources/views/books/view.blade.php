@extends('layouts.app')

@section('content')
	<div class="container">
		<h1>{{$book->title}}</h1>
		@if(Auth::user()->type=='librarian')
		<a class="btn btn-primary" href="/books/update/{{$book->id}}">Update</a>
		@endif
		@if($book->status == 'available')
		<a class="btn btn-success" href="/books/borrow/{{$book->id}}">Borrow</a>
		@endif
		<table class="table table-stripped table-bordered">
			<tbody>
				<tr>
					<th>title</th>
					<td>{{$book->title}}</td>
				</tr>
				<tr>
					<th>Author</th>
					<td>{{$book->author}}</td>
				</tr>
				<tr>
					<th>ISBN</th>
					<td>{{$book->isbn}}</td>
				</tr>
				<tr>
					<th>Status</th>
					<td>{{$book->status}}</td>
				</tr>
				<tr>
					<td>Description</td>
					<td>{{$book->description}}</td>
				</tr>
				<tr>
					<td>Location</td>
					<td>{{$book->location}}</td>
				</tr>
				<tr>
					<td>Year</td>
					<td>{{$book->publish_year}}</td>
				</tr>

				<tr>
					<td>Publisher</td>
					<td>{{$book->publisher}}</td>
				</tr>

				<tr>
					<td>Price</td>
					<td>{{$book->price}}</td>
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
