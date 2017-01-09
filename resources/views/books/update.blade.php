@extends('layouts.app')
@section('content')
	<div class="container">
		<form action="/books/update" method="POST">
			{{ csrf_field() }}
			<label>Title</label>
			<input type="text" name="title" readonly value="{{$book->title}}" class="form-control">
			<label>Author</label>
			<input type="text" name="author" readonly value="{{$book->author}}" class="form-control">
			<label>Publisher</label>
			<input type="text" name="publisher" readonly value="{{$book->publisher}}" class="form-control">
			<label>Year</label>
			<input type="text" name="year" readonly value="{{$book->publish_year}}" class="form-control">
			<label>Description</label>
			<textarea name="Book[description]" rows="8" class="form-control">{{$book->description}}</textarea>
			<label>Genre</label>
			<select name="Book[location]" class="form-control">
				@foreach($section as $s)
				<option value="{{$s->section_code}}" {{$book->location ==$s->section_code ? 'selected="selected"':''}}>{{$s->section_name}}</option>
				@endforeach
			</select>
			</br>
			<input type="hidden" name="Book[id]" value="{{$book->id}}">
			<input type="submit" class="btn btn-success" name="Submit">
		</form>
	</div>
@stop