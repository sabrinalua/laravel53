@extends('layouts.app')
@section('content')
<div class="container">
	<h1>Create User</h1>
	<form action="/users/create" method="POST">
		{{ csrf_field() }}
		<label>Designation</label>
		<select name="User[designation]" class="form-control">
			<option value="Mr">Mr</option>
			<option value="Ms">Ms</option>
			<option value="Mrs">Mrs</option>
		</select>
		<label>Name</label>
		<input type="text" name="User[name]" placeholder="nickname" class="form-control" required>
		<label>First Name</label>
		<input type="text" name="User[first_name]" placeholder="first name" class="form-control" required>
		<label>Last Name</label>
		<input type="text" name="User[last_name]" placeholder="last name" class="form-control" required>
		<label>Email</label>
		<input type="email" name="User[email]" placeholder="valid email address" class="form-control" required>
		<label>DOB</label>
		<input type="date" name="User[dob]" class="form-control" required>
		<label>Contact</label>
		<input type="text" name="User[contact]" placeholder="reachable contact number" class="form-control" required>
		<label>Address</label>
		<input type="text" name="User[address]" placeholder="permanent address" class="form-control" required>
		<label>Type</label>
		<select name="User[type]" class="form-control">
			<option value="librarian">Librarian</option>
			<option value="borrower">Borrower</option>
		</select>

		<input type="submit" name="Create" class="btn btn-success">
	</form>
</div>
@stop