$(document).ready(function () {

    $(document).on('click', '.reply-btn', function () {
        $(this).closest('.comment').find('.reply-form').toggleClass('d-none');
    });

    $('#commentForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        var postId = $(this).data('post-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/forum/' + postId + '/comment',
            data: formData + '&_token=' + csrfToken,
            success: function (response) {
                var newComment = response.comment;
                var commentBlock = '<div class="comment d-flex gap-2 mb-3">' +
                    '<img src="/storage/users_profile/' + newComment.users.profile_img + '" class="profile-img-forum" alt="profile.svg">' +
                    '<div class="comment-content" style="width: 100%">' +
                    '<div class="author-comment d-flex justify-content-between">' +
                    '<div class="author-info d-flex gap-2">' +
                    '<p class="fw-medium m-0">' + newComment.users.login + '</p>' +
                    '<p class="fw-light m-0">' + newComment.formatted_created_at + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<p class="comment-text">' + newComment.comment + '</p>' +
                    '<div class="d-flex">' +
                    '<button type="button" class="reply-btn link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Ответить</button>' +
                    '<div class="like-comments" style="margin: 0 20px 0 30px">' +
                    '<button type="button" data-comment-id="' + newComment.id + '" class="btn btn-like-comment">' +
                    '<img src="/image/thumb_up.svg" alt="thumb_up.svg">' +
                    '<span data-comment-id="' + newComment.id + '" class="likes-comment-count px-2">0</span>' +
                    '</button>' +
                    '<button type="button" data-comment-id="' + newComment.id + '" class="btn btn-dislike-comment">' +
                    '<img src="/image/thumb_down.svg" alt="thumb_down.svg">' +
                    '<span data-comment-id="' + newComment.id + '" class="dislikes-comment-count px-2">0</span>' +
                    '</button>' +
                    '</div>' +
                    '</div>' +
                    '<div class="reply-form d-none mt-2">' +
                    '<form class="replyForm d-flex align-items-center gap-2 w-100" data-post-id="' + postId + '" data-comment-id="' + newComment.id + '">' +
                    '<input class="form-control" name="reply" placeholder="Напишите ответ здесь...">' +
                    '<input type="hidden" value="' + newComment.id + '" name="comment_id">' +
                    '<button type="submit" class="btn btn-custom btn-sm">Отправить</button>' +
                    '</form>' +
                    '</div>' +
                    '<div class="replies mt-3"></div>' +
                    '</div>' +
                    '</div>';
                $('.comments').prepend(commentBlock);
                $('input[name="comment"]').val('');
            },
            error: function (xhr, status, error) {

                console.error(error);
            }
        });
    });

    $(document).on('submit', '.replyForm', function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = form.serialize();
        var postId = form.data('post-id');
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/forum/' + postId + '/reply',
            data: formData + '&_token=' + csrfToken,
            success: function (response) {
                var newReply = response.reply;
                var replyBlock = '<div class="reply mb-3">' +
                    '<div class="d-flex gap-2">' +
                    '<img src="/storage/users_profile/' + newReply.users.profile_img + '" class="profile-img-forum" alt="profile.svg">' +
                    '<div class="reply-content">' +
                    '<div class="author-reply d-flex justify-content-between">' +
                    '<div class="author-info d-flex gap-2">' +
                    '<p class="fw-medium m-0">' + newReply.users.login + '</p>' +
                    '<p class="fw-light m-0">' + newReply.formatted_created_at + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<p class="reply-text">' + newReply.comment + '</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="like-comments" style="margin-left: 48px">' +
                    '<button type="button" data-comment-id="' + newReply.id + '" class="btn btn-like-comment">' +
                    '<img src="/image/thumb_up.svg" alt="thumb_up.svg">' +
                    '<span data-comment-id="' + newReply.id + '" class="likes-comment-count px-2">0</span>' +
                    '</button>' +
                    '<button type="button" data-comment-id="' + newReply.id + '" class="btn btn-dislike-comment">' +
                    '<img src="/image/thumb_down.svg" alt="thumb_down.svg">' +
                    '<span data-comment-id="' + newReply.id + '" class="dislikes-comment-count px-2">0</span>' +
                    '</button>' +
                    '</div>' +
                    '</div>';

                form.closest('.comment').find('.replies').prepend(replyBlock);
                form.find('input[name="reply"]').val('');
            },
            error: function (xhr, status, error) {

                console.error(error);
            }
        });
    });


});


