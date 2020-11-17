<div class="notify_links">
    <a href="{{ route('profile.show', ['user' => $notification->data['user']['id']]) }}" class="notify_user_name">
        {{ $notification->data['user']['name'] }}
    </a>
    commented on your
    <a href="{{ route('thread.show', ['thread' => $notification->data['thread']['id']]) }}" class="notify_content">
        @isset($notification->data['thread']['subject'])
        {{ $notification->data['thread']['subject'] }}
        @endisset
    </a>
</div>
