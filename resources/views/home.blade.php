@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <!-- You're {{$age}} this year ;> -->

                    @if(Session::has('status'))
                        <p style="color: red">{{Session::get('status')}}</p>           
                    @endif
                    </br>
                    You've {{$count}} book(s) in your possession. <a href="/logs">View Borrow History</a>

                    </br>
                    You've borrowed a total of {{$count_ttl}} book(s).
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
