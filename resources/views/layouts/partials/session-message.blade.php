<div class="row">
    @if(session()->has('success'))
        <div class="session-wrapper">
            <div class="session-body">
                {{ session()->get('success') }}
            </div>
        </div>
    @endif

    @if(session()->has('error'))
        <div class="session-wrapper">
            <div class="session-body">
                {{ session()->get('error') }}
            </div>
        </div>
    @endif
</div>

{{--@push('scripts')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/tweene/0.5.11/tweene-all.min.js" integrity="sha512-F/pz5hyUKfNoQOI6KKFu6ppMRtGu2+9ORjaNMTYxohn0fYZJX43V2dCZWw86+u9atZcS2GyU9J1eU9pdxgGitA==" crossorigin="anonymous"></script>--}}
{{--    <script src="{{ asset('/js/session-message.js') }}"></script>--}}
{{--    <script src="{{ asset('/js/comment.js') }}"></script>--}}
{{--@endpush--}}
