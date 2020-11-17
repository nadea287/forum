@extends('layouts.bloglayout')
@section('content')
    <div class="profile-wrapper">
        <div class="profile-user-data">
                <div class="dropdown profile-actions">
                    <button class="buttons dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="action-dots">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                        </div>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('profile.edit', ['user' => $user->id]) }}">Edit Profile</a>
                        <a class="dropdown-item" href="#">Delete Profile</a>
                    </div>
                </div>
            <div class="image-section">
                <img src="{{ asset($user->profile->profileImage()) }}" alt="">
            </div>
            <div class="profile-user-name">
                <span>{{ $user->name }}</span>
            </div>
        </div>
        <div class="profile-data">
{{--            <h3>{{ $user->name }}'s latest threads</h3>--}}
{{--            <span>--}}
{{--                @forelse($user->threads as $thread)--}}
{{--                    {{ $thread->thread }}--}}
{{--                @empty--}}
{{--                    <h5>No Threads</h5>--}}
{{--                @endforelse--}}
{{--            </span>--}}

{{--            <h3>{{ $user->name }}'s latest Comments</h3>--}}
{{--            @forelse($comments as $comment)--}}
{{--                <h6>--}}
{{--                    {{ $user->name }} commented on--}}
{{--                    <a href="{{ url('/thread/' . $comment->commentable['id']) }}"></a>--}}
{{--                    <a href="{{ route('thread.show', ['thread' => $comment->commentable['id']]) }}">--}}
{{--                        {{ $comment->commentable['subject'] }}--}}
{{--                    </a>--}}
{{--                    {{ $comment->created_at->diffForHumans() }}--}}
{{--                </h6>--}}
{{--            @empty--}}
{{--                nothing here--}}
{{--                @endforelse--}}

            <div class="btn-container">
                <button class="buttons tab-btn active-tab" data-id="threads">Threads</button>
                <button class="buttons tab-btn" data-id="comments">Comments</button>
            </div>
            <div class="about-user">
                <div class="user-profile-content active-tab" id="threads">
                        @forelse($user->threads as $thread)
                    <div class="user-threads">
                        <a href="{{ route('thread.show', ['thread' => $thread->id]) }}">
                            {{ $thread->subject }}
                        </a>
                    </div>
                        @empty
                            <h5>No Threads</h5>
                        @endforelse
                </div>
                <div class="user-profile-content" id="comments">
                   <div class="user-comments">
                       @forelse($comments as $comment)
                           <a href="{{ route('thread.show', ['thread' => $comment->commentable['id']]) }}">
                               {{ $comment->commentable['subject'] }}
                           </a>
                           <h6>{{ $comment->created_at->diffForHumans() }}</h6>
                       @empty
                           nothing here
                       @endforelse
                   </div>
                </div>
            </div>
        </div>

{{--        @foreach($feeds as $feed)--}}
{{--            @include('profile.feeds.' . $feed->type)--}}


{{--        @endforeach--}}
    </div>


@endsection
