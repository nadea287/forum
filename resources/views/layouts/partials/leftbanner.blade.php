<div class="col-3">
<div class="right-banner-wrapper">
    <h3>Category</h3>
<div class="right-banner-list">
    <ul class="list-group">
        <a href="{{ route('thread.index') }}">
            <li class="">
                All Threads
                <span>{{ \App\Models\Thread::all()->count() }}</span>
            </li>
        </a>
        @foreach(\App\Models\Tag::all() as $tag)
        <a href="{{ route('thread.index', ['tag' => $tag->id]) }}">
            <li class="">
                {{ $tag->name }}
                <span>
                    {{ \Illuminate\Support\Facades\DB::table('tag_thread')->where('tag_id', $tag->id)->count() }}
{{--                    {{ dd($count) }}--}}
                </span>
            </li>
        </a>
        @endforeach
    </ul>
</div>

    @include('layouts.partials.session-message')
</div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweene/0.5.11/tweene-all.min.js" integrity="sha512-F/pz5hyUKfNoQOI6KKFu6ppMRtGu2+9ORjaNMTYxohn0fYZJX43V2dCZWw86+u9atZcS2GyU9J1eU9pdxgGitA==" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/session-message.js') }}"></script>
@endpush
