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
        @foreach(\App\Models\Tag::all() as $tag)
{{--        @foreach($tags as $tagId)--}}
            <option value="{{ $tag->id }}" {{ $tagId == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
{{--            <option value="{{ $tag->id }}" {{  $tagId == $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>--}}

{{--            @endforeach--}}
        @endforeach
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
