$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('click', '.save-comment', function (e) {
        e.preventDefault();
        var thread_id = $(this).attr('id');
        var save_btn = $(this);
        var text = save_btn.parent().parent().find('input').val();
        var input = save_btn.parent().parent().find('input');
        $.ajax({
            url: '/comment/create/' + thread_id,
            method: 'POST',
            data: {
                'body':text,
            }
        }).done(function (result) {
            var data = insertComment(result);
            input.val(' ');
        }).fail(function (error) {
            console.log(error);
        });
    });

    function insertComment(response) {
        var data = response;
        var dataResult = JSON.parse(data);

        var comment_body = $('.comment-data');
        var user_name_block = $('.user_name');
        var comment_count = $('.solutions-count-x');
        var new_comment = dataResult.comment.body;
        var user_name = dataResult.user_name;
        // comment_body.children('span').append(new_comment);
        comment_body.prepend(new_comment).addClass('display-comment-data');
        user_name_block.append(user_name).addClass('display-user_name');

        insertThumb(comment_count, dataResult)

        return dataResult;
    }

    function insertThumb($parent, data) {
    // <div class="thumb_up">
    //         <i class="fa fa-thumbs-up" id="solutionBth" data-comment-id="{{ $comment->id }}" aria-hidden="true" onclick="markSolution(event)"><div class="solutions-count">{{ $comment->hasSolution->count() }}</div></i>

        //<button class="reply-btn buttons" onclick="toggleReply('{{ $comment->id }}')">reply</button>

        var div = $('<div>', {'class':'thumb_up'}).append(
            $('<i>', {'class':'fa fa-thumbs-up', 'id':'solutionBth-' + data.comment.commentable_id, 'data-comment-id': data.comment.id})
                .on('click', markSolution)
                .append(
                    $('<div>', {'class':'solutions-count'}).text(0)
                )
        )

    // $parent.data('comment-id', data.comment.commentable_id + '')
        div.get(0).dataset.commentId = data.comment.id;
        var createdCommentId = data.comment.id;

        var form = $('<div class="reply-form-' + data.comment.id +' hide-reply-form">')
            .append($('<form action="/comment/reply/' + createdCommentId +'" method="POST">')
                .append(
                    [$('<div class="comment-form">')
                    .append([$('<div class="txtb">')
                        .append(
                            [$('<input type="text" name="body" placeholder="reply" autocomplete="off" required>\n'),
                            $('<span class="login-form-span"></span>')
                            ]
                        ), $('<div class="cta-wrapper">')
                        .append(
                            $('<button type="submit" class="cta save-reply-btn">Save Reply</button>')
                                .attr({ id:data.comment.id })
                                .on('click', saveReply)
                        )
                        ]
                    )]
                )
            )

        //buttom
        // var button = $('<button>', {'class':'reply-btn buttons'}).text('reply')
        var button = $('<button>').text('reply')
            .attr('data-comment-id', data.comment.id)
            .on('click', toggleReply)
            // .on('click', { setCommentId : createdCommentId }, function () {
            // .on('click', function () {
            //     toggleReply(createdCommentId)
            // });
        button.addClass('reply-btn buttons');

        $parent.append(div).append(button).append(form);
    }

    //MARK NOTIFICATIONS AS READ
    $('.mark-as-read').on('click', function () {
        var btn = $(this);
        var notify_count = btn.parent().find('.notify-count').text();
        if (notify_count !== 0) {
            $.get('/markAsRead');
        }
    });

    function hideNotifyNumber() {
        var notify_block = $('.notify-count');
        var notify_count = notify_block.text();
        if (notify_count == 0) {
            notify_block.css({'opacity' : '0'});
        } else {
            notify_block.css({'opacity' : '1'});
        }
    }

    hideNotifyNumber();

});

//hide reply form
// function toggleReply(commentId) {
function toggleReply(event) {
    console.log(event.target.dataset.commentId);
    var commentId = event.target.dataset.commentId;
    $('.reply-form-'+commentId).toggleClass('hide-reply-form');
}


function saveReply(event) {
    event.preventDefault();
    var save_reply_btn = $('.save-reply-btn');
    var commentId = save_reply_btn.attr('id');
    var text = save_reply_btn.parent().parent().find('input').val();
    var input = save_reply_btn.parent().parent().find('input');
    $.ajax({
        url: '/comment/reply/' + commentId,
        method: 'POST',
        data: {
            'body':text,
        }
    }).done(function (result) {
        var data = insertReply(result);
        input.val(' ');
    }).fail(function (error) {
        console.log(error);
    });
}


function insertReply(response) {
    var data = response;
    var dataResult = JSON.parse(data);

    var reply_wrapper = $('.reply-section');
    console.log(reply_wrapper);

            var reply = $('<div class="reply-wrapper">')
                .append(
                    $('<span class="reply_display-user_name">' + dataResult.reply.body + '</span>')
                )
                .append(
                    $('<span class="reply_display-user_name">' + dataResult.user_name + '</span>')
                )
    reply_wrapper.append(reply);

        // .append(
        //     $('<span class="reply_display-comment-data">')
        // ).append(dataResult.user_name)

    // var comment_body = $('.comment-data');
    // var user_name_block = $('.user_name');
    // var comment_count = $('.solutions-count-x');
    // var new_comment = dataResult.comment.body;
    // var user_name = dataResult.user_name;
    // // comment_body.children('span').append(new_comment);
    // comment_body.prepend(new_comment).addClass('display-comment-data');
    // user_name_block.append(user_name).addClass('display-user_name');
    //
    // insertThumb(comment_count, dataResult)

    return dataResult;
}
