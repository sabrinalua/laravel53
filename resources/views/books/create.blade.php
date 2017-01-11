@extends('layouts.app')

@section('content')
<div class="container">

	<h1>Insert Book</h1>

<form action="{{ url('/books/create') }}" method="POST">
	{{ csrf_field() }}
	<label>TITLE</label>
	<input type="text" name="Book[title]" id="title" class="form-control" required>
	<label>ISBN</label>
	<input type="text" name="Book[isbn]" id="isbn" class="form-control" required>

	<label>Author</label>
	<input type="text" name="Book[author_fn]" id="author" class="form-control" placeholder="Initials" value="">
	<input type="text" name="Book[author_ln]" id="author" class="form-control" placeholder="Last Name" value="">
	<label>Description</label>
	<textarea name="Book[description]" id="description" class="form-control" maxlength="800" rows="8"></textarea>
	<label>Year Published</label>
	<input type="number" name="Book[publish_year]" max="2100" min="0000" id="publish_year" class="form-control">
	<label>Price</label>
			<input type="number" name="Book[price]" class="form-control" required>
	<label>Publisher</label>
	<input type="text" name="Book[publisher]" id="publisher" class="form-control">
	<label>Copies</label>
	<input type="number" name="Book[copies]" id="copies" class="form-control" placeholder="minimum 1" required>
	<label>Location</label>
	<select id ="location" class="form-control" name="Book[location]" value="{{ old('type') }}">
	@foreach($sections as $s)
	<option value="{{$s->section_code}}">{{$s->section_name}}</option>
	@endforeach
	</select>


	</br>
	<div>
		<button type="submit" class="btn btn-success">Go</button>
	</div>
		

</form>

</div>
@endsection
