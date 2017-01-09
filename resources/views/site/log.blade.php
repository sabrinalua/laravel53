@extends('layouts.app')
@section('content')

<div class="container">
	<table class="table table-stripped table-bordered">
		<tr>
			<thead>
				<th>BOOK</th>
				<th>DUE DATE</th>
				<th>STATUS</th>
			</thead>
			<tbody>
				@foreach($log as $l)
				<tr data-key= "{{$l->id}}">
					<td>{{$l->book_title}}</td>
					<td>{{$l->due_date}}</td>
					<td>
					@if(empty($l->return_date))
					not returned <a href="">RETURN NOW</a>
					@endif
					@if(!empty($l->return_date))
					returned on {{$l->return_date}}
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
