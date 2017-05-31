@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">ADMIN Dashboard</div>

                <div class="panel-body">
                @component('components.who')
                    You are logged in as <strong>ADMIN</strong>
                @endcomponent
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
