@extends('layouts.app')
@section('content')
<div class="container">
	<form method="POST" action="/books/borrow">
	{{ csrf_field() }}
		<label>BOOK TITLE</label>
		<input readonly type="text" name="Borrower" value= "{{$book->title}}" class="form-control">
		<label>BOOK AUTHOR</label>
		<input readonly type="text" name="Borrower" value= "{{$book->author}}" class="form-control">
		<label>Borrower</label>
		<input readonly type="text" name="Borrower" value= "{{Auth::user()->name}}" class="form-control">
		<label>BORROWDATE</label>
		<input readonly type="text" name="Log[borrow_date]" value= "{{$now->format('Y-m-d')}}" class="form-control">
		<label>Due Date</label>
		<input readonly type="text" name="Log[due_date]" value= "{{$return->format('Y-m-d')}}" class="form-control">

		<input type="hidden" name="Log[book_id]" value="{{$book->id}}">

		<button type="Submit" class="btn btn-success">Confirm</button>
		<a href="/home" onclick="goBack();" class="btn btn-danger">Cancel</a>

	</form>
</div>
@stop

<script type="text/javascript">
	function goBack() {
    window.history.back();
}
</script>