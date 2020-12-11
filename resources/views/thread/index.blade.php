@extends('layouts.bloglayout')
@section('content')
    <div class="all-threads-wrapper">
        <div class="all-threads-top">
            <a href="{{ route('thread.create') }}" class="buttons leave-comment-btn">Create Thread</a>
            <div class="d-flex">
                <h3>All Threads</h3>
                <div class="sort-threads-form">
                    <form action="{{ route('thread.index') }}" class="pr-8">
                        <select class="" name="sort" onchange="this.form.submit()">
                            <option selected>Sort By</option>
                            <option value="desc">new</option>
                            <option value="week_old">week</option>
                            <option value="month_old">month</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <ul class="list-group">
            @include('layouts.partials.thread-list')
        </ul>
    </div>

@endsection
