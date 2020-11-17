@extends('layouts.bloglayout')
{{--@extends('layouts.bloglayout')--}}
@section('content')
    <div class="all-threads-wrapper">
<div class="all-threads-top">
    <div class="cta-wrapper">
        <a href="{{ route('thread.create') }}" class="cta leave-comment-btn">Create Thread</a>
    </div>
    <h3>All Threads</h3>
</div>
        <ul class="list-group">
            @include('layouts.partials.thread-list')
        </ul>
    </div>
@endsection
