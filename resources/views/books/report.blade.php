@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Report Loss/ Return</h1>
	<form action="/books/report" method="POST">
		{{ csrf_field() }}
		<label>Type</label>
		<select class="form-control" name="Fines[type]" id="type_ddl">
			<option value="return">Return</option>
			<option value="lost">Lost Book </option>
		</select>
		<input type="hidden" name="Fines[user_id]" value="{{$log->user_id}}">
		<input type="hidden" name="Fines[book_id]" value="{{$log->book_id}}">
		<input type="hidden" name="Fines[log_id]" value="{{$log->id}}">
		<input type="hidden" name="book_value" value="{{$book->price}}" id="book_price" readonly>
		<input type="hidden" name="dooda" id="dooda" value="{{$log->fine}}">

		<label>Book</label>
		<input type="text" name="book" readonly value="{{$book->title}}" class="form-control">
		<label>User </label>
		<input type="text" name="user" readonly class="form-control" value="{{$user->name}}">
		<label>Due Date</label>
		<input type="text" name="due" readonly class="form-control" value="{{$log->due_date}}">
		<label>Return Date</label>
		<input class="form-control" readonly type="text" name="Fines[return_date]" value="{{$log->return_date->format('Y-m-d')}}">
		<label>Total Fines</label>
		<input type="text" readonly name="Fines[total_fines]" id = "total_fines" value="{{$log->fine}}" readonly class="form-control">
		<label>Comment</label>
		<textarea id="texta" name="Fines[comment]" rows="3" readonly maxlength="50" placeholder="reason book is missing" class="form-control"></textarea>
		<input type="submit" name="Submit Report">
	</form>
</div>
@stop

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#type_ddl').change(function(){
			var stat = this.value;
			var price  = parseInt($('#book_price').val());
			var fines = parseInt($('#dooda').val());
			if(stat=='lost'){				
				$('#total_fines').val(price + fines);
				$("#texta").removeAttr('readonly');
			}else{				
				$('#total_fines').val(fines);
				$("#texta").attr('readonly','readonly');

			}
		});
	});
</script>