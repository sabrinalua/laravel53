@extends('layouts.app')
@section('content')

<div class="container">
	<h2>Borrow History</h2>
	<table class="table table-stripped table-bordered">
		<tr>
			<thead>
				<th>BOOK</th>
				<th>BORROW DATE</th>
				<th>DUE DATE</th>
				<th>STATUS</th>
				<th>FINES <br>(if applicable)</th>
				<th>ACTION</th>
			</thead>
			<tbody>
				@foreach($log as $l)
				<tr data-key= "{{$l->id}}">
					<td>{{$l->book_title}}</td>
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
					@if(!$l->overdue)
						@if(empty($l->return_date))
						<a href="/books/renew/{{$l->id}}">renew loan</a>
						@endif
						@if(empty($l->return_date))
						<!-- <br>
						<a style="color: red" href="">report loss</a> -->
						@endif
					@endif
					@if($l->overdue)
					@if(empty($l->return_date))
					<!-- <a href="" style="color:red"> return book/<br>pay fines </a> -->
					@endif
					@endif
					</td>
					
				</tr>
				
				@endforeach
			</tbody>
		</tr>
	</table>
<center>{!! $log->links() !!}</center>
</div>
@stop
