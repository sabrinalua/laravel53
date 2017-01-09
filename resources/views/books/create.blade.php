@extends('layouts.app')

@section('content')
<div class="container">
<div class="jumbotron">
	<center><h1>Insert Book</h1></center>
</div>
<form action="{{ url('/books/create') }}" method="POST">
	{{ csrf_field() }}
	<label>TITLE</label>
	<input type="text" name="Book[title]" id="title" class="form-control" required>
	<label>ISBN</label>
	<input type="text" name="Book[isbn]" id="isbn" class="form-control" required>
	<label>Author</label>
	<input type="text" name="Book[author_fn]" id="author" class="form-control" placeholder="Initials" value="">
	<input type="text" name="Book[author_ln]" id="author" class="form-control" placeholder="Last Name" value="">
	<label>Location</label>
	<input type="text" name="Book[location]" id="location" class="form-control" required>
	
	</br>
	<div>
		<button type="submit" class="btn btn-success">Go</button>
	</div>
		

</form>

</div>
@endsection
