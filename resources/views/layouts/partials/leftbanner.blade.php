    <div class="col-3">
        <form action="{{ url('/search') }}" method="GET" role="search">
           <div class="search-box">
               <input type="text" name="q" value="{{ request()->input('q') }}" placeholder="search">
               <button type="submit" class="buttons">
                   <i class="fa fa-search" aria-hidden="true"></i>
               </button>
           </div>
            @error('q')
            <small class="text-danger font-weight-bold">
                {{ $message }}
            </small>
            @enderror
        </form>
        <div class="main-right-container">
        <div class="right-banner-wrapper">
            <h3>Category</h3>
            <div class="right-banner-list">
                <ul class="list-group">
                    <a href="{{ route('thread.index') }}">
                        <li class="@if(\Illuminate\Support\Facades\Session::get('place') == 'thread')
                            active_link @endif">
                            All Threads
                            <span>{{ \App\Models\Thread::all()->count() }}</span>
                        </li>
                    </a>
                    @foreach(\App\Models\Tag::all() as $tag)
                    <a href="{{ route('thread.index', ['tag' => $tag->id]) }}">
                        <li class="{{ setActiveTag($tag->id) }}">
                            {{ $tag->name }}
                            <span>
                                {{ tagCount($tag->id) }}
                            </span>
                        </li>
                    </a>
                    @endforeach
                </ul>
            </div>
            @include('layouts.partials.session-message')
        </div>
        </div>
    </div>
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweene/0.5.11/tweene-all.min.js" integrity="sha512-F/pz5hyUKfNoQOI6KKFu6ppMRtGu2+9ORjaNMTYxohn0fYZJX43V2dCZWw86+u9atZcS2GyU9J1eU9pdxgGitA==" crossorigin="anonymous"></script>
    <script src="{{ asset('/js/session-message.js') }}"></script>
@endpush
