@extends('layouts.app')
@section('content')
<div class="container">

	<div class="content">
		<h6>Search</h6>
		<form action="#" method="POST">
			{{ csrf_field() }}
			<input type="text" name="user_id" placeholder="borrower ID" class="form-control">
			<input type="text" name="book_id" placeholder="book ID" class="form-control">
			<input type="submit" name="Search" class="btn btn-success">
		</form>
	</div>
	</br>
	<table class="table table-stripped table-bordered">
		<tr>
			<thead>
				<th>BOOK</th>
				<th>BORROWER</th>
				<th>BORROW DATE</th>
				<th>DUE DATE</th>
				<th>STATUS</th>
				<th>FINES <br>(if applicable)</th>
			</thead>
			<tbody>
				@foreach($logs as $l)
				<tr data-key= "{{$l->id}}">
					<td>{{$l->book_title}}</td>
					<td>{{$l->borrower}}</td>
					<td>{{$l->borrow_date}}</td>
					<td>{{$l->due_date}}</td>
					<td>
					@if(empty($l->return_date))
					not returned 
					@if($l->overdue)
					</br><p style="color:red">OVERDUE by {{$l->diff}} days</p>
					@endif					
					@endif
					@if(!empty($l->return_date))
					returned on {{$l->return_date}}
					@endif
					</td>
					<td>{{ $l->fine }}</td>
				</tr>
				@endforeach
			</tbody>
		</tr>
	</table>
	<center>{!! $logs->links() !!}</center>
</div>
@stop