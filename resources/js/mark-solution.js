// var solutionBtn = document.getElementById('solutionBth');

// solutionBtn.addEventListener('click', function (event) {
//     markSolution(event);
// });

function markSolution(e) {
    let btn = e.target;
    let commentId = btn.dataset.commentId;
    // let commentId = btn.id.split('-')[1];
    $.ajax({
        url: '/flag/solution/' + commentId + '/ajax',
        method: 'POST',
    }).done(function (result) {
        // console.log(result);
        // if (result.flagged) {
        //     $(btn).addClass('text-danger');
        // } else {
        //     $(btn).remove('text-danger');
        // }
        // getSolution(commentId, btn);
        // solutionBtn.setAttribute("id", 'mark_solution');
        console.log(result);
        $(e.target).replaceWith(result);

    }).fail(function (error) {
        console.log(error);
    });
}

// function getSolution(commentId, btn)
// {
//     // console.log(commentId);
//     let solutionsCount = document.querySelector('.solutions-count');
//     $.ajax({
//         url: '/api/solution/' + commentId,
//         method: 'GET',
//     }).done(function (response) {
//         let solutionVar = response.solution_count;
//
//         btn.innerHTML = solutionVar;
//     }).fail(function (error) {
//         console.log(error);
//     });
// }


$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.comment-actions').find('.fa-pencil').on("click", function () {
        var a = "contenteditable";
        var edit_btn = $(this);
        var comment_id = edit_btn.parent().data('id');
        var e = edit_btn.parent().parent().find('.display-comment-data');
        e.attr(a) === 'true' ? e.attr(a,'false') : e.attr(a, 'true');
        // console.log(e);
        if (e.hasClass('edit-comment')) {
            e.removeClass('edit-comment')
        } else {
            e.addClass('edit-comment');
        }
        $.ajax({
            url: '/comment/' + comment_id,
            method: 'PUT',
            data: {'body':e.text()}
        }).done(function (result) {
            console.log(result);
        }).fail(function (error) {
            console.log(error);
        })
    });
})
