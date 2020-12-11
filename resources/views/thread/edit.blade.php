@extends('layouts.bloglayout')

@section('content')
<div class="thread_forms">
    <ul class="breadcrumbs">
        <li class="breadcrumbs_item">
            <a href="{{ route('thread.show', ['thread' => $thread->id]) }}" class="breadcrumbs_link">Thread</a>
        </li>
        <li class="breadcrumbs_item">
            <a href="" class="breadcrumbs_link breadcrumbs_link_active">Edit</a>
        </li>
    </ul>
    <form action="{{ route('thread.update', ['thread' => $thread->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" aria-describedby="subjectHelp" value="{{ $thread->subject ?? old('subject') }}">
            @error('subject')
            <small class="text-danger font-weight-bold">
                {{ $message }}
            </small>
            @enderror
        </div>

        <div class="form-group">
            <label for="tag">Tag</label>
            <select id="tag" name="tag[]" multiple>
                {{--        @foreach(\App\Models\Tag::all() as $tag)--}}
                @isset($thread)
                    @foreach($thread->tags as $tag)
                        <option value="{{ $tag->id }}" selected>{{ $tag->name }}</option>
                    @endforeach
                    @foreach($tagsRest as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                @endisset
            </select>
        </div>
        <div class="form-group">
            <label for="thread">Thread</label>
            <textarea type="text" class="form-control" name="thread" aria-describedby="threadHelp" value="{{ old('thread') }}">{{ $thread->thread ?? old('thread') }}</textarea>
            @error('thread')
            <small class="text-danger font-weight-bold">
                {{ $message }}
            </small>
            @enderror
        </div>
        @push('scripts')
            <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
            <script src="{{ asset('/js/tag.js') }}"></script>
        @endpush

        <button type="submit" class="buttons thread_form_btns">Edit Thread</button>
    </form>
</div>
@endsection
