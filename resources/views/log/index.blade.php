@extends('layouts.app')
@section('content')
<div class="container">
<h1> Loan Logs</h1>
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
	@if(Session::has('status'))
    <p style="color: red">{{Session::get('status')}}</p>           
    @endif
	<table class="table table-stripped table-bordered">
		<tr>
			<thead>
				<th>BOOK</th>
				<th>BORROWER</th>
				<th>BORROW DATE</th>
				<th>DUE DATE</th>
				<th>STATUS</th>
				<th>FINES <br>(if applicable)</th>
				<th>ACTIONS</th>
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
					<td>
						@if(empty($l->return_date))
						<a style ="color: red" href="/books/report/{{$l->id}}">report loss/<br> late payment</a><br>
						@if(!$l->overdue)
						<a href="/books/return/{{$l->id}}">return</a>
						@endif
						@endif				
					</td>
				</tr>
				@endforeach
			</tbody>
		</tr>
	</table>
	<center>{!! $logs->links() !!}</center>
</div>
@stop