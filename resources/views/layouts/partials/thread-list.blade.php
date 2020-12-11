    @forelse($threads as $thread)
       <div class="thread-list-wrapper">
           <li class="list-group-item">
               <a href="{{ route('thread.show', ['thread' => $thread->id]) }}">
                   <h4>{{ $thread->subject }}</h4>
                   <span>
                       {!! \Michelf\MarkdownExtra::defaultTransform(str_limit($thread->thread, 100)) !!}
                    </span>
               </a>
               <div class="posted-user-cred">
                   <h6>
                       <span>Posted by</span>
                       <a href="{{ route('profile.show', ['user' => $thread->user->id]) }}">
                           {{ $thread->user->name }}
                       </a>
                       <span>{{ $thread->created_at->diffForHumans() }}</span>
                   </h6>
               </div>
           </li>
       </div>
    @empty
        <h3>Theare are no threads</h3>
    @endforelse
    {{ $threads->appends(request()->input())->links() }}

