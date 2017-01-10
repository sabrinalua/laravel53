@extends('layouts.app')
@section('content')
<div class="container">
<h1>Fines</h1>
	<table class="table table-stripped table-bordered">
		<tr>
			<thead>
				<th>ID</th>
				<th>Date</th>
				
				<th>Comment</th>
				<th>Logger <br>(user id) </th>
				<th>Fine Amount</th>
			</thead>
			<tbody>
				@foreach($fines as $f)
				<tr data-key= "{{$f->id}}">
					<td>{{$f->id}}</td>
					<td>{{$f->created_at}}</td>
					
					<td>{{$f->comment}}</td>
					<td>{{$f->logged_by}}</td>
					<td>{{$f->total_fines}}</td>
				</tr>
				@endforeach
				<tr>
					<td></td>
					<td><b>TOTAL</b></td>
					<td></td>
					<td></td>
					<td>{{$ttl}}</td>
				</tr>
			</tbody>
		</tr>
	</table>
	<center>{!! $fines->links() !!}</center>
</div>
@stop