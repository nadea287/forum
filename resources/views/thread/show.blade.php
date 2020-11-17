@extends('layouts.bloglayout')
@section('content')
<div class="single-thread-wrapper">
    <div class="thread-body">
        <span>{{ $thread->subject }}</span>
            <div class="thread-descript">
                <p>{!! \Michelf\MarkdownExtra::defaultTransform($thread->thread) !!}</p>
                <div class="thread_actions">
                    @can('update', $thread)
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink"
                               role="button" data-toggle="dropdown"
                               aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a href="{{ route('thread.edit', ['thread' => $thread->id]) }}"
                                   class="dropdown-item">
                                    Edit
                                </a>
                                <button id="{{ $thread->id }}" class="dropdown-item thread-delete-btn">
                                    Delete
                                </button>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
        <div class="thread-comment">
           <div class="comment-form">
                   <div class="txtb">
                       <input type="text" name="body" placeholder="Leave a Comment" autocomplete="off" required>
                        <span class="login-form-span"></span>
                   </div>
                   @error('body')
                    <small class="font-weight-bold text-danger">{{ $message }}</small>
                   @enderror
                   <div class="cta-wrapper">
                       <button type="submit" class="cta save-comment" id="{{ $thread->id }}">Save comment</button>
                   </div>
           </div>
            <div class="comments-display-wrapper">
                <div class="comment-properties">
{{--                                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSE2_4ZaThwQbloPcJIs0DK-Dcf3XuK5JHZ9g&usqp=CAU" alt="">--}}

                    <div class="comment-cred">
                        <div class="user_name"></div>
                        <div class="comment-data"></div>
                        <div class="solutions-count-x"></div>

                    </div>
                </div>
                @foreach($thread->comments as $comment)
                <div class="all_comments">
                    <div class="comment-properties">
                        {{--                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSE2_4ZaThwQbloPcJIs0DK-Dcf3XuK5JHZ9g&usqp=CAU" alt="">--}}
                        <div class="comment-cred">
                            <span class="display-user_name">{{ $comment->user->name }}</span>
                            <span class="display-comment-data">{{ $comment->body }}</span>


                            <div class="thumb_up">
                                <i class="fa fa-thumbs-up" id="solutionBth-{{ $comment->id }}"
                                   data-comment-id="{{ $comment->id }}" aria-hidden="true"
                                   onclick="markSolution(event)">
                                    <div class="solutions-count">{{ $comment->hasSolution->count() }}</div>
                                </i>
                                {{--                                <div class="solutions-count" data-comment="{{ $comment->id }}">{{ $comment->hasSolution->count() }}</div>--}}
                            </div>

                            <div class="append-reply">
                            <button data-comment-id="{{ $comment->id }}" class="reply-btn buttons" onclick="toggleReply(event)">reply</button>
                            </div>

                            <div class="reply-form-{{ $comment->id }} hide-reply-form">
                                <form action="{{ route('reply.store', ['comment' => $comment->id]) }}" method="POST">
                                    @csrf
                                    <div class="comment-form">
                                        <div class="txtb">
                                            <input type="text" name="body" placeholder="reply" autocomplete="off" required>
                                            <span class="login-form-span"></span>
                                        </div>
                                        @error('body')
                                        <small class="font-weight-bold text-danger">{{ $message }}</small>
                                        @enderror
                                        <div class="cta-wrapper">
                                            <button type="submit" class="cta save-reply-btn" onclick="saveReply(event)" id="{{ $comment->id }}">Save Reply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            {{--                            reply--}}
                            @foreach($comment->comments as $reply)
                              <div class="reply-section">
                                  <div class="reply-wrapper">
                                      <span class="reply_display-user_name">{{ $reply->user->name }}</span>
                                      <span class="reply_display-comment-data">{{ $reply->body }}</span>
                                  </div>
                              </div>
                            @endforeach
                        </div>
                    </div>
{{--                    <button class="reply-btn buttons" onclick="toggleReply('{{ $comment->id }}')">reply</button>--}}
                    {{--                        <a href="" class="btn btn-dark btn-sm">Edit</a>--}}
                    {{--                        <button class="btn btn-dark btn-sm comment-delete-btn" data-id="{{ $comment->id }}">Delete</button>--}}

                    {{--                        REPLY TO COMMENT--}}
{{--                    <div class="reply-form-{{ $comment->id }} hide-reply-form">--}}
{{--                        <form action="{{ route('reply.store', ['comment' => $comment->id]) }}" method="POST">--}}
{{--                            @csrf--}}
{{--                            <div class="comment-form">--}}
{{--                                <div class="txtb">--}}
{{--                                    <input type="text" name="body" placeholder="reply" autocomplete="off" required>--}}
{{--                                    <span class="login-form-span"></span>--}}
{{--                                </div>--}}
{{--                                @error('body')--}}
{{--                                <small class="font-weight-bold text-danger">{{ $message }}</small>--}}
{{--                                @enderror--}}
{{--                                <div class="cta-wrapper">--}}
{{--                                    <button type="submit" class="cta save-reply-btn">Save Reply</button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </form>--}}
{{--                    </div>--}}
                </div>

                @endforeach
{{--@endforeach--}}

            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('/js/delete-item.js') }}"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
{{--        <script src="{{ asset('/js/comment.js') }}"></script>--}}
        <script src="{{ asset('/js/mark-solution.js') }}"></script>
    @endpush
@endsection

