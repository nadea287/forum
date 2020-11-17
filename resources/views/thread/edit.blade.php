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
        @include('layouts.partials.thread-form')
        <button type="submit" class="buttons thread_form_btns">Edit Thread</button>
    </form>
</div>
@endsection
