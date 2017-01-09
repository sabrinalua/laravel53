@extends('layouts.app')
@section('content')

<select>
@foreach($roles as $key => $value)
<option value="{{$key}}" {{$user->type ==$key ? 'selected="selected"':''}} >{{$value}}</option>
@endforeach
</select>
@stop