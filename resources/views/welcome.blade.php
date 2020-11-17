@extends('layouts.bloglayout')
@section('content')
{{--    <div class="col-9">--}}
<div class="all-threads-wrapper">
        <ul class="list-group">
            @include('layouts.partials.thread-list')
        </ul>
    </div>

@endsection


