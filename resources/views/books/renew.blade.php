@extends('layouts.app')
@section('content')
<div class="container">
<h1>Renew Loan</h1>
	<form action="/books/renew" method="POST">
	{{ csrf_field() }}
		<input type="hidden" name="NewLog[book_id]" value="{{$log->book_id}}">
		<input type="hidden" name="OldLog[id]" value="{{$log->id}}">
		<input type="hidden" name="">

		<label>BOOK TITLE</label>
		<input readonly type="text" name="username" class="form-control" value="{{$book->title}}">
		<label>AUTHOR</label>
		<input readonly type="text" name="username" class="form-control" value="{{$book->author}}">

		<label>BORROWER ID</label>
		<input readonly type="text" name="NewLog[user_id]" class="form-control" value="{{Auth::user()->id}}">
		<label>BORROWER</label>
		<input readonly type="text" name="username" class="form-control" value="{{Auth::user()->name}}">
		

		<label>TODAY</label>
		<input readonly type="text" name="NewLog[borrow_date]" class="form-control" value="{{$now->format('Y-m-d')}}">
		<label>OLD DUE DATE</label>
		<input readonly type="text" name="odd" class="form-control" value="{{$log->due_date}}">
		<label>NEW DUE DATE</label>
		<input readonly type="text" name="NewLog[due_date]" class="form-control" value="{{$return->format('Y-m-d')}}">
		<button class ="btn btn-success" type="submit">Renew</button>

	</form>
</div>
@stop