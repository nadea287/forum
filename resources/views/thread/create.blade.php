@extends('layouts.bloglayout')
@section('content')
<div class="thread_forms">
    <ul class="breadcrumbs">
        <li class="breadcrumbs_item">
            <a href="{{ route('thread.index') }}" class="breadcrumbs_link">All Threads</a>
        </li>
        <li class="breadcrumbs_item">
            <a href="" class="breadcrumbs_link breadcrumbs_link_active">Create Thread</a>
        </li>
    </ul>
    <form action="{{ route('thread.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" class="form-control" name="subject" aria-describedby="subjectHelp"
                   value="{{ $thread->subject ?? old('subject') }}">
            @error('subject')
            <small class="text-danger font-weight-bold">
                {{ $message }}
            </small>
            @enderror
    </div>
    <div class="form-group">
        <label for="tag">Tag</label>
        <select id="tag" name="tag[]" multiple>
            @foreach(\App\Models\Tag::all() as $tag)
                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="thread">Thread</label>
        <textarea type="text" class="form-control" name="thread" aria-describedby="threadHelp"
                  value="{{ old('thread') }}">{{ $thread->thread ?? old('thread') }}</textarea>
        @error('thread')
        <small class="text-danger font-weight-bold">
            {{ $message }}
        </small>
        @enderror
    </div>
    <button type="submit" class="buttons thread_form_btns">Create Thread</button>
    </form>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
    <script src="{{ asset('/js/tag.js') }}"></script>
@endpush
@endsection
