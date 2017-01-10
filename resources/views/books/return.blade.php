@extends('layouts.app')
@section('content')
<div class="container">
<h1>Return Book</h1>
	<form action="/books/return" method="post">
		{{ csrf_field() }}
		<input type="hidden" name="Log[id]" value="{{$log->id}}">
		<input type="hidden" name="Log[book_id]" value="{{$log->book_id}}">
		<label>Book</label>
		<input type="text" readonly name="book_title" value="{{$book->title}}" class="form-control">
		<label>ISBN</label>
		<input type="text" readonly name="book_title" value="{{$book->isbn}}" class="form-control">
		<label>Borrower</label>
		<input type="text" readonly name="borrower_name" value="{{$borrower->name}}" class="form-control">
		<label>Due date</label>
		<input type="text" readonly name="due_adt" value="{{$log->due_date}}" class="form-control">
		<label>Return date</label>
		<input type="text" readonly name="Log[return_date]" value="{{$return->format('Y-m-d')}}" class="form-control">
		</br>
		<input type="submit" name="Return Book" class="btn btn-success">
	</form>
</div>
@stop