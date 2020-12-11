@extends('layouts.bloglayout')
{{--@extends('layouts.bloglayout')--}}
@section('content')
{{--    @if(isset($details))--}}
{{--@foreach($threadResult as $singleThread)--}}
{{--        {{ $singleThread->subject }}--}}
{{--@endforeach--}}
{{--    @endif--}}
    <div class="all-threads-wrapper">
        <div class="all-threads-top">
            <div class="cta-wrapper">
                <a href="{{ route('thread.create') }}" class="cta leave-comment-btn">Create Thread</a>
            </div>
            <h3>Threads for {{request()->input('q') }}</h3>
        </div>
        <ul class="list-group">
            @include('layouts.partials.thread-list')
        </ul>
    </div>
{{ $threads->appends(request()->input())->links() }}
@endsection
