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
        @include('layouts.partials.thread-form')
        <button type="submit" class="buttons thread_form_btns">Create Thread</button>
    </form>
    </div>
@endsection
