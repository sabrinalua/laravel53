@extends('layouts.app')

@section('content')
<div class="container">
    Hello, {{ Auth::user()->name }} ! Youve been a member since {{ Auth::user()->created_at }}
</div>
@endsection
